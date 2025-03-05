<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;
use App\Http\Resources\ActorResource;
use App\Http\Resources\CriticResource;
use App\Http\Requests\FilmRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    public function store(FilmRequest $request)
    {
        try
        {
            $film = Film::create($request->validated());
            return (new FilmResource($film))->response()->setStatusCode(CREATED);
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
        try
        {
            return response()->noContent();
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

            $films = $query->paginate(20);

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