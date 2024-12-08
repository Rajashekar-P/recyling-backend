<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function addFeedback(Request $request)
    {
        $item = new Feedback();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->rating = $request->rating;
        $item->message = $request->message;
        $item->save();

        // Return a success response
        return response()->json([
            'message' => 'FeedBack created successfully',
        ], 200);
    }

    public function index()
    {
        $feedbacks = Feedback::all();
        return $feedbacks;
    }

}
