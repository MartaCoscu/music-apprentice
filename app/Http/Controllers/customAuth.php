<?php

namespace musicapprentice\Http\Controllers;

use Illuminate\Http\Request;
use musicapprentice\Exercice;

use musicapprentice\User;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Routing\Redirector;
class customAuth extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     *//*
    protected function validator(array $data)
    {
       // return "way"; 
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
*/
    public function Register(Request $request){

    	$users = User::all();

    	foreach ($users as $myuser){
    		if ($myuser->email == $request->email){
    		//	$issue = 'El email ya está siendo usado por otra cuenta'; 
    			return response()->json(['text' =>'El email ya está siendo usado por otra cuenta', 'goHome' => false]); 
    			//	return "i"; 
    		}
    	}


    	$user = new user(); 
    	$user->name = $request->name; 		
    	$user->email = $request->email; 

    	$user->bio = $request->bio; 
    	$user->password = $request->password; 

    	$user->avatar_url = ""; 


    	$user->avatar_url = $request->image_file;
    	$user->save(); 
    	$credentials = $request->only('email', 'password'); 

    	Auth::login($user); 

    	if (Auth::check() == true){
    		return response()->json(['goHome' => true]); 
    	} else {
    		return response()->json(['goHome' => false]); 
    	}
    }


    public function LogIn(Request $request){
    	
    	$users = User::all();


		//return $request; 
		foreach ($users as $myuser){
    		if ($myuser->email == $request->email){
    			if  ($myuser->password == $request->password){
    				Auth::login($myuser); 
    				return response()->json(['goHome' => true]); 
    			}
    		}
    	}
    	return response()->json(['goHome' => false]); 
    }

    public function LogOut(){
    	Auth::LogOut(); 
    }

    public function LoggedIn(){
    	if (Auth::check() == true){
    		return response()->json(['logged' => true, 'user' => Auth::user()]);
    	} else {
    		return response()->json(['logged' => false]);
    	}
    }

    public function uploadAvatar(Request $request){
       if ($request -> hasFile('file')){
                $file = $request->file('file');
                $oldname = $file->getClientOriginalName();
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/users/', $name);
                return response()->json(['url' => $name]);
        }
    }

    public function updateuser(Request $request){
        $user = User::findOrFail($request->id); 
        $user->name = $request->name;
        $user->id = $request->id;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->avatar_url = $request->avatar_url;

        $user->save(); 


        return $user; 
//        $request->user->save(); 
    }
}
