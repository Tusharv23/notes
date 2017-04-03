<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    //
    public function update(Request $request)
    {
    	
    	
    	$file = $request->file('song');
    	$file->move('upload',$file->getClientOriginalName());
    	echo('hogya');

    	
    	
    }
}