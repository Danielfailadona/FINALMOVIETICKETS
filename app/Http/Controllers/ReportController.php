<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function ticketSalesReport(Request $request)
    {
        $query = DB::table('tickets')
            ->join('showtimes', 'tickets.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->selectRaw('movies.title, SUM(tickets.quantity) as total_tickets, SUM(tickets.total_price) as total_sales')
            ->groupBy('movies.id', 'movies.title');

        // Optional date filter
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tickets.created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $report = $query->get();

        return response()->json([
            'message' => 'Ticket sales report generated successfully.',
            'data' => $report
        ]);
    }
}
