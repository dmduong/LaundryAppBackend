<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\SearchStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Resources\GetAllStoreResource;
use App\Services\StoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class StoreController extends Controller
{

    protected StoreService $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchStoreRequest $request)
    {
        $result = $this->storeService->searchStore($request->validated());

        return response()->json(GetAllStoreResource::collection($result), Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStoreRequest $request)
    {
        $this->storeService->createStore($request->validated());

        return response()->json([], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $storeId = $request->user()->db_store_id;

        $result = $this->storeService->show($storeId);

        return response()->json(new GetAllStoreResource($result), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request)
    {
        $this->storeService->update($request->user()->db_store_id, $request->validated());

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->storeService->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}