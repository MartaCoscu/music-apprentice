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

      //  return $categories;
        return view ('musicapprentice.exercices.create', compact(['categories', 'request'])); 
    }


    public function uploadFile(Request $request)
    {

            return $request->all(); 

        $exercice = new Exercice(); 


        if ($request -> hasFile('file')){
            $file = $request->file('file');
            $oldname = $file->getClientOriginalName();
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/', $name);
            $exercice->image = $name;
            return response()->json(['name' => $oldname, 'url' => $name]); 

        }

        return "hsd no file";
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

        return "ok"; 
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
        return "show";

        return view('musicapprentice.exercices.show', compact(['request', 'exercice']));

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
    public function update(Request $request, Exercice $exercice)
    {

        $validatedData = $request->validate([

            'name' => 'required',
            'description' => 'required',
            'text' => 'required',
            'image_file' => 'size:1000',
            'audio_file' => 'size:4000',
            'video_file' => 'size:15000',

        ]);

        $exercice->name = $request->name;
        $exercice->description = $request->description;
        $exercice->text = $request->text;

        $exercice->user_id = $request->user()->id; 
        $exercice->categoria_id = $request->categoria_id; 


        if ($request -> hasFile('image_file')){            
            $file = $request->file('image_file'); 
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
            $exercice->image = $name;            
        }


        if ($request -> hasFile('video_file')){
            $file = $request->file('video_file'); 
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/videos/', $name);
            $exercice->video = $name;
        }   


        if ($request -> hasFile('audio_file')){
            $file = $request->file('audio_file'); 
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/audios/', $name);
            $exercice->audio = $name;
        }   

        $exercice->save();
        if ($request->session_id != -1){
            $session = Session::where('id', $request->session_id)->first();
            $session->exercices()->attach($exercice,['tempo' => 120, 'seconds' => 300]);            
        }
        return redirect()->route('exercices.show', [$exercice])->with('status', 'Ejercicio guardado correctamente');
       // return 'update'; 
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercice $exercice)
    {

        return "destroy";
        if(!empty($exercice->image)){
            $image_path = public_path().'/images/'.$exercice->image;
            \File::delete($image_path);
        }

        if(!empty($exercice->video)){
            $video_path = public_path().'/videos/'.$exercice->video;
            \File::delete($video_path);
        }

        if(!empty($exercice->audio)){
            $audio_path = public_path().'/audios/'.$exercice->audio;
            \File::delete($audio_path);
        }



        $exercice->delete();

        return redirect()->route('exercices.index')->with('status', 'Ejercicio borrado correctamente');

    }
}
