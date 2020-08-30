<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question; 
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use App\Models\About;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) { 
            if ($message == 'Hi' || $message == 'hi') {
                $this->askName($botman); 
            }
            // else{
            //     $botman->reply("write 'hi' for testing...");
            // } 
            if ($message == 'Thông tin liên hệ' || $message == 'thông tin liên hệ') {
                $this->askForDatabase($botman); 
            } 
        });
        
        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    { 
        $botman->ask('Xin chào! Bạn tên gì?', function(Answer $answer, $botman) { 
            $name = $answer->getText(); 
            $this->say('Chào '.$name);
            $question = Question::create('Đây là tin nhắn tự động! Bạn có muốn liên hệ qua những cách sau để được tư vấn trực tiếp?')
            ->fallback('Unable to create a new database')
            ->callbackId('create_database')
            ->addButtons([
                Button::create('Facebook')->value('facebook'),
                Button::create('Email')->value('email'),
                Button::create('Số điện thoại')->value('phone'),
            ]); 
            $botman->ask($question, function (Answer $answer) {
                // Detect if button was clicked:
                $about = About::first();
                if ($answer->isInteractiveMessageReply()) { 
                    //$selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                    $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                    if ($answer->isInteractiveMessageReply()) { 
                        //$selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                        $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                        if ($selectedText == 'facebook') {
                        $this->say('Bạn có thể liên hệ qua link Facebook:<br> https://www.facebook.com/CRAZY-1387478951510015/ <br> Hoặc click biểu tượng Messenger ở gốc phải màn hình'); 
                        }elseif ($selectedText == 'email') {
                            $this->say("Bạn có thể liên hệ qua Email: ".$about->email." <br>. Hoặc gửi thông tin tại phần 'Contact( Liên Hệ)' cho chúng tôi");
                        }else{
                            $this->say("Bạn có thể gọi điện thoại tới ".$about->phone." để được nhân viên tư vấn trực tiếp");
                        }
                    }
                }
            });
        });  
    }  
    public function askForDatabase($botman)
    { 
        $question = Question::create('Đây là tin nhắn tự động! Bạn có muốn liên hệ trực tiếp với nhân viên để được tư vấn trực tiếp?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Facebook')->value('facebook'),
            Button::create('Email')->value('email'),
            Button::create('Số điện thoại')->value('phone'),
        ]); 
        $botman->ask($question, function (Answer $answer) {
                // Detect if button was clicked:
            $about = About::first(); 
            if ($answer->isInteractiveMessageReply()) { 
                //$selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                if ($selectedText == 'facebook') {
                $this->say('Bạn có thể liên hệ qua link Facebook:<br> https://www.facebook.com/CRAZY-1387478951510015/ <br> Hoặc click biểu tượng Messenger ở gốc phải màn hình'); 
                }elseif ($selectedText == 'email') {
                    $this->say("Bạn có thể liên hệ qua Email: ".$about->email." <br>. Hoặc gửi thông tin tại phần 'Contact( Liên Hệ)' cho chúng tôi");
                }else{
                    $this->say("Bạn có thể gọi điện thoại tới ".$about->phone." để được nhân viên tư vấn trực tiếp");
                }
            }
        });
    }
}
