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
        // Create the new item
        $item = new Item();
        $item->phone = $request->PhoneNumber;
        $item->brand = $request->BrandAndModel;
        $item->clean_level = $request->PreferredCleaningLevel;
        $item->email = $request->Email;
        $item->device_type = $request->DeviceType;
        $item->device_condition = $request->DeviceCondition;
        $item->service_type = $request->ServiceType;
        $item->contact_method = $request->PreferredContactMethod;
        $item->user_id = $request->user_id;
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

    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Approved,Rejected',
        ]);

        // Find the item by ID
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Update the status
        $item->status = $validated['status'];
        $item->save();

        // Return the updated item
        return response()->json([
            'message' => 'Item status updated successfully.',
            'item' => $item,
        ], 200);
    }

}
