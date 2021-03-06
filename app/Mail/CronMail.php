<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CronMail extends Mailable
{
    use Queueable, SerializesModels;

    public $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->from('martletanastasia@gmail.com', 'Anastasia Strizhenok')
            ->subject('Test cron emails')
            ->with([
                'text' => $this->text
            ])
            ->view('mails.cron');
    }
}
