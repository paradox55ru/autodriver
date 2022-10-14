<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Auto;
use App\Models\Driver;
use App\Models\Relation;
use Validator;

class RelationController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/relation",
     *     operationId="allRelation",
     *     description="All Relation page",
     *     tags={"Relation"},
     *     @OA\Response(response="200", description="Main relation page")
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Relation::with(['auto', 'driver'])->get(), 200);
    }

    /**
     * @OA\Post(
     *     path="/relation",
     *     operationId="createRelation",
     *     description="Create Relation",
     *     tags={"Relation"},
     *     @OA\Parameter(
     *          name="driver_id",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="auto_id",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="201", description="Page Relation"),
     *     @OA\Response(response="400", description="Relation not created")
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $ruls = [
            'driver_id' => 'required|numeric',
            'auto_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $find = Relation::where(['auto_id' => $request->auto_id])->orWhere(['driver_id' => $request->driver_id])->get()->first();

        if (is_null($find)) {
            return response()->json(['error' => 1, 'message' => 'Relation exists.'], 400);
        }

        $record = Relation::create($request->all());

        if (isset($record['id'])) {
            unset($record['id']);
        }

        return response()->json($record, 201);
    }

    /**
     * @OA\Put(
     *     path="/relation/updateByAuto/{auto_id}",
     *     operationId="updateByAuto",
     *     description="Update by Auto id",
     *     tags={"Relation"},
     *     @OA\Parameter(
     *          name="auto_id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="driver_id",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Update by Auto"),
     *     @OA\Response(response="400", description="Fails on update by Driver"),
     *     @OA\Response(response="404", description="Page not found")
     * )
     *
     * @param Request $request
     * @param $auto_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateByAuto(Request $request, $auto_id)
    {
        $ruls = [
            'driver_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $relate = new Relation();
        $record = $relate->where(['auto_id' => $auto_id]);

        if (is_null($record->get()->first())) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $find = $relate->where(['driver_id' => $request->driver_id])->get()->first();
        if (!is_null($find)) {
            return response()->json(['error' => 1, 'message' => 'Relation exists.'], 400);
        }

        $driver = Driver::find($request->driver_id);
        if ($driver) {
            $record->update($request->all());

            return response()->json($record->get(), 200);
        }

        return response()->json(['error' => 1, 'message' => 'Driver id ' . $request->driver_id . ' not found.'], 404);
    }

    /**
     * @OA\Put(
     *     path="/relation/updateByDriver/{driver_id}",
     *     operationId="updateByDriver",
     *     description="Update by Driver id",
     *     tags={"Relation"},
     *     @OA\Parameter(
     *          name="driver_id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="auto_id",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Update by Driver"),
     *     @OA\Response(response="400", description="Fails on update by Driver"),
     *     @OA\Response(response="404", description="Page not found")
     * )
     *
     * @param Request $request
     * @param $driver_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateByDriver(Request $request, $driver_id)
    {
        $ruls = [
            'auto_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $relate = new Relation();
        $record = $relate->where(['driver_id' => $driver_id]);

        if (is_null($record->get()->first())) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $find = $relate->where(['auto_id' => $request->auto_id])->get()->first();
        if (!is_null($find)) {
            return response()->json(['error' => 1, 'message' => 'Relation exists.'], 400);
        }

        $auto = Auto::find($request->auto_id);
        if ($auto) {
            $record->update($request->all());

            return response()->json($record->get(), 200);
        }

        return response()->json(['error' => 1, 'message' => 'Auto id ' . $request->auto_id . ' not found.'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/relation/deleteByAuto/{auto_id}",
     *     operationId="deleteByAuto",
     *     description="Delete by Auto",
     *     tags={"Relation"},
     *     @OA\Parameter(
     *          name="auto_id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="204", description="Page Relation"),
     *     @OA\Response(response="404", description="Page not found")
     * )
     *
     * @param $auto_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByAuto($auto_id)
    {
        $relate = new Relation();
        $record = $relate->where(['auto_id' => $auto_id]);

        if (is_null($record->get())) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $record->delete();

        return response()->json('', 204);
    }

    /**
     * @OA\Delete(
     *     path="/relation/deleteByDriver/{driver_id}",
     *     operationId="deleteByDriver",
     *     description="Delete by Driver",
     *     tags={"Relation"},
     *     @OA\Parameter(
     *          name="driver_id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Response(response="204", description="Page Relation"),
     *     @OA\Response(response="404", description="Page not found")
     * )
     *
     * @param $driver_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByDriver($driver_id)
    {
        $relate = new Relation();
        $record = $relate->where(['driver_id' => $driver_id]);

        if (is_null($record->get())) {
            return response()->json(['error' => 1, 'message' => 'Not found.'], 404);
        }

        $record->delete();

        return response()->json('', 204);
    }
}
