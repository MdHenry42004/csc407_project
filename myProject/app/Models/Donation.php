<?php
/**
 * Because of how late I procrastinated I prompted Gemini to create the models with the schema pdf
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';
    protected $primaryKey = 'Donation_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    // Add this line to disable automatic created_at / updated_at timestamps:
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'Donation_Date' => 'datetime',
    ];

    public function donor()
    {
        return $this->belongsTo(Contact::class, 'Donor_ID', 'Donor_ID');
    }
}