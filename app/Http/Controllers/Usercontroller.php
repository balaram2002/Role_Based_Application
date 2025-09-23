<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{

   public function register(Request $req){
    //print_r($req);die();
    $validated = $req->validate([
        'name' => 'required',
        'email' => 'required|email|unique:students,email',
        'phone' => 'required|digits:10',
        'password' => 'required|confirmed|min:6',
 ]);

    $student = new Student();
    $student->name = $req->input('name');
    $student->email = $req->input('email');
    $student->phone = $req->input('phone');
    $student->password = Hash::make($req->input('password'));
    $student->save();
    return redirect('/login');
   }



 public function login(Request $req)
 {
     $credentials = $req->validate([
         'email' => 'required|email',
         'password' => 'required',
     ]);
 
     if (Auth::attempt($credentials)) {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('all')->with('success', 'Welcome Admin!');
        }

         return redirect()->route('dashboard');
     }
 
     return back()->with('error', 'Invalid email or password');
 }
 

public function dashboardPage(){
    if (Auth::check() ) {
        return view('show');
    } else {
        return redirect()->route('login');
    }
}

public function logout(){
   Auth::logout();
   return redirect()->route('login');

}


   public function updateDetails(Request $request)
   {
       $userId = Auth::user()->id; 
       $student = Student::find($userId);
   
       if ($student) {
           $student->height = $request->input('height');
           $student->weight = $request->input('weight');
           $student->gender = $request->input('gender');
           $student->save();
       }
   
       return back();
   }

   public function alluser(){

    if (Auth::check() ) {
    $users = Student::paginate(10); 
    return view('alluserdetails', compact('users'));
    } else {
        return redirect()->route('login');
    }

    }
    
    public function updateRole(Request $request, $id)
    {
        $student = Student::findOrFail($id);
    
        if ($student->role === 'admin') {
            return back()->with('error', 'Admin role cannot be changed!');
        }
    
        if ($request->role === 'Coach') {
            $student->coach_id = null; 
        }
    
        $student->role = $request->role;
        $student->save();
    
        return back()->with('success', 'Role updated successfully!');
    }
    

public function assignUserToCoach(Request $request, $coachId)
{
    $request->validate([
        'user_id' => 'required|exists:students,id',
    ]);

    $student = Student::findOrFail($request->user_id);

    $student->coach_id = $coachId;
    $student->save();

    return back();
}


public function showCoaches()
{
    $coach = Auth::user();
    
    if (!$coach) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $coaches = Student::where('role', 'Coach')->with('assignedUsers')->paginate(10); 

    $allUsers = Student::where('role', 'User')->get();

    return view('coach', compact('coaches', 'allUsers'));
}


// public function coach()
// {

//     $coaches = Student::where('role', 'Coach')->with('assignedUsers')->get();
//     $allUsers = Student::all();

//     return view('coach', compact('coaches', 'allUsers'));
// }

public function myUsers()
{
    $coach = Auth::user();
    
    if (!$coach) {
      
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    if ($coach->role !== 'Coach') {
        
        return back()->with('error', 'Only coaches can view this page.');
    }

    $users = Student::where('coach_id', $coach->id)->get();

    return view('coach_users', compact('users'));
}



   
 }
