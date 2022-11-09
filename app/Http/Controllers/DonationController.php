<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\TeliverHelper;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all the donations in Realtime Database
        $database = app('firebase.database');
        $donations = $database->getReference('Donations')->getValue();
        $drivers = $database->getReference('Drivers')->getValue();

        //Get all task from Teliver API
        $tasks = TeliverHelper::getTasks();

        return view('pages.manage_donation', [
            'donations' => $donations,
            'tasks' => $tasks,
            'drivers' => $drivers,
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
        //
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

    public function acceptDonation($id){

        //Create Task
        $database = app('firebase.database');
        $donation = $database->getReference('Donations/'.$id)->getValue();
        $task = TeliverHelper::createPickupTask(
            $donation['id'],
            $donation['contactAddress']['longitude'],
            $donation['contactAddress']['latitude'],
            $donation['contactAddress']['name'],
            $donation['contactAddress']['address'],
            $donation['contactAddress']['phone']
        );

        //Update Donation
        $tracking = TeliverHelper::getTrackingUrlTask($task['data']['task']['task_id']);
        $database->getReference('Donations/'.$id.'/status')->set('Accepted');
        $database->getReference('Donations/'.$id.'/shareUrl')->set($tracking['data']['webUrl']);

        return redirect('donation');
    }

    public function assignDriver(Request $request, $taskid){
        //Assign Driver
        $trip = TeliverHelper::assignDriver($taskid, $request->input('driverID'));

        //Update Donation
        $database = app('firebase.database');
        $database->getReference('Donations/'.$trip['data']['task']['order_id'].'/status')->set('Assigned');
        $database->getReference('Donations/'.$trip['data']['task']['order_id'].'/pickUpBy')->set($trip['data']['task']['driver']['name']);

        return redirect('donation');
    }
}
