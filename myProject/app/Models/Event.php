<?php
/**
 * Because of how late I procrastinated I prompted Gemini to create the models with the schema pdf
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'Event_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'Event_Start_Date' => 'datetime',
        'Event_End_Date' => 'datetime',
    ];

    public function participants()
    {
        return $this->belongsToMany(Contact::class, 'event_participants', 'Event_ID', 'Contact_ID');
    }
}