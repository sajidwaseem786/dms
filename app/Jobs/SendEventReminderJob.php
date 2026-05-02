<?php

namespace App\Jobs;

use App\Mail\EventReminderMail;
use App\Models\Event;
use App\Models\Tenant;
use App\Models\User;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stancl\Tenancy\Facades\Tenancy;

class SendEventReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1; 
    public int $backoff = 2; 
    public int $timeout = 60;

    public function __construct(
        public string $tenantId,      
        public int $eventId,         
        public int $volunteerId,
        public string $emailSubject,
        public string $body,
    ) {}

    public function handle(): void
    {
        // ✅ Find tenant from landlord database
        $tenant = Tenant::find($this->tenantId);

        if (!$tenant) {
            Log::error('SendEventReminderJob: tenant not found', [
                'tenant_id' => $this->tenantId
            ]);
            return;
        }

        // ✅ Initialize tenancy
        tenancy()->initialize($tenant);

        // ✅ Manually set the database name exactly like your User model does
        $dbName = $tenant->getDatabaseName();

        config(['database.connections.mysql.database' => $dbName]);
        DB::purge('mysql');
        DB::reconnect('mysql');

        try {
            $event     = Event::on('mysql')->find($this->eventId);
            $volunteer = User::on('mysql')->find($this->volunteerId);

            if (!$event || !$volunteer || !$volunteer->email) {
                Log::warning('SendEventReminderJob: missing data', [
                    'event_id'     => $this->eventId,
                    'volunteer_id' => $this->volunteerId,
                ]);
                return;
            }

            Mail::to($volunteer->email)
                ->send(new EventReminderMail(
                    event: $event,
                    volunteer: $volunteer,
                    emailSubject: $this->emailSubject,
                    body: $this->body,
                ));

            Log::info('Reminder sent to ' . $volunteer->email);

        } finally {
            tenancy()->end();
            DB::purge('mysql');
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('SendEventReminderJob failed', [
            'tenant_id'    => $this->tenantId,
            'event_id'     => $this->eventId,
            'volunteer_id' => $this->volunteerId,
            'error'        => $exception->getMessage(),
        ]);
    }
}