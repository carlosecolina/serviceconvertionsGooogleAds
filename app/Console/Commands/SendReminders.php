<?php
// app/Console/Commands/SendReminders.php

namespace App\Console\Commands;

use App\Helpers\EmailConfig;
use App\Models\Category;
use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Models\User;
use App\Services\MailService;
use Carbon\Carbon;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send reminders via email';

    protected $mailService;

    public function __construct(EmailConfig $mailService)
    {
        parent::__construct();
        $this->mailService = $mailService;
    }

    public function handle()
    {
        $reminders = Reminder::whereDate('date', Carbon::today())->get();

        foreach ($reminders as $reminder) {

            $user = User::find($reminder->user_id);
            $category = Category::find($reminder->category);
            $name = $user->name;
            $data = [
                'full_name' => $name,
                'email' => $user->email,
            ];

            $mail = EmailConfig::config();
            try {
                $mail->addAddress($data['email']);
                $mail->Body = "Hola {$data['full_name']}, te enviamos este mensaje porque tienes un recordatorio para la Ocacion '{$category->name}' con el título {$reminder->title} para hoy.";
                $mail->isHTML(true);
                $mail->send();
            } catch (\Throwable $th) {
                // Manejar la excepción si es necesario
            }
        }

        $this->info('Reminders sent successfully!');
    }
}