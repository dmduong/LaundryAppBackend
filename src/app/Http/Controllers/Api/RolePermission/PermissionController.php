<?php

namespace App\Http\Controllers\Api\RolePermission;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\SearchPermissionRequest;
use App\Http\Requests\RolePermission\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public PermissionService $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SearchPermissionRequest $request)
    {
        $result = $this->permissionService->getAllPermission($request->validated());

        return response()->json(Helper::paginations(PermissionResource::collection($result)), Response::HTTP_OK);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $permissionId)
    {
        $result = $this->permissionService->find($permissionId);

        return response()->json(new PermissionResource($result), Response::HTTP_OK);
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
    public function update(UpdatePermissionRequest $request, int $permissionId)
    {
        $result = $this->permissionService->update($request->validated(), $permissionId);

        return response()->json(new PermissionResource($result), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $permissionId)
    {
        $result = $this->permissionService->destroy($permissionId);

        return response()->json($result, Response::HTTP_OK);
    }
}