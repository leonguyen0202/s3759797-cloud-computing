<?php

namespace App\Modules\Backend\Lecturer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class Lecturer extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'lecturers';

    protected $primaryKey = 'id';

    protected $fillable = ['first_name', 'last_name', 'age', 'gender'];

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
        $columns = Schema::getColumnListing('lecturers'); // translate_groups table

        return $columns;
    }

    public function scopeExclude($query, $value = array())
    {
        return $query->select(array_diff($this->getColumns(), (array) $value));
    }
}
