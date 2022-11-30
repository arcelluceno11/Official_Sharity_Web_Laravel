<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FirebaseHelper;
use App\Http\Helpers\TeliverHelper;
use Illuminate\Http\Request;

class PurchaseController extends Controller
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

        return view('pages.manage_purchase');
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

    public function acceptPurchase($id)
    {
        //Create Task
        $database = app('firebase.database');
        $purchase = $database->getReference('Purchases/' . $id)->getValue();

        //Create Task
        $task = TeliverHelper::createPickupTask(
            $purchase['id'],
            $purchase['purchaseBy'],
            $purchase['contactAddress']['longitude'],
            $purchase['contactAddress']['latitude'],
            $purchase['contactAddress']['name'],
            $purchase['contactAddress']['address'],
            $purchase['contactAddress']['phone']
        );
        $tracking = TeliverHelper::getTrackingUrlTask($task['data']['task']['task_id']);

        //Update Product
        foreach ($purchase['products'] as $product) {
            $database->getReference('Products/' . $product['id'] . '/status')->set('Sold');
        }

        //Update Purchase
        $database->getReference('Purchases/' . $id . '/status')->set('Accepted');
        $database->getReference('Purchases/' . $id . '/shareUrl')->set($tracking['data']['webUrl']);

        //Update Charity Transaction Details (nonRemitted)
        foreach($purchase['products'] as $product){
            //Percentage of the Sales to Charity
            $percent = $product['price'] * .90;

            $currentNonRemitted = $database->getReference('Charities/' . $product['donatedTo']. '/transactionDetails/nonRemitted/')->getValue();
            if($currentNonRemitted != null){
                $database->getReference('Charities/' . $product['donatedTo']. '/transactionDetails/nonRemitted/')->set(round((double) $percent + $currentNonRemitted));
            } else {
                $database->getReference('Charities/' . $product['donatedTo']. '/transactionDetails/nonRemitted/')->set(round((double) $percent));
            }
        }

        //Send Notification to Shopper
        FirebaseHelper::sendNotification(
            $purchase['purchaseBy'],
            FirebaseHelper::buildNotification("Order is Accepted", "Order: " . $purchase['id'], null),
            [
                'status' => 'Accepted',
                'purchaseID' => $purchase['id']
            ],
            "ic_baseline_lightbulb_circle_24"
        );

        return redirect('purchase')->withSuccess('Successfully Accepted.');
    }

    public function rejectPurchase($id)
    {
        //Update Donation
        $database = app('firebase.database');
        $database->getReference('Purchases/' . $id . '/status')->set('Rejected');

        return redirect('purchase')->withSuccess('Successfully Rejected.');
    }

    public function assignDriver(Request $request, $taskid)
    {
        //Assign Driver
        $trip = TeliverHelper::assignDriver($taskid, $request->input('driverID'));

        //Update Purchase
        $database = app('firebase.database');
        $database->getReference('Purchases/' . $trip['data']['task']['order_id'] . '/status')->set('Assigned');
        $database->getReference('Purchases/' . $trip['data']['task']['order_id'] . '/deliverBy')->set($trip['data']['task']['driver']['name']);

        //Send Notification to Driver
        FirebaseHelper::sendNotification(
            $request->input('driverID'),
            FirebaseHelper::buildNotification("Task Reminder", "A new order assigned to you", null),
            [],
            'ic_baseline_assignment_turned_in_24'
        );

        //Send Notification to Shopper
        FirebaseHelper::sendNotification(
            $trip['data']['task']['notes'],
            FirebaseHelper::buildNotification("Order is Assigned", "Order: " . $trip['data']['task']['order_id'], null),
            [
                'status' => 'Assigned',
                'orderID' => $trip['data']['task']['order_id'],
            ],
            "ic_baseline_lightbulb_circle_24"
        );

        return redirect('purchase')->withSuccess('Successfully Assigned.');
    }

}
