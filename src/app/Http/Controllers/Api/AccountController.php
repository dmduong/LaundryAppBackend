<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterAccountRequest;
use App\Http\Requests\VerifyRequest;
use App\Http\Resources\AccountResource;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    protected AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RegisterAccountRequest $request)
    {
        $result = $this->accountService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Thực hiện xác thực người dùng.
     * 
     * @param $request
     * @return mixed
     */
    public function verify(VerifyRequest $request)
    {
        $this->accountService->verify($request->validated());

        return response()->json([
            'message' => 'Xác thực tài khoản thành công.'
        ], Response::HTTP_OK);
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

    }

    public function destroyVerify($accountId)
    {
        $this->accountService->destroyVerify($accountId);

        return response()->json(['message' => "Xóa mã xác thực thành công."], Response::HTTP_OK);
    }

    public function updateVerify($accountId)
    {
        $this->accountService->updateVerify($accountId);
        return response()->json(["message" => "Gửi lại mã xác thực thành công."], Response::HTTP_OK);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->accountService->login($request->validated());

        return response()->json(new AccountResource($result), Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $this->accountService->logout($request->user()->account_id);

        $request->setUserResolver(function () {
            return null;
        });

        return response()->json([
            'status' => 200,
            "messages" => "Logout successfull !"
        ], Response::HTTP_OK);
    }
}