<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('home');
    }
    public function about(){
        return view('about');
    }
    public function contact(){
        return view('contact');
    }
    public function simple(){
        return view('simple');
    }
    public function contactForm(Request $request){
        // return $request;
        return view('contact', ['data' =>$request]);
    }
    
    public function Portfolio(){
        // return $request;
        return view('Portfolio');
    }
    public function services(){
        // return $request;
        return view('services');
    }
}
