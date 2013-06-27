<?php

class MailerController extends BaseController {
    public function test()
    {
        $data = [
        'test'=>'Test Mail'
        ];
        Mail::send('emails.welcome', $data, function($message)
        {
            $message->to('gnanakeethan@gmail.com', 'Gnanakeethan')->subject('Welcome!');
        });
    }

}