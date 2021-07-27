<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $inventories = Inventory::where('type','LIKE','%'.$request->search.'%')->paginate();
        }
        else{
            $inventories = Inventory::paginate();
        }
        //query all users from DB using Model Inventory.php
        
        //return to json
        return response()->json([
            'success' => true,
            'message' => 'Successfully show all inventory',
            'data' => $inventories
        ]);
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'min:3',
            'serialnumber' => 'required',
            'type' => 'required'
        ]);

        //store to DB using Inventory Model
        $inventories = Inventory::create([
            'name' => $request->name,
            'serialnumber' => $request->serialnumber,
            'type' => $request->type
        ]);

        //return success

        return response()->json([
            'success' => true,
            'message' => 'Successfully store inventory',
            'data' => $inventories
        ]);
    }
}
