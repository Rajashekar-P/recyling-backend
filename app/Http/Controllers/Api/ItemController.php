<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Store a new item.
     */
    public function addItem(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'phone' => 'required|string|max:15',
        //     'brand' => 'required|string|max:255',
        //     'clean_level' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'device_type' => 'required|string|max:255',
        //     'device_condition' => 'required|string|max:255',
        //     'service_type' => 'required|string|max:255',
        //     'contact_method' => 'required|string|max:255',
        //     'item_id' => 'required|exists:items,id',
        // ]);

        // Create the new item
        $item = new Item();
        $item->phone = "9951";
        $item->brand = $request->BrandAndModel;
        $item->clean_level = "basic";
        $item->email = $request->Email;
        $item->device_type = "Test";
        $item->device_condition = $request->DeviceCondition;
        $item->service_type = $request->ServiceType;
        $item->contact_method = "Email";
        $item->item_id = 6;
        $item->save();

        // Return a success response
        return response()->json([
            'message' => 'Item created successfully',
        ], 200);
    }

    public function index()
    {
        $items = Item::all();
        return $items;
    }

    public function update(Request $request, $id)
    {
        // Find the item by ID
        $item = Item::find($id);

        // Check if the item exists
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Validate the incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:items,email,' . $item->id,
        ]);

        // Update the item fields
        $item->first_name = $validatedData['first_name'];
        $item->last_name = $validatedData['last_name'];
        $item->name = $validatedData['name'];
        $item->email = $validatedData['email'];
        $item->status = $validatedData['status'];
        $item->save(); // Save the updated item data to the database

        // Return the updated item data
        return response()->json([
            'message' => 'Item updated successfully',
            'item' => $item
        ], 200);
    }

}
