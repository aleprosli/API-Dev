<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/purchase-inventory', [App\Http\Controllers\API\PurchaseController::class, 'index'])->name('inventory');
Route::get('/purchase-inventory/{inventory}', [App\Http\Controllers\API\PurchaseController::class, 'store'])->name('inventory-purchase');

Route::get('/return-url', function (Request $request) {
    // return redirect()->route('inventory');
    // dd($request->all());
    $purchase = App\Models\Purchase::where('toyyibpay_bill_code',$request->billcode)->first();
    if($purchase){
        //validation if invalid
        if($purchase->id == $request->order_id){
        
            //update purchase
            $purchase->update(['payment_status'=>1]);
        
            //receipt
            return 'Thankyou, Payment Successfully updated';
        }
        
        return 'response is not valid';
        
    }
    else
    {
        return 'Please check your response';
    }
});

