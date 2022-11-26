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

        //Update Donation
        $database->getReference('Purchases/' . $id . '/status')->set('Accepted');
        $database->getReference('Purchases/' . $id . '/shareUrl')->set($tracking['data']['webUrl']);

        //Send Notification to Donor
        FirebaseHelper::sendNotification(
            $purchase['purchaseBy'],
            FirebaseHelper::buildNotification("Order is Accepted", "Order: " . $purchase['id'], null),
            [
                'status' => 'Accepted',
                'purchaseID' => $purchase['id']
            ],
            "ic_baseline_lightbulb_circle_24"
        );

        return redirect('purchase');
    }
}
