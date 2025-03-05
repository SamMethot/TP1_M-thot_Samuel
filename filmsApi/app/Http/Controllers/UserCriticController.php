<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Critic;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


class UserCriticController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function preferredLanguage(string $id)
    {
        try
        {

            $user = User::find($id);

            $critics = $user->critics;



            foreach ($critics as $critic) {
                Log::info('Critiques de l\'utilisateur: ' . $critic);
            }






            $languageCount = [];

            if (empty($languageCount)) {
                return response()->json(['error' => 'Aucune langue trouvée dans les critiques'], 404);
            }

            arsort($languageCount);
            $preferredLanguage = array_key_first($languageCount);

            return response()->json(['preferred_language' => $preferredLanguage], 200);
        }
        catch (QueryException $e)
        {
            abort(NOT_FOUND, NOT_FOUND_MESSAGE);
        }
        catch (Exception $e)
        {
            Log::error('Erreur lors du calcul du langage préféré: ' . $e->getMessage());
            abort(SERVER_ERROR, SERVER_ERROR_MESSAGE);
        }
    }

}
