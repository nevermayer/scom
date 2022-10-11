<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{

    
    public function index(Request $request)
    {
        
       $mailData = [
          'title' => 'Mail from TtSolutionStuff.com',
          'body'  => 'This is for testing email using smtp.'
       ];

    Mail::to('samueldxa@gmail.com')->send(new DemoMail($mailData));
    dd("Email is sent successfully.");
    }
    
   
    
}
