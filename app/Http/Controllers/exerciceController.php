<?php

namespace musicapprentice\Http\Controllers;

use Illuminate\Http\Request;
use musicapprentice\Exercice;
use musicapprentice\Session;

use musicapprentice\Category;
use Illuminate\Support\Facades\Storage;
class exerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
   //     $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $exercices = $request->user()->exercices; 
        
       // return "index";
        return $exercices; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories = Category::all();  
        return $categories;
    }


    public function uploadFile(Request $request)
    {

        $exercice = new Exercice(); 


        if ($request -> hasFile('file')){
            $file = $request->file('file');
            $oldname = $file->getClientOriginalName();
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/', $name);
            return response()->json(['name' => $oldname, 'url' => $name]); 

        }

        return "error uploading the file";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $exercice = new Exercice(); 

        $exercice->name = $request->name;
        $exercice->text = $request->text;
        $exercice->description = $request->description;
        $exercice->user_id = $request->user()->id; 
        $exercice->categoria_id = $request->categoria_id; 
        $exercice->save();

        if ($request->session_id != -1){
            $session = Session::where('id', $request->session_id)->first();
            $session->exercices()->attach($exercice,['tempo' => 120, 'seconds' => 300]);            
        }
        return response()->json(['exercice' => $exercice]); 
   //    return response()->json(['text' => 'ok'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exercice $exercice, Request $request)
    {

        return response()->json(['exercice' => $exercice, 'request' => $request]); 


        
    //    return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercice $exercice, Request $request)
    {

        return "edit";
        $categories = Category::all(); 
        return view('musicapprentice.exercices.edit', compact(['request', 'exercice', 'categories']));
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

//return $request;
        $exercice = Exercice::findOrFail($id); 
        
//return $exercice; 
         $exercice->name = $request->name;
        $exercice->text = "$request->text";
        $exercice->description = $request->description;
        $exercice->user_id = $request->user()->id; 
        $exercice->categoria_id = $request->categoria_id; 

        $exercice->save();
        return $exercice->name; 


        if ($request->session_id != -1){
            $session = Session::where('id', $request->session_id)->first();
            $session->exercices()->attach($exercice,['tempo' => 120, 'seconds' => 300]);            
        }

        $exercice->save();

        if ($request->session_id != -1){
            $session = Session::where('id', $request->session_id)->first();
            $session->exercices()->attach($exercice,['tempo' => 120, 'seconds' => 300]);            
        }
        return response()->json(['exercice' => $exercice]); 

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercice $exercice)
    {
        $exercice->delete();

        return redirect()->route('exercices.index')->with('status', 'Ejercicio borrado correctamente');

    }
}
