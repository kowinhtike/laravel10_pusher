<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    //

    public function pushMessage(Request $request){
        event(new MyEvent($request->text));
        return "send successfully!";
    }
}
