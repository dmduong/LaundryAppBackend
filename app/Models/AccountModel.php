<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class AccountModel extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens;

    protected $table = 'accounts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $username = 'db_account_name';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'db_store_id',
        'db_employee_id',
        'db_customer_id',
        'db_account_name',
        'db_account_password',
        'db_account_token',
        'db_account_refresh_token',
        'db_account_device',
        'db_account_status',
        'db_account_created_at',
        'db_account_updated_at',
        'created_at',
        'updated_at'
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(StoreModel::class, 'db_store_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerModel::class, 'db_customer_id', 'id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(EmployeeModel::class, 'db_employee_id', 'id');
    }
}