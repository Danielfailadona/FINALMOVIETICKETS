<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function addMovie(Request $request)
    {
      $validator = Validator::make($request->all(), [
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'genre' => 'required|string|max:100',
    'release_date' => 'required|date',
    'duration_minutes' => 'required|integer|min:1',
    'language' => 'nullable|string|max:50',
    'amount' => 'required|numeric|min:0',
    'showing_time' => 'nullable|date_format:Y-m-d H:i:s',
    'quantity' => 'required|integer|min:0',
]);



        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

       $movie = Movie::create([
    'title' => $request->title,
    'description' => $request->description,
    'genre' => $request->genre,
    'release_date' => $request->release_date,
    'duration_minutes' => $request->duration_minutes,
    'language' => $request->language ?? 'English',
    'amount' => $request->amount,
    'showing_time' => $request->showing_time,
    'quantity' => $request->quantity,
]);



        return response()->json(['message' => 'Movie added successfully!', 'movie' => $movie], 201);
    }

    public function editMovie(Request $request, $id)
{
    $movie = Movie::find($id);

    if (!$movie) {
        return response()->json(['error' => 'Movie not found'], 404);
    }

    $validator = Validator::make($request->all(), [
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'genre' => 'required|string|max:100',
    'release_date' => 'required|date',
    'duration_minutes' => 'required|integer|min:1',
    'language' => 'nullable|string|max:50',
    'amount' => 'required|numeric|min:0',
    'showing_time' => 'nullable|date_format:Y-m-d H:i:s',
    'quantity' => 'required|integer|min:0',
]);


    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Update fields if provided
    $movie->fill($request->only([
        'title',
        'description',
        'genre',
        'release_date',
        'duration_minutes',
        'language',
    ]));

    $movie->save();

    return response()->json(['message' => 'Movie updated successfully!', 'movie' => $movie], 200);
}

public function deleteMovie($id)
{
    $movie = Movie::find($id);

    if (!$movie) {
        return response()->json(['error' => 'Movie not found'], 404);
    }

    $movie->delete();

    return response()->json(['message' => 'Movie deleted successfully.'], 200);
}

public function getAllMovies()
{
    $movies = Movie::all();
    return response()->json($movies, 200);
}


}

