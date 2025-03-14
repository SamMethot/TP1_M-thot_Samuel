<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;
use App\Http\Resources\CriticResource;
use Exception;
use Illuminate\Database\QueryException;

class CriticFilmController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/films/{id}/critics",
    *     tags={"Films"},
    *     summary="Retrieve a specific film along with its associated critics",
    *     description="Fetch a specific film by its ID along with the critics associated with it.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="The ID of the film to retrieve",
    *         required=true
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK."
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found."
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error."
    *     )
    * )
    */
    public function show(string $id)
    {
        try
        {
            $film = Film::find($id);
            $critics = $film->critics;
            return response()->json(['film' => new FilmResource($film), 'critics' => CriticResource::collection($critics)], OK);
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
    * @OA\Get(
    *     path="/api/films/{id}/averageScore",
    *     tags={"Films"},
    *     summary="Gets the average score of a film based on its critics",
    *     description="Retrieve the average score for a specific film based on the ratings from its critics.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="The ID of the film for which the average score is calculated",
    *         required=true
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK - Successfully retrieved the average score of the film",
    *         @OA\JsonContent(
    *             @OA\Property(
    *                 property="averageScore",
    *                 type="number",
    *                 format="float",
    *                 description="The average score of the film"
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found - Film with the specified ID does not exist"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error - An unexpected error occurred"
    *     )
    * )
    */
    public function averageScore(string $id)
    {
        try
        {
            $film = Film::findOrFail($id);

            $averageScore = $film->critics()->avg('score');

            return response()->json(['averageScore' => $averageScore], OK);
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
}
