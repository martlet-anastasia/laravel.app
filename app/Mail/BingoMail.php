<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BingoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $balance;
    /**
     * @var string
     */
    public $test;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($balance)
    {
        $this->balance = $balance;
        $this->test = 'hello world';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ghghg@mail.ru')
            ->view('mails.bingo')
            ->with([
                'text_hell' => 'hjgfhkdhf'
            ])
            ->attach('https://static.independent.co.uk/2021/12/07/10/PRI213893584.jpg');
    }
}
