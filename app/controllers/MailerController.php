<?php

class MailerController extends BaseController {
    public function welcomeMail(){
        $activation_code = Session::get('user.activationcode');
        $fname = $this->app('Input')->get('fname');
        $lname = $this->app('Input')->get('lname');
        $email = $this->app('Input')->get('email');
        $data = ['activation_code'=>$activation_code,
                    'fname'=> $fname,
                    'lname'=>$lname,
                    'email'=>$email];
        Mail::queue('emails.welcome',$data,function($message)
        {
            $message->to($email,$fname.' '.$lname)->subject('Welcome! to EdLara');
        });
    }   

}