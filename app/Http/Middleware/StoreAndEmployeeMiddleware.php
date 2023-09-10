<?php

namespace App\Http\Middleware;

use App\Exceptions\ResourceNotFoundException;
use App\Models\AccountModel;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class StoreAndEmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = JWTAuth::getToken();

        $dataAccountLoginOn = [];
        if (!is_null($token)) {
            $payLoad = JWTAuth::getPayload($token);

            $accountLogin = AccountModel::where('id', $payLoad['sub'])->where('db_account_token', $token)->first();

            if (is_null($accountLogin)) {
                throw new ResourceNotFoundException("You do not have permission to access", 'not_permission_access');
            }

            if (!is_null($accountLogin->db_store_id)) {
                $store = $accountLogin->store;
                $employee = $accountLogin->employee;

                $dataAccountLoginOn[] = [
                    'id' => $accountLogin->id,
                    'db_account_name' => $accountLogin->db_account_name,
                    'db_account_device' => $accountLogin->db_account_device,
                    'db_account_status' => $accountLogin->db_account_status,
                    'store' => !is_null($store) ? [
                        'id' => $store->id,
                        'db_store_number' => $store->db_store_number,
                        'db_store_name' => $store->db_store_name,
                    ] : null
                ];
            }

            $request->attributes->add(["account"=> $dataAccountLoginOn]);
        } else {
            throw new ResourceNotFoundException("Token not valid !", 'token_not_valid');
        }

        $request->attributes->get('account');
        return $next($request);
    }
}