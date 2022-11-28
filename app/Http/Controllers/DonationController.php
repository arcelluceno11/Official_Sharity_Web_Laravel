<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FirebaseHelper;
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
        if(!session()->has('adminID')){
            return redirect('/login')->withErrors(['msg' => 'Whoops! Login First.']);
        }

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

    public function acceptDonation($id)
    {

        //Create Task
        $database = app('firebase.database');
        $donation = $database->getReference('Donations/' . $id)->getValue();

        //Create Task
        $task = TeliverHelper::createPickupTask(
            $donation['id'],
            $donation['donatedBy'],
            $donation['contactAddress']['longitude'],
            $donation['contactAddress']['latitude'],
            $donation['contactAddress']['name'],
            $donation['contactAddress']['address'],
            $donation['contactAddress']['phone']
        );
        $tracking = TeliverHelper::getTrackingUrlTask($task['data']['task']['task_id']);

        //Update Donation
        $database->getReference('Donations/' . $id . '/status')->set('Accepted');
        $database->getReference('Donations/' . $id . '/shareUrl')->set($tracking['data']['webUrl']);

        //Send Notification to Donor
        FirebaseHelper::sendNotification(
            $donation['donatedBy'],
            FirebaseHelper::buildNotification("Order is Accepted", "Order: " . $donation['id'], null),
            [
                'status' => 'Accepted',
                'orderID' => $donation['id']
            ],
            "ic_baseline_lightbulb_circle_24"
        );

        return redirect('donation');
    }

    public function rejectDonation($id)
    {

        //Update Donation
        $database = app('firebase.database');
        $database->getReference('Donations/' . $id . '/status')->set('Rejected');

        return redirect('donation');
    }

    public function assignDriver(Request $request, $taskid)
    {
        //Assign Driver
        $trip = TeliverHelper::assignDriver($taskid, $request->input('driverID'));

        //Update Donation
        $database = app('firebase.database');
        $database->getReference('Donations/' . $trip['data']['task']['order_id'] . '/status')->set('Assigned');
        $database->getReference('Donations/' . $trip['data']['task']['order_id'] . '/pickUpBy')->set($trip['data']['task']['driver']['name']);

        //Send Notification to Driver
        FirebaseHelper::sendNotification(
            $request->input('driverID'),
            FirebaseHelper::buildNotification("Task Reminder", "A new order assigned to you", null),
            [],
            'ic_baseline_assignment_turned_in_24'
        );

        //Send Notification to Donor
        FirebaseHelper::sendNotification(
            $trip['data']['task']['notes'],
            FirebaseHelper::buildNotification("Order is Assigned", "Order: " . $trip['data']['task']['order_id'], null),
            [
                'status' => 'Assigned',
                'orderID' => $trip['data']['task']['order_id'],
            ],
            "ic_baseline_lightbulb_circle_24"
        );

        return redirect('donation');
    }

    public function qualityCheckedPiece(Request $request, $id)
    {
        //Initialize Firebase
        $database = app('firebase.database');
        $items = $database->getReference('Donations/' . $id . '/items')->getValue();
        $donation = $database->getReference('Donations/' . $id)->getValue();

        $num = 1;
        foreach ($items as $item) {
            //Update Donation Item Status
            $database->getReference('Donations/' . $id . '/items//' . $item['id'] . '/status')->set($request->input('status' . $item['id'] . $num));

            //Add Item to Product if Accepted'
            if ($request->input('status' . $item['id'] . $num) == "Accepted") {
                $key = $database->getReference('Products')->push()->getKey();
                $product = [
                    'id' => $key,
                    'category' => $item['category'],
                    'color' => $item['color'],
                    'image' => $item['charityDetails'],
                    'sex' => $item['sex'],
                    'size' => $item['size'],
                    'donatedBy' => $donation['donatedBy'],
                    'donatedTo' => $donation['donatedTo'],
                    'status' => 'Pending',
                    'price' => '',
                    'listedAt' => '',
                    'listedBy' => '',
                ];
                $database->getReference('Products/' . $key)->set($product);
            }

            $num++;
        }

        //Update Check
        $database->getReference('Donations/' . $id . '/checked')->set(true);

        return redirect('donation');
    }

    public function qualityCheckedBulk(Request $request, $id)
    {
        //Initialize Firebase
        $database = app('firebase.database');
        $donation = $database->getReference('Donations/' . $id)->getValue();

        $num = 1;
        while ($request->input('category' . $num) != null) {
            $key = $database->getReference('Products')->push()->getKey();
            $product = [
                'id' => $key,
                'category' => $request->input('category' . $num),
                'color' => $request->input('color' . $num),
                'image' => FirebaseHelper::uploadFile($request->file('photo'.$num), 'Drivers/'.$key),
                'sex' => $request->input('sex' . $num),
                'size' => $request->input('size' . $num),
                'donatedBy' => $donation['donatedBy'],
                'donatedTo' => $donation['donatedTo'],
                'status' => 'Pending',
                'price' => '',
                'listedAt' => '',
                'listedBy' => '',
            ];
            $database->getReference('Products/' . $key)->set($product);

            $num++;
        }

        //Update Check
        $database->getReference('Donations/' . $id . '/checked')->set(true);

        return redirect('donation');
    }
}
