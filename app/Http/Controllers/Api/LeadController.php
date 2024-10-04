<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $success = true;

        $validator = Validator::make($data,
            [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'message' => 'required|string'
            ],

            [
                'name.required' => 'Il campo nome è obbligatorio',
                'name.string' => 'Il nome deve essere un testo e non un numero',
                'name.max' => 'il nome deve contenere al massimo :max caratteri',
                'email.required' => 'Il campo email è obbligatorio',
                'email.email' => 'Inserisci un indirizzo email valido',
                'email.max' => 'L\'email deve contenere al massimo :max caratteri',
                'message.required' => 'Il campo messaggio è obbligatorio',
                'message.string' => 'Il campo messaggio deve contenere testo'

            ]
        );

        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to($new_lead->email)->send(new NewContact($new_lead));

        return response()->json(Compact('success', 'new_lead'));

    }
}
