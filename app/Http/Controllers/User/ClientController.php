<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\User;
use Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }
    public function index()
    {
        return view('user.profile.info');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $users = User::where('username', $username)->first();
        return view('user.profile.edit',compact('users'));
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
        // Validation
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ],
        [
            'first_name.required' => 'Field first name is required.',
            'last_name.required' => 'Field last name is required.',
            'address.required' => 'Field address is required.',
            'phone.required' => 'Field phone is required.',
            'email.required' => 'Field email is required.',
            'email.email' => 'Malformed email.',
            'email.unique' => 'Email already exists.',
        ]);

        $users= User::findOrfail($id);
        if (isset($users))
        {
            $users->first_name = $request->first_name;
            $users->last_name = $request->last_name;
            $users->address = $request->address;
            $users->phone = $request->phone;
            $users->email = $request->email;
            $users->isdelete = false;
            $users->update();
        }else{
            return back()->with('err','Save error!');
        }
        return redirect('/profile')->with('message','Edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }  
    public function feedback()
    {
        return view('user.profile.feedback');
    }
}
