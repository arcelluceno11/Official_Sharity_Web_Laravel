<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FirebaseHelper;
use Illuminate\Http\Request;

class ProfileController extends Controller
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

        //Get all the donations in Realtime Database
        $database = app('firebase.database');
        $admin = $database->getReference('Admins/'.session('adminID'))->getValue();

        return view('pages.manage_profile', [
            'admin' => $admin
        ]);
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
        //Initialzie Realtime Database
        $database = app('firebase.database');

        if($request->file('photo') != null){
            $admin = [
                'id' => $id,
                'photo' => FirebaseHelper::uploadFile($request->file('photo'), 'Admins/' . $id),
                'name' => $request->input('firstName') . ' ' . $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'updatedBy' => session('adminID')
            ];
        } else {
            $admin = [
                'id' => $id,
                'name' => $request->input('firstName') . ' ' . $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'updatedBy' => session('adminID')
            ];
        }
        $database->getReference('Admins/' . $id)->update($admin);

        return redirect('profile')->withSuccess('Successfully Updated');
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
}
