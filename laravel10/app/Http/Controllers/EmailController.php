<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = TransaksiDetail::with(['transaksi', 'produk'])->where('transaksi_id', $id)->get();
        view()->share('data', $data);

        $email = [
            'subject' => 'struk',
            'sender' => 'fahriMart@gmail.com'
        ];

        $emailTo = $request->inputMail;
        Mail::to("$emailTo")->cc('fahri010206@gmail.com')->send(new sendMail($email));
        if (Mail::flushMacros()) {
            return 'error';
        }
        return response()->json(['message' => 'Email sent successfully']);
    }
}
