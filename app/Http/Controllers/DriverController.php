<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\FirebaseHelper;
use App\Http\Helpers\TeliverHelper;
use App\Mail\DriverMail;
use Illuminate\Support\Facades\Mail;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $database = app('firebase.database');
        $drivers = $database->getReference('Drivers')->getValue();

        return view('pages.manage_driver', [
            'drivers' => $drivers
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
        //Unique Code
        $id = sprintf("%06d", rand(1, 100000));

        //Create Teliver Driver
        $fullName = $request->input('fname').' '.$request->input('mname').' '.$request->input('lname');
        TeliverHelper::createDriver($id, $fullName, $request->input('phone'), $request->input('email'));

        //Add driver to Realtime Database
        $database = app('firebase.database');
        $driver = [
            'code' => $id,
            'photo' => FirebaseHelper::uploadFile($request->file('photo'), 'Drivers/'.$request->input('email')),
            'firstName' => $request->input('fname'),
            'middleName' => $request->input('mname'),
            'lastName' => $request->input('lname'),
            'phone' => $request->input('phone'),
            'sex' => $request->input('sex'),
            'dob' => $request->date('dob'),
            'contactAddress' => $request->input('contactAddress'),
            'email' => $request->input('email'),
            'status' => 'Unavailable',
            'registeredAt' => date("Y-m-d h:i:s"),
        ];
        $database->getReference('Drivers/'.$id)->set($driver);

        //Send an Email to Driver
        $mailData = [
            'title' => 'Mail from Sharity',
            'lname' => $request->input('lname'),
            'code' => $id,
        ];
        Mail::to($request->input('email'))->send(new DriverMail($mailData));

        return redirect('driver');
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
        $database = app('firebase.database');
        $driver = [
            'firstName' => $request->input('fname'),
            'middleName' => $request->input('mname'),
            'lastName' => $request->input('lname'),
            'phone' => $request->input('phone'),
            'sex' => $request->input('sex'),
            'dob' => $request->date('dob'),
            'contactAddress' => $request->input('contactAddress'),
        ];
        $database->getReference('Drivers/'.$id)->update($driver);

        return redirect('driver');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $database = app('firebase.database');
        $driver = [
            'status' => 'Disabled',
        ];
        $database->getReference('Drivers/'.$id)->update($driver);

        return redirect('driver');
    }
}
