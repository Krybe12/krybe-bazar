<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageToUser extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($offer, $message)
  {
    $this->offer = $offer;
    $this->message = $message;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('emails.message')
      ->with([
        'seller' => $this->offer->user->name,
        //'email' => $this->offer->user->email,
        'header' => $this->offer->header,
        'message' => $this->message
      ]);
  }
}
