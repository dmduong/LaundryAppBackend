<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
}