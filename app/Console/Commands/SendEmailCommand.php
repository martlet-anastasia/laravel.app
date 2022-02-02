<?php

namespace App\Console\Commands;

use App\Mail\CronMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {--email= : Email where to send the message}
                            {--id= : ID of the user}
                            {--t|text= : Email text}';

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

        if($id) {
            try {
                $email = User::find($id)->email;
            } catch (\Exception $e) {
                $this->error('User ID not found');
                return Command::FAILURE;
            }
        }

        if($id || $email) {
            Mail::to($email)
                ->send(new CronMail($text));
            $this->info('Message successfully sent to '.$email);
        } else {
            $this->error('Either email (--email) or user id (--id) should be passed');
        }

        return Command::SUCCESS;
    }
}
