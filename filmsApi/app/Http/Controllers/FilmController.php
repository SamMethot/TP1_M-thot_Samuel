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
        //
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