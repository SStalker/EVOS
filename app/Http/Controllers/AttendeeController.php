<?php

namespace EVOS\Http\Controllers;

use Illuminate\Http\Request;

use EVOS\Http\Requests;

class AttendeeController extends Controller
{
   public function index() {
       return view('frontendlanding');
   } 
}
