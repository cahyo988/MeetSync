<?php

namespace App\Mail;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TodoReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Todo instance.
     *
     * @var Todo
     */
    public $todo;

    /**
     * Create a new message instance.
     *
     * @param Todo $todo
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Todo Reminder MEETSYNC')
            ->from('meetsyncservice@gmail.com', 'MEETSYNC')
            ->view('emails.todo-reminder');
    }
}
