<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function purchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pricePerTicket = 10; // Adjust as needed
        $totalAmount = $pricePerTicket * $request->quantity;

        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);

        return response()->json(['message' => 'Tickets purchased successfully!', 'ticket' => $ticket], 201);
    }

    public function viewAllPurchases()
{
    $tickets = Ticket::with(['user', 'movie'])->get();

    return response()->json([
        'message' => 'All ticket purchases retrieved successfully',
        'data' => $tickets
    ]);

}

}
