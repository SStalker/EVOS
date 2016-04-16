<?php

namespace EVOS\Http\Controllers;

use Illuminate\Http\Request;
use EVOS\Quiz;
use EVOS\Http\Requests;

class AttendeeController extends Controller
{
   public function index() {
       return view('frontend.frontendlanding');
   }

   public function storeName($attendeeName) {
       
       return view('frontend.waiting');
   }

   public function getQuiz($pin) {

       $theQuiz = Quiz::find($pin);
       //dd($keks);
       if ($theQuiz != null) {
           return "quiz_exists";
       } else {
           return "wrongpin";
       }
   }
   
   public function enterName() {
       return view('frontend.entername');
   } 
}
