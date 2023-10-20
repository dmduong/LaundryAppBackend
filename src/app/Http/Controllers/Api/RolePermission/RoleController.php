<?php

namespace App\Http\Controllers\Api\RolePermission;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\AssignPermissionRequest;
use App\Http\Requests\RolePermission\SearchRoleRequest;
use App\Http\Requests\RolePermission\UpdateRoleRequest;
use App\Http\Resources\RoleHasPermissionResource;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRoleRequest $request)
    {
        $result = $this->roleService->getAllRole($request->validated());

        return response()->json(Helper::paginations(RoleResource::collection($result)), Response::HTTP_OK);
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
    public function show(int $roleId)
    {
        $result = $this->roleService->find($roleId);

        return response()->json(new RoleResource($result), Response::HTTP_OK);
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
    public function update(UpdateRoleRequest $request, string $roleId)
    {
        $result = $this->roleService->update($request->validated(), $roleId);
        return response()->json(new RoleResource($result), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $roleId)
    {
        $result = $this->roleService->destroy($roleId);

        return response()->json($result, Response::HTTP_OK);
    }

    public function roleHasPermission(int $roleId): object
    {
        $result = $this->roleService->find($roleId);

        return response()->json(new RoleHasPermissionResource($result), Response::HTTP_OK);
    }

    public function roleAssignPermission(AssignPermissionRequest $request, $roleId)
    {
        $this->roleService->assignPermission($request->validated(), $roleId);

        return response()->json([
            'stautus' => 200,
            'message' => "Assign role to permission successfull !"
        ], Response::HTTP_OK);
    }
}