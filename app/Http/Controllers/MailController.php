<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSubmittedMail;

class MailController extends Controller
{
    //
    function sendEmail(){
    	$ticket = Ticket::latest()->first();
        $track_link = route('ticket.track', ['id' => $ticket->ticket_id, 'key' => $ticket->track_key]);
        $to = $ticket->email;

        Mail::to($to)->send(new TicketSubmittedMail($ticket, $track_link));

        return 'Mail sent!';
    }
}
