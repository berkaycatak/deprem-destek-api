<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pin;
use Illuminate\Http\Request;

class PinController extends Controller
{
    public function list(Request $request){
        $pins = Pin::where("status", 0)->get();
        return $pins;
    }

    public function show(Request $request){
        $pin = Pin::find($request->id);
        return $pin;
    }

    public function store(Request $request){
        $pin = new Pin();
        $pin->lat = $request->lat;
        $pin->lng = $request->lng;
        $pin->description = $request->description;
        $pin->name_surname = $request->name_surname;
        $pin->phone_number = $request->phone_number;
        $pin->who = $request->who;
        $check = $pin->save();

        if ($check)
            return $pin;
        else
            return json_encode(["error" => 1, "message" => "Pin eklenirken hata oluştu"]);
    }

    public function status(Request $request){
        $pin = Pin::find($request->id);
        $pin->status = $request->status;
        $save = $pin->save();
        return $save;
    }
}

