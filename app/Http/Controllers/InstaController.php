<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Socialite;

class InstaController extends Controller
{
    //

    public function feed(Request $request)
    {
       return view('instafeed');

	}
	
}
 