<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\SearchStoreRequest;
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

        $parser = new \WhichBrowser\Parser($request->userAgent());
        $browser = $parser->browser->toString(); // Get the browser name
        $version = $parser->browser->getVersion(); // Get the browser version
        $platform = $parser->os->toString(); // Get the operating system name

        $this->storeService->createStore($request->validated());

        return response()->json([], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->storeService->show($id);

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
}