<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Film::all(), 200);
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
            'ticket_price' => 'required',
            'country' => 'required',
            'rating' => 'required|min:1|max:5',
            'genres' => 'required|string',
            'photo' => 'required|image'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $film = $request->all();

        if ($request->file('photo') != null) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            Storage::disk('local')->put('public/' . $filename, File::get($file));
            $film['photo'] = '/storage/' . $filename;
        }

        $film['genres'] = json_decode($request->get('genres'));

        $film = Film::query()->create($film);

        return response()->json($film);
    }

    /**
     * Display the specified resource.
     *
     * @param $film
     * @return JsonResponse
     */
    public function show($film)
    {
        $film = Film::query()->with('comments.user')->where('slug', $film)->firstOrFail();
        return response()->json($film, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
    }
}
