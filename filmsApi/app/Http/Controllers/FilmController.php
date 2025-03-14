<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;
use App\Http\Requests\FilmRequest;
use Exception;
use Illuminate\Database\QueryException;

class FilmController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/films",
    *     tags={"Films"},
    *     summary="Retrieve a list of all films",
    *     description="Fetches a list of all films available in the database.",
    *     @OA\Response(
    *         response=200,
    *         description="OK. A list of films is successfully retrieved."
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Resource not found"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    public function index()
    {
        try
        {
            return (FilmResource::collection(Film::all()))->response()->setStatusCode(OK);
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
    *     path="/api/films/search",
    *     tags={"Films"},
    *     summary="Search films based on various filters",
    *     description="Retrieve a list of films based on a set of search filters, including title, rating, and length range.",
    *     @OA\Parameter(
    *         name="keyword",
    *         in="query",
    *         description="Keyword to search in film title",
    *         required=false
    *     ),
    *     @OA\Parameter(
    *         name="rating",
    *         in="query",
    *         description="Film rating filter",
    *         required=false
    *     ),
    *     @OA\Parameter(
    *         name="minLength",
    *         in="query",
    *         description="Minimum film length",
    *         required=false
    *     ),
    *     @OA\Parameter(
    *         name="maxLength",
    *         in="query",
    *         description="Maximum film length",
    *         required=false
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK - Successfully retrieved films"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found - No films found matching the search criteria"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error - An unexpected error occurred"
    *     )
    * )
    */
    public function search(Request $request)
    {
        try
        {
            $keyword = $request->query('keyword');

            $rating = $request->query('rating');
            $minLength = $request->query('minLength');
            $maxLength = $request->query('maxLength');
            
            $query = Film::query();
            
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%$keyword%");
            }
            
            if (!empty($rating)) {
                $query->where('rating', '=', $rating);
            }
            
            if (!empty($minLength)) {
                $query->where('length', '>=', $minLength);
            }

            if (!empty($maxLength)) {
                $query->where('length', '<=', $maxLength);
            }

            $films = $query->paginate(NB_ELEMENTS);

            return response()->json($films);
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