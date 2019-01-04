<?php

namespace musicapprentice\Http\Controllers;

use Illuminate\Http\Request;
use musicapprentice\Session;
use musicapprentice\Exercice;

class sessionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sessions = $request->user()->sessions; 
        
       // return "index";
        return $sessions; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('musicapprentice.sessions.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $array = json_decode($request->exercices, true);

        $session = new Session(); 
        $session->name = $request->name; 
        $session->description = " "; 
        $session->user_id = $request->user()->id; 

        $session->save(); 

        for ($i = 0; $i < count($array); $i++) {

          //  return $myExercice;
            $exercice = Exercice::where('id', $array{$i}['id'])->first();
            $session->exercices()->attach($exercice,['tempo' => $array{$i}['tempo'], 'seconds' => $array{$i}['seconds']]); 
        }

        return response()->json(['exercice' => $request->data]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::findOrFail($id); 

        $exercices = $session->exercices; 

        return response()->json(['name' => $session->name, 'exercices'=> $exercices]); 
    }

    public function exerciceInSession(Request $request){

        $session = Session::findOrFail($request->session); 

        $exerciceObject = Exercice::findOrFail($request->exercice); 

        $exercice = $request->exercice;

        $myExercice = $session->exercices->find($exercice);

        $tempo = $myExercice->pivot->tempo;
        $seconds = $myExercice->pivot->seconds;


        return response()->json(['name' => $exerciceObject->name, 'exercice' => $exerciceObject, 'tempo' => $tempo, 'seconds' => $seconds]); 
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete(); 
        return redirect()->route('home')->with('status', 'Sesión borrada correctamente');

    }
}
