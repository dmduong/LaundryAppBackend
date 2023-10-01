<?php 

namespace Database\Schema;

use Illuminate\Database\Schema\Blueprint;

class CustomBlueprint extends Blueprint
{
    public function timestampsAsString($column = 'created_at')
    {
        return $this->timestamp($column)->default('CURRENT_TIMESTAMP')->nullable()->change();
    }

    public function dropTimestampsAsString($column = 'created_at')
    {
        return $this->dropColumn($column);
    }

    public function softDeletesAsString($column = 'deleted_at')
    {
        return $this->timestamp($column)->nullable()->change();
    }
}

