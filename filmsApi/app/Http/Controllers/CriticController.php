<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\CriticResource;
use App\Models\Critic;

use Exception;

class CriticController extends Controller
{
    /**
    * @OA\Delete(
    *     path="/api/critics/{id}",
    *     tags={"Critics"},
    *     summary="Deletes a critic by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="The ID of the critic to be deleted",
    *         required=true
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="No Content - The critic was successfully deleted"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found - Critic with the specified ID does not exist"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error - An unexpected error occurred"
    *     )
    * )
    */
    public function destroy(string $id)
    {
        try
        {
            $critic = Critic::find($id);

            $critic->delete();

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
}
