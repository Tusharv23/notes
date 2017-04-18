<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Mail;
use App\Jobs\SendWelcomeEmail;

class MailController extends Controller
{
    //
    public function send()
    {
        Log::info("Request cycle without Queues started");
        $this->dispatch(new SendWelcomeEmail());
        Log::info("Request cycle without Queues finished");
        return 'mail sent';
    }
}
