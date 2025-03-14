<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Actor;
use App\Http\Resources\FilmResource;
use App\Http\Resources\ActorResource;
use Exception;
use Illuminate\Database\QueryException;

class ActorFilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
    * @OA\Get(
    *     path="/api/films/{id}/actors",
    *     tags={"Actors"},
    *     summary="Gets actors for a specific film by its ID",
    *     description="Retrieve a list of actors associated with a specific film based on its ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="The ID of the film for which you want to retrieve the actors",
    *         required=true
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK"
    *     )
    * )
    */
    public function show(string $id)
    { 
        try
        {
            $film = Film::find($id);
            $actors = $film->actors;
            return (ActorResource::collection($actors))->response()->setStatusCode(OK);
        }
        catch (QueryException $e)
        {
            abort(NOT_FOUND, NOT_FOUND_MESSAGE);
        } 
        catch (Exception $e)
        {
            abort(SERVER_ERROR, SERVER_ERROR_MESSAGE);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
