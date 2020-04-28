<?php

namespace App\Http\Controllers\Admin\UserSupport;

use App\Http\Controllers\Controller;
use App\User;
use App\UserSupport;
use Illuminate\Http\Request;

class UserSupportController extends Controller
{
    public function get() {
        // Get all users in the system
        $sender = User::all();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = UserSupport::select(\DB::raw('`email` as sender, count(`email`) as messages_count'))
            ->where('read', false)
            ->groupBy('email')
            ->get();
        
        // add an unread key to each contact with the count of unread messages
        $contacts = $sender->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    // public function getMessagesFor($id)
    // {
    //     // mark all messages with the selected contact as read
    //     Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

    //     // get all messages between the authenticated user and the selected user
    //     $messages = Message::where(function($q) use ($id) {
    //         $q->where('from', auth()->id());
    //         $q->where('to', $id);
    //     })->orWhere(function($q) use ($id) {
    //         $q->where('from', $id);
    //         $q->where('to', auth()->id());
    //     })
    //     ->get();

    //     // broadcast(new NewMessage($messages));

    //     return response()->json($messages);
    // }
}
