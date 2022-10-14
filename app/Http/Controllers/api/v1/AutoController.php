<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Auto;
use Validator;

class AutoController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/auto",
     *     operationId="allAuto",
     *     description="All Auto page",
     *     tags={"Auto"},
     *     @OA\Response(response="200", description="Main Auto page")
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Auto::get(), 200);
    }

    /**
     * @OA\Get(
     *     path="/auto/{id}",
     *     operationId="autoById",
     *     description="Auto by id",
     *     tags={"Auto"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Page Auto"),
     *     @OA\Response(response="404", description="Page Auto not found")
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id)
    {
        $record = Auto::find($id);

        if (is_null($record)) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $record->driver;

        return response()->json($record, 200);
    }

    /**
     * @OA\Put(
     *     path="/auto/{id}",
     *     operationId="updateAutoById",
     *     description="Update Auto by id",
     *     tags={"Auto"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Auto updated"),
     *     @OA\Response(response="400", description="Fails on update Auto"),
     *     @OA\Response(response="404", description="Page Auto not found")
     * )
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $ruls = [
            'name' => 'required|min:2|max:25'
        ];

        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $record = Auto::find($id);

        if (is_null($record)) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $record->update($request->all());

        return response()->json($record, 200);
    }

    /**
     * @OA\Post(
     *     path="/auto",
     *     operationId="createAuto",
     *     description="Create Auto",
     *     tags={"Auto"},
     *     @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     *     @OA\Response(response="201", description="Auto created"),
     *     @OA\Response(response="400", description="Fails Auto create")
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $ruls = [
            'name' => 'required|min:2|max:25'
        ];

        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $record = Auto::create($request->all());

        return response()->json($record, 201);
    }

    /**
     * @OA\Delete(
     *     path="/auto/{id}",
     *     operationId="deleteAuto",
     *     description="Delete Auto",
     *     tags={"Auto"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="204", description="Auto delete"),
     *     @OA\Response(response="404", description="Auto not found")
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $record = Auto::find($id);

        if (is_null($record)) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $record->delete();

        return response()->json('', 204);
    }
}
