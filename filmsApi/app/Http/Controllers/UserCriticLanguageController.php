<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Critic;
use App\Models\Language;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


class UserCriticLanguageController extends Controller
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
            $films = [];
            $languageCount = [];
            foreach ($critics as $critic) {
                $film = $critic->film;
                $films[] = $film;
                $languageId = $film->language->id;

                if (array_key_exists($languageId, $languageCount)) { // Documentation du array_key_exists : https://www.php.net/manual/en/function.array-key-exists.php
                    $languageCount[$languageId]++;
                } else {
                    $languageCount[$languageId] = 1;
                }
            }

            arsort($languageCount);

            $mostUsedLanguageId = array_key_first($languageCount);

            $preferredLanguage = Language::find($mostUsedLanguageId)->name;

            return response()->json(['preferred_language' => $preferredLanguage], OK);
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
