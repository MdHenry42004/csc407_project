<?php

/**
 * Because of how late I procrastinated I prompted Gemini to create the models with the schema pdf
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'Contact_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'Date_of_Birth' => 'datetime',
    ];

    public function household()
    {
        return $this->belongsTo(Household::class, 'Household_ID', 'Household_ID');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'Donor_ID', 'Contact_ID');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participants', 'Contact_ID', 'Event_ID');
    }
}