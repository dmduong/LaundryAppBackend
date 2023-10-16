<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorsException;
use App\Models\AccountModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
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

        try {
            if (!is_null($token)) {
                $payLoad = JWTAuth::getPayload($token);

                $accountLogin = AccountModel::query()
                    ->select(
                        'accounts.id as account_id',
                        'accounts.db_account_name as account_name',
                        'accounts.db_employee_id as user_id',
                        'employees.db_store_id as store_id',
                        'employees.db_employee_phone as user_phone',
                        'employees.db_employee_email as user_email',
                    )
                    ->join('employees', 'accounts.db_employee_id', 'employees.id')
                    ->where('accounts.id', $payLoad['sub'])
                    ->where('accounts.db_account_token', $token)
                    ->first();

                if (is_null($accountLogin)) {
                    throw new ErrorsException("Not authorized", 'not_authorized');
                }

                $request->setUserResolver(function () use ($accountLogin) {
                    return $accountLogin;
                });

            } else {
                throw new ErrorsException("Token is required !", 'token_required');
            }
        } catch (TokenExpiredException $e) {
            if ($e instanceof TokenExpiredException) {
                throw new ErrorsException($e->getMessage(), 'token_expired');
            }
        }
        // catch (ErrorsException $e) {
        //     throw new ErrorsException($e->getMessage(), $e->getResourceType());
        // }
        return $next($request);
    }
}