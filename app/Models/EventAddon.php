<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventAddon extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_RADIO = [
        '1' => 'Enable',
        '0' => 'Disable',
    ];

    public $table = 'event_addons';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'addon_title',
        'addon_details',
        'addon_price',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function booking_event_addons()
    {
        return $this->belongsToMany(EventBooking::class, 'event_booking_addons','addon_id','event_booking_id')->withPivot('addon_price');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
