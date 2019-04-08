<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClaimNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        //
        $this->claim = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $item = $this->claim;
        return $this->view('messenger.emails.claim_notification', compact('item'));
    }
}
