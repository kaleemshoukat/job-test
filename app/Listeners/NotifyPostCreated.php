<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PostCreated $event)
    {
        $this->event=$event;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = User::limit(10)->get();

        foreach ($data as $key => $value) {
            try {
                $input['name'] = $event->post->name;
                $input['description'] = $event->post->description;
                Mail::send('email_event', ['data' => $input], function($message) use($value){
                    $message->to($value['email'], $value['name'])
                        ->subject('Test event listener');
                });
            }
            catch (\Exception $e){
                //notice for custom created log file
                //PHP_EOL  is line break
                Log::channel('post')->notice('Failed for user id= '.$value['id'].PHP_EOL.$e->getMessage());
            }
        }
    }
}
