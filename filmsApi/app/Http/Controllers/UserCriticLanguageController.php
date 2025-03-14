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
    * @OA\Get(
    *     path="/api/users/{id}/preferredLanguage",
    *     tags={"Users"},
    *     summary="Gets the preferred language of a user based on the films they reviewed",
    *     description="Retrieve the most frequently used language for films reviewed by a specific user.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="The ID of the user for which you want to retrieve the preferred language",
    *         required=true
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK - Successfully retrieved the user's preferred language"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found - User with the specified ID does not exist or has no reviews"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error - An unexpected error occurred"
    *     )
    * )
    */
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
