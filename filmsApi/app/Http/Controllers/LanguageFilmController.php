<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Film;
use Exception;

class LanguageFilmController extends Controller
{
    public function index($id)
    {
        try
        {
            return response()->json(['language' => Language::find($id)->name, 'films' => Language::find($id)->films], OK);
        }
        catch (Exception $e)
        {
            abort(SERVER_ERROR, SERVER_ERROR_MESSAGE);
        }
    }

    public function avg(string $id)
    {
        try
        {
            $language = Language::find($id);
            $average = Film::where('language_id', $language->id)->avg('rental_rate'); // Documentation : https://laravel.com/docs/master/prompts#select-validation
            return response()->json(['average' => $average], OK);
        }
        catch (Exception $e)
        {
            abort(SERVER_ERROR, SERVER_ERROR_MESSAGE);
        }
    }
}
