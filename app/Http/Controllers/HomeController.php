<?php

namespace musicapprentice\Http\Controllers;

use Illuminate\Http\Request;
use musicapprentice\Exercice;
use musicapprentice\Session;

class HomeController extends Controller
{
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $test = "test";
     //   $user = $request->user; 
    /*    $exercices = Exercice::where('user_id', '=', $request->user()->id)->simplePaginate(3);
        $sessions = Session::where('user_id', '=', $request->user()->id)->simplePaginate(3);

        return view('home', compact(['request', 'exercices', 'sessions']));
      //  return $request->user();
  //      return $request->getContent(); */

       // return $request;
        return view('home');

    }
}
