<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employees';
    public $timestamps = true;

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
        'db_employee_number',
        'db_employee_name',
        'db_employee_gender',
        'db_employee_birthday',
        'db_employee_phone',
        'db_employee_email',
        'db_employee_image',
        'db_employee_address',
        'db_employee_status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function account(): HasOne
    {
        return $this->hasOne(AccountModel::class, 'db_employee_id', 'id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(StoreModel::class, 'db_store_id', 'id');
    }
}