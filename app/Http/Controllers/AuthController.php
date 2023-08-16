<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use App\Models\Employee;

class AuthController extends Controller
{

    public function index()
    {
        if(Auth::check()){
            return redirect('/employee');
        }

        return view('login');
    } 

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect('/employee')
                        ->withSuccess('Signed in');
        }

   
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        $departments = Department::get();

        return view('registration',compact('departments'));
    }
       
 
    public function customRegistration(Request $request)
    {  
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => 'required|email|unique:employee,email',
            'phone' => 'required|unique:employee,phone',
            'department_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->with('errors', $validator->errors())
                ->withInput();
        }
         
        $this->create($data);
          
        return redirect('login')
                        ->withSuccess('registration successful');
    }

    public function create(array $data)
    {
      return Employee::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'remarks' => $data['remarks'],
        'department_id' => $data['department'],
      ]);
    } 
 
    public function signOut() {
        Auth::logout();
   
        return Redirect('login');
    }
}
