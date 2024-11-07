<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The name to be included in the email.
     *
     * @var string
     */
    public string $name;

    /**
     * Create a new message instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('My Test Email')
                    ->view('mail.hello')  // Your email view file
                    ->with([
                        'name' => $this->name,
                    ]);
    }
}
