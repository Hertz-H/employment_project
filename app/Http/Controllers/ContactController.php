<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function load(){

        return view('template.contact_us');
    }
}
