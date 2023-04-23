<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    //
    public function showServiceProviderTest()
    {
        $sample = app()->make('serviceProviderTest');
        dd($sample);
    }



    public function showServiceContainerTest()
    {
        app()->bind('lifeCycleTest', function () {
            return 'ライフサイクルテスト';
        });

        $test = app()->make('lifeCycleTest');

        //$message = new Message();
        //$sample = new Samlpe($message);
        //$sample->run();

        app()->bind('sample', Samlpe::class);
        $sample = app()->make('sample');
        $sample->run();


        dd($test, app());
    }
}

class Samlpe
{
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function run()
    {
        $this->message->send();
    }
}

class Message
{
    public function send()
    {
        echo('メッセージ表示');
    }
}
