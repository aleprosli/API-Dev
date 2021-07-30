<?php

namespace App\Http\Controllers\API;

use App\Models\Purchase;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::all();
        $purchases = Purchase::all();
        return view('inventory.index', compact('inventories','purchases'));
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
    public function store(Request $request, Inventory $inventory)
    {
        //store purchase

        $purchase = Purchase::create([
            'user_id' => auth()->user()->id,
            'inventory_id' => $inventory->id,
            'price' => $inventory->amount,
        ]);
        
        //create bill toyyib
        $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
        
        $body = [
            'userSecretKey' => 'vhom6diw-637f-ihtz-hj1r-aiy9eegnvoug',
            'categoryCode' => 'k8sqmgm2',
            'billName' => $inventory->name,
            'billDescription' => $inventory->type,
            'billAmount' => $purchase->price,
            'billReturnUrl'=>'http://api-training.test/return-url/',
            'billCallbackUrl'=>'http://api-training.test/callback-url/',
            'billExternalReferenceNo' => $purchase->id,
            'billTo'=>auth()->user()->name,
            'billEmail'=>auth()->user()->email,
            'billPriceSetting'=>1,
            'billContentEmail'=>'Thank you for purchasing our product!',
            'billChargeToCustomer'=>1
        ];

        $response = Http::asForm()->post($url, $body);

        // dd($response->json());
        $bill_code = $response->object()['0']->BillCode;
        //update purchase with toyyibpay bill code

        $purchase->update(['toyyibpay_bill_code' => $bill_code]);
        //return to show purchase

        return redirect()->route('home');
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
