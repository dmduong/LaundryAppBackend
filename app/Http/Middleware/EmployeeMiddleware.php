<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorsException;
use App\Models\AccountModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = JWTAuth::getToken();

        if (!is_null($token)) {
            $payLoad = JWTAuth::getPayload($token);

            $accountLogin = AccountModel::select(
                'id',
                'db_employee_id',
                'db_account_name',
                'db_account_device',
                'db_account_status'
            )->with(
                    ['employee:id,db_store_id,db_employee_number,db_employee_name']
                )->where('id', $payLoad['sub'])
                ->where('db_account_token', $token)->first();

            if (is_null($accountLogin)) {
                throw new ErrorsException("Not authorized", 'not_authorized');
            }

            if (is_null($accountLogin->employee)) {
                throw new ErrorsException('User login is not valid', 'login_not_valid');
            }

            $request->setUserResolver(function () use ($accountLogin) {
                return $accountLogin;
            });

        } else {
            throw new ErrorsException("Token is required !", 'token_required');
        }

        return $next($request);
    }
}