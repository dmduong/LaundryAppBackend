<?php

namespace App\Http\Controllers\Api\Stores;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\Stores\SearchEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\SearchEmployeeResource;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchEmployeeRequest $request)
    {
        $idStore = $request->user()->store_id;

        $result = $this->employeeService->searchEmployee($request->validated(), $idStore);

        return response()->json(Helper::paginations(SearchEmployeeResource::collection($result)), Response::HTTP_OK);
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
    public function store(CreateEmployeeRequest $request)
    {
        $storeId = $request->user()->store_id;

        $result = $this->employeeService->createEmployee($request->validated(), $storeId);

        return response()->json(new EmployeeResource($result), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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