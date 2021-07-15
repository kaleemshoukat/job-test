<?php

namespace App\Http\Controllers;

use App\Enums\PostType;
use App\Events\PostCreated;
use App\Jobs\SendBulkQueueMail;
use App\Post;
use App\Rules\CheckHiLetter;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendBulkMail(Request $request)
    {
        $details = [
            'subject' => 'Weekly Notification'
        ];

        // send all mail in the queue.
        $job = (new SendBulkQueueMail($details))
            ->delay(
                now()
                    ->addSeconds(2)
            );

        dispatch($job);

        echo "Bulk mail send successfully in the background...";
    }

    public function post(){
        $types=PostType::asSelectArray();
        return view('post', compact('types'));
    }

    public function createPost(Request $request){
        $request->validate([
           'name'=>'required' ,
           'description'=>['required', new CheckHiLetter()],    //custom rule usage example
            'type'=>'required' ,
        ]);

        try{
            $post=new Post();
            $post->name=$request->name;
            $post->description=$request->description;
            $post->type=PostType::getPostType($request->type);  //enums usage example
            $post->save();

            event(new PostCreated($post));
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('message', 'Data saved');
    }

}
