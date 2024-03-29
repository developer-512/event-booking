<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostumeAttribute extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'costume_attributes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'values',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function costumes(){
        $this->belongsToMany(Costume::class,'costume_costume_attribute');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
