<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
    * @OA\Post(
    *     path="/api/users",
    *     tags={"Users"},
    *     summary="Creates a new user",
    *     @OA\Response(
    *         response=201,
    *         description="Created"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found - The requested resource was not found"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error - An unexpected error occurred"
    *     ),
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="first_name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="last_name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="email",
    *                     type="string",
    *                     format="email"
    *                 ),
    *                 @OA\Property(
    *                     property="password",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="login",
    *                     type="string"
    *                 )
    *             )
    *         )
    *     )
    * )
    */
    public function store(UserRequest $request)
    {
        try
        {
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(CREATED);
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
    * @OA\Put(
    *     path="/api/users/{id}",
    *     tags={"Users"},
    *     summary="Updates an existing user",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="The ID of the user to be updated",
    *         required=true
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK - The user was updated successfully"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Found - User with the specified ID does not exist"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error - An unexpected error occurred"
    *     ),
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="first_name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="last_name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="email",
    *                     type="string",
    *                     format="email"
    *                 ),
    *                 @OA\Property(
    *                     property="password",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="login",
    *                     type="string"
    *                 )
    *             )
    *         )
    *     )
    * )
    */
    public function update(UserRequest $request, string $id)
    {
        try 
        {
            $user = User::findOrFail($id);
            $validatedData = $request->validated();
            $user->update($validatedData);
            return (new UserResource($user))->response()->setStatusCode(OK);
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
