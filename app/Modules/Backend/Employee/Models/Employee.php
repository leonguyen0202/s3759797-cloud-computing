<?php

namespace App\Modules\Backend\Employee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class Employee extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'employees';

    protected $primaryKey = 'id';

    protected $fillable = ['first_name', 'last_name', 'age', 'gender', 'phone_number', 'address'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            do {
                $model->id = (string) Uuid::generate(4);
            } while ($model->where($model->getKeyName(), $model->id)->first() != null);
        });
    }

    protected function getColumns()
    {
        $columns = Schema::getColumnListing('employees'); // translate_groups table

        return $columns;
    }

    public function scopeExclude($query, $value = array())
    {
        return $query->select(array_diff($this->getColumns(), (array) $value));
    }
}
