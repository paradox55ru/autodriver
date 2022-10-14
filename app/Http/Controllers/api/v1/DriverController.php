<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Driver;
use Validator;

class DriverController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/driver",
     *     operationId="allDriver",
     *     description="All Driver page",
     *     tags={"Driver"},
     *     @OA\Response(response="200", description="Main Driver page")
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Driver::get(), 200);
    }

    /**
     * @OA\Get(
     *     path="/driver/{id}",
     *     operationId="driverById",
     *     description="Driver by id",
     *     tags={"Driver"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Page Driver"),
     *     @OA\Response(response="404", description="Page Driver not found")
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id)
    {
        $record = Driver::find($id);

        if (is_null($record)) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $record->auto;

        return response()->json($record, 200);
    }

    /**
     * @OA\Put(
     *     path="/driver/{id}",
     *     operationId="updateDriverById",
     *     description="Update Driver by id",
     *     tags={"Driver"},
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
     *     @OA\Response(response="200", description="Driver updated"),
     *     @OA\Response(response="400", description="Fails on update Driver"),
     *     @OA\Response(response="404", description="Page Driver not found")
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

        $driver = Driver::find($id);

        if (is_null($driver)) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $driver->update($request->all());

        return response()->json($driver, 200);
    }

    /**
     * @OA\Post(
     *     path="/driver",
     *     operationId="createDriver",
     *     description="Create Driver",
     *     tags={"Driver"},
     *     @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     *     @OA\Response(response="201", description="Driver created"),
     *     @OA\Response(response="400", description="Driver not created")
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

        $driver = Driver::create($request->all());

        return response()->json($driver, 201);
    }

    /**
     * @OA\Delete(
     *     path="/driver/{id}",
     *     operationId="deleteDriver",
     *     description="Delete driver",
     *     tags={"Driver"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="204", description="Driver delete"),
     *     @OA\Response(response="404", description="Page Driver not found")
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $driver = Driver::find($id);

        if (is_null($driver)) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $driver->delete();

        return response()->json('', 204);
    }
}
