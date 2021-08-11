<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\UsersLaratables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Laratables::recordsOf(User::class, UsersLaratables::class);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->email),
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->route('users.index')->with('success','User created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }
    public function admin($id)
    {
        $user = User::find($id);
        return view('users.admin',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            
            
        ]);
        $id = Auth()->user()->id;
        
        $user = User::where('id', $id)->get();
        foreach ($user as $alistar) {
            # code...
            $alistar->update([
                'name' => $request['name'],
                'email' => $request['email'],
            ]);
        }
        
        //$user->save();
        return redirect()->back()->with('success','Profile Updated Successfully');
    }
    public function adminUpdate(Request $request)
    {   
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'min:8', 'string'],
            'confirm_password' => 'required',
            'id' => 'required'
            
            
            
        ]);
        $id = $request->id;
        if ($request['password'] != $request['confirm_password']) {
            # code...
            return redirect()->back()->with('error', 'Password and Confirm Password DO NOT MATCH!!');
        }
        
        $user = User::where('id', $id)->get();
        foreach ($user as $adm) {
            # code...
            $adm->update([
                'name' => $request['name'],
                'password' => bcrypt($request['password']),
            ]);
        }
        
        //$user->save();
        return redirect()->route('users.index')->with('success','User Updated Successfully');
    }

    public function updatePassword(Request $request){
        //validate the user's inputs
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'min:8', 'string'],
            'confirm_password' => 'required'
        ]);
        $id = Auth()->user()->id;
        
        //Lets make sure the two passwords are similar
        if($request['password'] != $request['confirm_password']){
            return redirect()->back()->with('error', 'Password and confirm password fields DO NOT MATCH!!');
        }
        //Lets make the updates
        $old_password = $request->old_password;
        //dd($old_password);
        
             $user = User::where('id', $id)->get();
 
             foreach($user as $adm){
                 if(Hash::check($old_password, $adm->password)){
                     
                     //Sorry youv'e been waiting for this 
                     $user = User::find($id);
                     //dd($user);
                     $user->update([
                         'password' => bcrypt($request->password),
                     ]);
             
                     return redirect()->route('users.show', $id)->with('success', 'password updated successfully');
                    
 
                 } else{
                     
                     return redirect()->back()->with('error', 'The Old Password is wrong, Try again!');
                 }
             
                }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('users.index')->with('success','User Deleted Successfully');
    }
}
