<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(StoreContactRequest $req){

        // $data= $req->validate([
        //     'name' => 'required|alpha:ascii',
        //     'email' => 'required|email|unique:contacts,email',
        //     'subject'=> 'alpha:ascii',
        //     'message'=> 'alpha:ascii',
        // ]);
        $data= $req->validated();
        Contact::create($data);
        return back()->with('status-message', "Your message sent successfully");
    }
}
