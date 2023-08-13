<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'employees';

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
        'db_employee_image',
        'db_employee_address',
        'db_employee_status',
        'db_employee_created_at',
        'db_employee_updated_at',
        'created_at',
        'updated_at'
    ];
}