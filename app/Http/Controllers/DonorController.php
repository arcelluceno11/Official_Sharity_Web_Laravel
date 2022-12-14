<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\FirebaseHelper;

use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $database = app('firebase.database');
        $manage_donor = $database->getReference('User/DonorShopper')->getValue();
        $manage_contact = $database->getReference('ContactAddresses')->getValue();

        return view('pages.manage_donor', [
            'manage_donor' => $manage_donor,
            'manage_contact' => $manage_contact
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Physical Delete
        $database = app('firebase.database');
        $database->getReference('User/DonorShopper/'.$id)->set(null);

        return redirect('manage_donor');
        */

        /*
        $database = app('firebase.database');

        $data = [
            'status' => 'Inactive'
        ];

        $database->getReference('User/DonorShopper/'.$id)->update($data);

        return redirect('donor');*/
    }
}
