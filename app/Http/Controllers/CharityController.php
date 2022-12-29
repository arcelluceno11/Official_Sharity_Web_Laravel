<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\FirebaseHelper;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\CharityMail;

use function Ramsey\Uuid\v1;

class CharityController extends Controller
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
        $database = app('firebase.database');

        $charities = $database->getReference('Charities')->getValue();
        $dateToday = Date("m/d/Y");

        return view('pages.manage_charity', [
            'charities' => $charities,
            'dateToday' => $dateToday
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

    //This is for Registation Charity Account
    public function store(Request $request)
    {
        return redirect('charities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        ////Create Charity Authentication


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

    //This is for Updating Manage Charity
    public function update(Request $request, $id)
    {
        $auth = app('firebase.auth');
        $database = app('firebase.database');
        $random = sprintf("%08d", rand(1,10000000));
        $pass = $random;
        $newpass = $pass;
        //Add Auth
        $charityAuth = [
                'uid' => $id,
                'email' => $request->input('accountEmail'),
                'emailVerified' => true,
                'password' => $newpass,
                'displayName' => $request->input('charityName'),
                'disabled' => false,
        ];
        $data = [
            'listedAt' => round(microtime(true) * 1000),
            'listedBy' => session('adminID'),
            'status' => 'Listed',
            'charityDetails' => [
                'charityName' => $request->input('charityName'),
                'charityPhoto' => FirebaseHelper::uploadFile($request->file('charityPhoto'), 'Charities/'.$request->input('charityName')),
                'charityCategory' => $request->input('charityCategory'),
                'charityDescription' => $request->input('charityDescription'),
                'charityAddress' => $request->input('charityAddress'),
                'charityEst' => $request->input('charityEst'),
                'charityDocuments' => FirebaseHelper::uploadFile($request->file('charityDocuments'), 'Charities/'.$request->input('charityName')),
            ],
            'bankDetails' => [
                'bankNumber' => $request->input('bankNumber'),
                'bankName' => $request->input('bankName'),
                'bankAccountName' => $request->input('bankAccountName'),
                'bankPhone' => $request->input('bankPhone'),
                'bankEmail' => $request->input('bankEmail'),
            ],
            'accountDetails' => [
                'accountEmail' => $request->input('accountEmail'),
                'accountPassword' => $newpass,
            ],
        ];

        $mailData = [
            'title' => 'Mail from Sharity',
            'charityName' => $request->input('charityName'),
            'password' => $newpass,
        ];

        try{
            $auth->createUser($charityAuth);
            $database->getReference('Charities/'.$id)->update($data);
        }
        catch(Exception){
            return back()->withErrors(['emailExist' => 'Email is already taken.']);
        }

        Mail::to($request->input('accountEmail'))->send(new CharityMail($mailData));

        return redirect('charity')->withSuccess('Successfully Listed.');
    }

    //Edit Appointment
    public function editApptDate(Request $request, $id)
    {

        $database = app('firebase.database');
        $data = [
                'applicationDate' => strtotime($request->input('applicationDate')) * 1000,
        ];
        $database->getReference('Charities/'.$id.'/applicationDetails')->update($data);
        return redirect('charity');

    }
    //Edit Listed Charity
    public function editListed(Request $request, $id)
    {
        $database = app('firebase.database');
        $data = [
            'status' => $request->input('status'),
        ];
        $datacharity = [
            'charityName' => $request->input('charityName'),
            'charityDescription' => $request->input('charityDescription'),
        ];
        $database->getReference('Charities/'.$id.'/charityDetails')->update($datacharity);
        $database->getReference('Charities/'.$id)->update($data);
        return redirect('charity');

    }
    //For Verified Users, Create Authentication

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Rejected Charity
    public function destroy($id)
    {
        //Delete Rejected Charity
        $database = app('firebase.database');
        $database->getReference('Charities/'.$id)->set(null);

        return redirect('charity');
    }
}
