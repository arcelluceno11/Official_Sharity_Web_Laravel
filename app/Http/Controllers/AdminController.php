<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\FirebaseHelper;
use Error;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('adminID')){
            return redirect('/login')->withErrors(['msg' => 'Whoops! Login First.']);
        }

        return view('pages.manage_admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Initialzie Realtime Database
        $database = app('firebase.database');

        //Check if Email Exist
        $admins = $database->getReference('Admins')->getValue();
        if ($admins != null) {
            foreach ($admins as $x) {
                if ($x['email'] == $request->input('email')) {
                    return back()->withErrors(['emailExist' => 'Email is already taken.']);
                }
            }
        }

        //Add Admin to Realtime Database
        $id = sprintf("%08d", rand(1, floor(microtime(true) * 1000)));
        $admin = [
            'id' => $id,
            'photo' => FirebaseHelper::uploadFile($request->file('photo'), 'Admins/' . $id),
            'name' => $request->input('firstname') . ' ' . $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'updatedBy' => session('adminID')
        ];
        $database->getReference('Admins/' . $id)->set($admin);

        return redirect('admin')->withSuccess('Successfully Added.');
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
        $validate = $request->validate([
            'photo' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        //Initialzie Realtime Database
        $database = app('firebase.database');

        //Update Admin
        $admin = [
            'id' => $id,
            'photo' => FirebaseHelper::uploadFile($request->file('photo'), 'Admins/' . $id),
            'name' => $request->input('firstname') . ' ' . $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'updatedBy' => session('adminID')
        ];
        $database->getReference('Admins/' . $id)->set($admin);

        return redirect('admin')->withSuccess('Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Initialzie Realtime Database
        $database = app('firebase.database');

        //Delete Admin
        $database->getReference('Admins/' . $id)->set(null);

        return redirect('admin')->withSuccess('Successfully Deleted.');
    }
}
