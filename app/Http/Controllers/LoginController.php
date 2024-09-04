<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class LoginController extends Controller
{
    public function index()
    {
        session()->forget('enroll_id');
        return view('login');
    }
    function login(Request $request)
    {
        $request->validate([
            'userEmail'=>'required|email',
            'userPassword'=>'required'
        ]);
        
        $enrollment = Enrollment::where('email',$request->userEmail)->Where('password',$request->userPassword)->where('user_id',2)->get();

        if(!$enrollment->isEmpty())
        { 
          foreach($enrollment as $row)
          {
             $request->session()->put(['enroll_id' => $row['id'],'user_name' => $row['name'],'profile_pic' => $row['profile_pic'],'user_id' => $row['user_id']]);   
          }
            //$request->session()->forget('enroll_id');
            return redirect('/home');
        }
        else
        {
            $request->session()->flash('message','provided credentials are incorrect!');
             return redirect('/');
        }
       
    }
    function home()
    {
        $enroll_id = session()->get('enroll_id');
        if(isset($enroll_id))
        {
            return view('home');
        }
        else
        {
            session()->flash('message','session expired please login !');
            return redirect('/');
        }
    }
    function logout(Request $request)
    {
        $request->session()->flush();
        //$request->session()->flash('message','session has expired please login again');
        return redirect('/');
    }
}
