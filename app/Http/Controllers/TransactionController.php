<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FirebaseHelper;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session()->has('adminID')) {
            return redirect('/login')->withErrors(['msg' => 'Whoops! Login First.']);
        }

        return view('pages.manage_transaction');
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
        //Unique ID
        $random = sprintf("%03d", rand(1, 100));
        $date = date('mdy');
        $id = 'T' . $date . $random;

        $database = app('firebase.database');
        $charity = $database->getReference('Charities')->getValue();

        foreach ($charity as $x) {
            if ($x['id'] == $request->input('charityID')) {

                //Check if Requested Amount is bigger than Current Amount
                if ($request->input('remittedAmount') > $x['transactionDetails']['nonRemitted']) {
                    return redirect('transaction')->withErrors(['msg' => 'Remitted Amount is bigger than the current amount of the Charity! Try Again.']);
                    break;
                }
            }
        }

        $transaction = [
            'id' => $id,
            'charityID' => $request->input('charityID'),
            'remittedAmount' => round((float)$request->input('remittedAmount')),
            'remittedBy' => session('adminID'),
            'remittedDate' => round(microtime(true) * 1000),
            'remittedProof' => FirebaseHelper::uploadFile($request->file('photoProof'), 'Transaction/' . $id)
        ];
        $database->getReference('Transaction/' . $id)->set($transaction);

        foreach ($charity as $x) {
            if ($x['id'] == $request->input('charityID')) {

                $newAmount = round((float)$x['transactionDetails']['nonRemitted'] - $request->input('remittedAmount'));
                $database->getReference('Charities/' . $request->input('charityID') . '/transactionDetails/nonRemitted/')->set(round((float)$newAmount));

                $currentRemitted = $database->getReference('Charities/' . $request->input('charityID') . '/transactionDetails/remitted/')->getValue();
                if ($currentRemitted != null) {
                    $newRemittedAmnt = round((float)$x['transactionDetails']['remitted'] + $request->input('remittedAmount'));
                    $database->getReference('Charities/' . $request->input('charityID') . '/transactionDetails/remitted/')->set(round((float)$newRemittedAmnt));
                } else {
                    $database->getReference('Charities/' . $request->input('charityID') . '/transactionDetails/remitted/')->set(round((float)$request->input('remittedAmount')));
                }

                //Send Notification to Charity
                FirebaseHelper::sendNotification(
                    $request->input('charityID'),
                    FirebaseHelper::buildNotification("Fund Transfer", "An amount of PHP " .$request->input('remittedAmount')." has been transfer to your account.", null),
                    [],
                    "ic_baseline_lightbulb_circle_24"
                );
            }
        }


        return redirect('transaction')->withSuccess('Successfully Created');
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
}
