<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBulkQueueMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 20;
    //public $tries = 2;
    //public $maxExceptions = 10;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = User::limit(5)->get();
        $input['subject'] = $this->details['subject'];

        foreach ($data as $key => $value) {
            try {
                $input['email'] = $value->email;
                $input['name'] = $value->name;
                Mail::send('email', ['data' => $input], function($message) use($input){
                    $message->to($input['email'], $input['name'])
                        ->subject($input['subject']);
                });

                //notify to user 1 that mail is sent
                $user = \App\User::find(1);
                $details_not=[];
                $details_not['subject']=$this->details['subject'];
                $details_not['email']=$value->email;
                $details_not['name']=$value->name;
                $user->notify(new \App\Notifications\MailSentNotification($details_not));
            }
            catch (\Exception $e){
                Log::info('Failed was called for user id '.$value->id);
            }
        }
    }
}
