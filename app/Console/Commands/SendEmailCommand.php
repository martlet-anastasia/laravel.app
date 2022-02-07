<?php

namespace App\Console\Commands;

use App\Mail\CronMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Laravel\Facades\Telegram;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {--email= : Email where to send the message}
                            {--id= : ID of the user}
                            {--t|text= : Email text}
                            {--telegram_username= : Telegram username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->option('email') ?? null;
        $id = $this->option('id') ?? null;
        $text = $this->option('text') ?? 'default';
        $telegram_username = $this->option('telegram_username') ?? null;
        $telegramChatId = null;

        if($id) {
            try {
                $email = User::find($id)->email;
            } catch (\Exception $e) {
                $this->error('User ID not found');
                return Command::FAILURE;
            }
        }

        if($telegram_username) {
            $updates = Telegram::getUpdates();
            $userName = $telegram_username;
            foreach ($updates as $update) {
                $telegramUserName = $update['message']['chat']['username'];
                if ($userName == $telegramUserName) {
                    $telegramChatId = $update['message']['chat']['id'];
                    break;
                }
            }
        }

        if($id || $email || $telegram_username) {
            // Send message per email
            if($id || $email) {
                Mail::to($email)
                    ->send(new CronMail($text));
                $this->info('Message successfully sent by email to '.$email);
            }
            // Send message in Telegram
            if($telegramChatId) {
                Telegram::sendMessage([
                    'chat_id' => $telegramChatId,
                    'text' => $text,
                ]);
                $this->info('Message successfully sent in Telegram to '.$telegram_username);
            }
        } else {
            $this->error('email (--email) or user id (--id) or telegram username (--telegram_username) should be passed');
        }

        return Command::SUCCESS;
    }
}
