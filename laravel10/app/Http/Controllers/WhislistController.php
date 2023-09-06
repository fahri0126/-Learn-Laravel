<?php

namespace App\Http\Controllers;

use App\Models\Whislist;
use Illuminate\Http\Request;

class WhislistController extends Controller
{
    public function index()
    {
        $whislist = Whislist::all();
        return view('whislist', ['whislist' => $whislist]);
    }
}
