<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customers';

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
        'db_customer_number',
        'db_customer_name',
        'db_customer_gender',
        'db_customer_birthday',
        'db_customer_address',
        'db_customer_phone',
        'db_customer_email',
        'db_customer_image',
        'db_customer_status',
        'db_customer_created_at',
        'db_customer_updated_at',
        'created_at',
        'updated_at'
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(CustomerModel::class, 'db_customer_id', 'id');
    }
}