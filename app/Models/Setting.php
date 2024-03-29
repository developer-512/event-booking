<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const SETTING_TYPE_SELECT = [
        'true-false' => 'Enable/Disable',
        'text'       => 'Text',
    ];
    public const SETTING_GROUPS=[
        'Checkout'=>'Checkout Settings',
        'Payments'=>'Payment Settings',
        'Web'=>'Website Settings',
        'Trip'=>'Trip Page Settings',
        'Social'=>'Social Media Links Settings'
    ];

    public $table = 'settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'setting_key',
        'setting_value',
        'details',
        'setting_type',
        'setting_group',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
