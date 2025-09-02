<?php

namespace App\Console\Commands;

use App\Jobs\SendDietReminderJob;
use App\Models\User;
use Illuminate\Console\Command;

class SendDailyDietReminders extends Command
{
    protected $signature = 'diet:send-daily-reminders';
    protected $description = 'Send daily diet reminder emails to all users';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            SendDietReminderJob::dispatch($user);
        }

        $this->info('Diet reminders dispatched successfully!');
    }
}
