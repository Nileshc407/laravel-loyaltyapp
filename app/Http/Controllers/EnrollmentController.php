<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Enrollment;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Mail;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $enroll_id = session()->get('enroll_id');
        if(isset($enroll_id))
        {
            $search = $request['search'] ?? "";

            if($search != "")
            {
                $result = Enrollment::where('name', 'LIKE' ,"%$search%")->orWhere('email','LIKE',"%$search%")->paginate(10);
            }
            else
            {
                //$result = Enrollment::all(); // fetch all record 
             
                //  $result = Enrollment::paginate(10);
              
                $result =  Enrollment::with('Country')->with('State')->with('City')->paginate(10);
              
            }
           
            $country = Country::all();

            $data = compact('result','country','search');

            return view("enrollment")->with($data);
        }
        else
        {
             return redirect('/');
        }
    }
    function enrollment(Request $request)
    {
        $enroll_id = session()->get('enroll_id');
        if(isset($enroll_id))
        {
            $request->validate([
                "name"=>"required",
                "email"=>["required","email"],
                "phone"=>["required","regex:/^[0-9]{10}$/"],
                "userType"=>"required",
                "country"=>"required",
                "state"=>"required",
                "city"=>"required",
                "gender"=>"required"
            ]);
            
            $UserEmail = Enrollment::where('email',$request->email)->get();
            
            if($UserEmail->isEmpty())
            {
                $UserPhone = Enrollment::where('phone',$request->phone)->get();

                if($UserPhone->isEmpty())
                {
                    $enrollment = new Enrollment;
                    
                    //$fileName = time().$request['phone'].".".$request->file('image')->getClientOriginalExtension();
                    // $request->file('image')->storeAs('uploads',$fileName);

                    $profilepic = $request->file('image');
                    if($profilepic != Null){
                        $fileName = time().$request['phone'].".".$profilepic->getClientOriginalExtension();
                        $profilepic->move('uploads/profilePic/',$fileName);
                    }
                    else
                    {
                        $fileName = null;
                    }
                  
                    $enrollment->name = $request['name'];
                    $enrollment->phone = $request['phone'];
                    $enrollment->email = $request['email'];
                    $enrollment->password = $request['phone'];
                    $enrollment->country_id = $request['country'];
                    $enrollment->state_id = $request['state'];
                    $enrollment->city_id = $request['city'];
                    $enrollment->address = $request['address'];
                    $enrollment->profession = $request['profession'];
                    $enrollment->user_id = $request['userType'];
                    $enrollment->gender = $request['gender'];
                    $enrollment->remark = $request['remark'];
                    $enrollment->profile_pic = $fileName;
                   
                    $enrollment->save();

                    $data = ['name'=>'nilesh',
                            'user_email'=> $request['email'],
                            'phone'=>$request['phone'],
                            'email_body'=>'Thank you for enrolling for our loyalty app Your registration has been received succesfully.'
                        ];

                    $user['to'] = $request['email'];
                    $user['attachment'] = 'uploads/profilePic/'.$fileName;

                    Mail::send('mail',$data,function($message) use ($user)
                    {
                        $message->to( $user['to']);
                        $message->subject('Registration succesfull');
                        $message->attach($user['attachment']);
                    });

                    $request->session()->flash('message','enrollment done sucessfully');
                }
                else
                {
                    $request->session()->flash('message','phone number is already exits!');
                }
            }
            else
            {
                $request->session()->flash('message','email address is already exits!');

            }

            return redirect('/enrollment'); 
        }
        else
        {
            return redirect('/');
        }
    }
    function edit($id)
    {
        $enroll_id = session()->get('enroll_id');
        if(isset($enroll_id))
            {
            $enrollment = Enrollment::find($id);
            if(!is_null($enrollment))
            {
               // $result = Enrollment::paginate(10);
                $result =  Enrollment::with('Country')->with('State')->with('City')->paginate(10);

                $country = Country::all();

                $state = State::where('country_id', $enrollment->country_id)->get();

                $city = City::where('state_id',$enrollment->state_id)->get();

                $data = compact('result','enrollment','country','state','city');

                return view('edit_enrollment')->with($data);
            }
            else
            {
                session()->flash('message','record not found!');

                return redirect('/enrollment');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    function update($id, Request $request){
        
        $enroll_id = session()->get('enroll_id');
        if(isset($enroll_id))
        {
            $enrollment = Enrollment::find($request->id);

            $request->validate([
                "name"=>"required",
                "email"=>["required","email"],
                "phone"=>["required","regex:/^[0-9]{10}$/"],
                "userType"=>"required",
                "country"=>"required",
                "state"=>"required",
                "city"=>"required"
            ]);

            $UserEmail = Enrollment::where('email',$request->email)->get();
            if($request['email'] == $enrollment->email)
            {
                $UserEmail = '';
            }
            //if($UserEmail->isEmpty())
            if(empty($UserEmail))
            {
                $UserPhone = Enrollment::where('phone',$request->phone)->get();
                if($request['phone'] == $enrollment->phone){
                    $UserPhone = '';
                }
                if(empty($UserPhone))
                {   
                    $profilepic = $request->file('image');
                    if($profilepic != Null)
                    {
                        $fileName = $request['phone'].".".$profilepic->getClientOriginalExtension();

                        $filePath = 'uploads/profilePic/'.$fileName;
    
                        if(Storage::exists($filePath))
                        {
                            Storage::delete($filePath);
                        }
                      
                        $profilepic->move('uploads/profilePic/',$fileName);
                       
                    }
                    else
                    {
                        $fileName = null;
                    }
                   
                    $enrollment->name = $request['name'];
                    $enrollment->phone = $request['phone'];
                    $enrollment->email = $request['email'];
                    $enrollment->password = $request['phone'];
                    $enrollment->country_id = $request['country'];
                    $enrollment->state_id = $request['state'];
                    $enrollment->city_id = $request['city'];
                    $enrollment->address = $request['address'];
                    $enrollment->profession = $request['profession'];
                    $enrollment->user_id = $request['userType'];
                    $enrollment->gender = $request['gender'];
                    $enrollment->remark = $request['remark'];
                    $enrollment->profile_pic = $fileName;
                    $enrollment->save();

                    $request->session()->flash('message','enrollment details updated sucessfully');
                    return redirect('/enrollment');
                }
                else
                {
                    $request->session()->flash('message','phone number is already exits!');
                 
                    return redirect(route('enrollment.edit',['id'=>$request->id]));
                }
            }
            else
            {
                $request->session()->flash('message','email address is already exits!');
            
                return redirect(route('enrollment.edit',['id'=>$request->id]));
            }
           
        }
        else{
            return redirect('/');
        }
    }
    function delete($id)
    {
        $enroll_id = session()->get('enroll_id');
        if(isset($enroll_id))
        {
                
            $enrollment  = Enrollment::find($id);
            if(!is_null($enrollment))
            {
                $enrollment->delete();

                session()->flash('message','enrollment record has been deleted sucessfully');
            }
        return redirect('/enrollment');
        }
        else
        {
            return redirect('/');
        }
    }
    function get_state(Request $request)
    {
        $countryId = $request->input('country_id');
        $states = State::where('country_id', $countryId)->get();
      
         return response()->json($states);
    }
    function get_city(Request $request){
        $stateId = $request->input('state_id');
        $cities = City::where('state_id',$stateId)->get();
        return response()->json($cities);
    }
    function get_enrollment()
    {
        return Enrollment::with('Country')->with('State')->with('City')->get();
    }
    function get_country(Country $id)
    {
        echo $id;
    }
}
