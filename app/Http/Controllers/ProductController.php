<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\FirebaseHelper;

class ProductController extends Controller
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


        $product= $database->getReference('Products')->getValue();
        $purchase=$database->getReference('Purchases')->getValue();
        $charities=$database->getReference('Charities')->getValue();
        $donor=$database->getReference('User/DonorShopper')->getValue();


        return view('pages.manage_product', [
            'product' => $product,
            'purchase' => $purchase,
            'charity' => $charities,
            'donor' => $donor,

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
        $database = app('firebase.database');

        //Check if input image is null
        if($request->file('image') == null)
        {
            $data =[

                'price' => round((double)$request->input('price'),2),
                'listedAt' => round(microtime(true) * 1000),
                'status' => 'Listed',
                'category' => $request->input('category'),
                'size' => $request->input('size'),
                'color' => $request->input('color'),
                'sex' => $request->input('sex'),
                'listedBy' => session('adminID'),
            ];
        }
        else
        {
            $data =[
                'image' => FirebaseHelper::uploadFile($request->file('image'), 'Products/'.$request->input('id')),
                'price' => round((double)$request->input('price'),2),
                'listedAt' => round(microtime(true) * 1000),
                'status' => 'Listed',
                'category' => $request->input('category'),
                'size' => $request->input('size'),
                'color' => $request->input('color'),
                'sex' => $request->input('sex'),
                'listedBy' => session('adminID'),
            ];
        }

        $database->getReference('Products/'.$id)->update($data);

        //Send notification to Shoppers
        FirebaseHelper::sendNotification(
            'Shoppers',
            FirebaseHelper::buildNotification("New Product Listed!!", "Tap here", null),
            [
            ],
            "ic_baseline_lightbulb_circle_24"
        );


        return redirect('product')->withSuccess('Successfully Listed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
