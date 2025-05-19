<?php

namespace App\Http\Controllers;

use App\Models\Auditorium;
use Illuminate\Http\Request;

class AuditoriumController extends Controller
{
    public function addAuditorium(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:auditoriums',
            'seating_capacity' => 'required|integer|min:1',
        ]);

        $auditorium = Auditorium::create($validated);

        return response()->json([
            'message' => 'Auditorium added successfully!',
            'data' => $auditorium
        ]);
    }

    public function getAllAuditoriums()
{
    $auditoriums = Auditorium::all();

    return response()->json([
        'message' => 'All auditoriums fetched successfully.',
        'data' => $auditoriums
    ]);
}

    public function edit(Request $request, $id)
{
    $auditorium = Auditorium::find($id);

    if (!$auditorium) {
        return response()->json(['error' => 'Auditorium not found'], 404);
    }

    $request->validate([
        'name' => 'sometimes|string|max:255',
        'seating_capacity' => 'sometimes|integer|min:1',
    ]);

    $auditorium->update($request->only(['name', 'seating_capacity']));

    return response()->json(['message' => 'Auditorium updated successfully', 'auditorium' => $auditorium]);
}

public function destroy($id)
{
    $auditorium = Auditorium::find($id);

    if (!$auditorium) {
        return response()->json(['error' => 'Auditorium not found'], 404);
    }

    $auditorium->delete();

    return response()->json(['message' => 'Auditorium deleted successfully']);
}
}

