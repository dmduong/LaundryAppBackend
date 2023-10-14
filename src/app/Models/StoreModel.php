<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'stores';
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
        'db_store_number',
        'db_store_name',
        'db_store_phone',
        'db_store_email',
        'db_store_image',
        'db_store_address',
        'db_store_status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function account(): HasOne
    {
        return $this->hasOne(AccountModel::class, 'db_store_id', 'id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(EmployeeModel::class, 'db_store_id', 'id');
    }
}