<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{

  public function basic_email(){
     $data = array('name'=>"Janus Couch");

     Mail::send(['text'=>'mail'], $data, function($message) {
        $message->to('couchjanus@gmail.com', 'Couch Janus')->subject
           ('Laravel Basic Testing Mail');
        $message->from('couchjanus@gmail.com','Janus Couch');
     });
     echo "Basic Email Sent. Check your inbox.";
  }

  public function html_email(){
     $data = array('name'=>"Janus Couch");
     Mail::send('emails.mail', $data, function($message) {
        $message->to('couchjanus@gmail.com', 'Couch Janus')->subject
           ('Laravel HTML Testing Mail');
        $message->from('couchjanus@gmail.com','Janus Couch');
     });
     echo "HTML Email Sent. Check your inbox.";
  }

  public function attachment_email(){
     $data = array('name'=>"Janus Couch");
     Mail::send('mail', $data, function($message) {
        $message->to('couchjanus@gmail.com', 'Couch Janus')->subject
           ('Laravel Testing Mail with Attachment');
        $message->attach('/home/janus/www/laravel-w13/public/images/cat3.jpg');
        $message->from('couchjanus@gmail.com','Janus Couch');
     });
     echo "Email Sent with attachment. Check your inbox.";
  }
}