<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreModel extends Authenticatable
{
    use HasFactory;
    protected $table = 'stores';

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
        'db_store_image',
        'db_store_address',
        'db_store_status',
        'db_store_created_at',
        'db_store_updated_at',
        'created_at',
        'updated_at'
    ];
}