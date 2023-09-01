<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $email = [
            'subject' => 'coba',
            'sender' => 'fahri010206@gmail.com'
        ];
        Mail::to("fadlinarsin12@gmail.com")->send(new sendMail($email));
        if (Mail::flushMacros()) {
            return 'error';
        }
        return "success";
    }

    public function sendEmail(Request $request)
    {
        $email = $request->input('email');

        $emailData = [
            'subject' => 'Struk',
            'sender' => 'fahri010206@gmail.com',
        ];

        Mail::to($email)->send(new sendMail($emailData));

        return "success";
    }
}
