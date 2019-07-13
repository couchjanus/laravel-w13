<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $event;
    public $plan;

    public function __construct($event)   {
        $this->event = $event;
        $this->plan = "Bla, bla, bla plan";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        // return $this->from('hello@app.com', 'От Вашего приложения')        ->view('emails.reminder');
        return $this->from('hello@app.com', 'От Вашего приложения')
        ->subject('Ваше напоминание!')->view('emails.reminder')
        ->text('emails.reminder_plain');
        // ->with([
        //     'eventName' => $this->event,
        //     'eventPlan' => $this->plan,
        // ]);

    }
}
