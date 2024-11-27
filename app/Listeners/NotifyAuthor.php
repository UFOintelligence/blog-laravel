<?php

namespace App\Listeners;

use App\Mail\NotifyAuthorMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAuthor
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        switch ($event->question->questionable_type) {
            case 'App\Models\Post':
                # code...
                $post = $event->question->questionable;
                $author = $post->user;

                Mail::to($author->email)->send(new NotifyAuthorMailable($event->question, $author));

                break;
            
            default:
                # code...
                break;
        }
        
    }
}
 