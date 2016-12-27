<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sentinel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Ad;
use App\Event;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        
        if(Sentinel::check())
            $user=Sentinel::getUser();
        
        $currentUserId = $user->id;

        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
         $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        return view('messenger.index', compact('threads', 'currentUserId'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Sentinel::getUser()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Sentinel::getUser()->id)->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function storeFrontend()
    {
        
        $input = Input::all();

        $ad=Ad::findorfail($input['subject']);
        $subject="Message on Ad-".$ad->title;
        $adlink= "<a href='".url('ads-detail/'.$ad->slug)."'>View ".$ad->title."</a>";

        $message=$input['message'];
        $chk=filter_var(trim($message), FILTER_VALIDATE_EMAIL);
        if($chk)
            return redirect('ads-detail/'.$ad->slug)->with('error','Message Contains invalid things like email');



        $thread = Thread::create(
            [
                'subject' => $subject,
            ]
        );

        
        

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'body'      => $input['message']."<br/>".$adlink,
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(array($ad->user_id));
        }

        return redirect('ads-detail/'.$ad->slug)->with('success','Message Sent');
        //return redirect('messages');
    }

    public function storeFrontendevent()
    {
        
        $input = Input::all();

        $event=Event::findorfail($input['subject']);
        $subject="Message on Event-".$event->name;
        $eventlink= "<a href='".url('event/'.$event->slug)."'>View ".$event->name."</a>";

        $message=$input['message'];
        $chk=filter_var(trim($message), FILTER_VALIDATE_EMAIL);
        if($chk)
            return redirect('event/'.$event->slug)->with('error','Message Contains invalid things like email');



        $thread = Thread::create(
            [
                'subject' => $subject,
            ]
        );

        
        

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'body'      => $input['message']."<br/>".$eventlink,
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(array($event->user_id));
        }

        return redirect('event/'.$event->slug)->with('success','Message Sent');
        //return redirect('messages');
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'body'      => $input['message'],
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        return redirect('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Sentinel::getUser()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect('messages/' . $id);
    }
}
