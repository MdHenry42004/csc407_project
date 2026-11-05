<?php
/**
 * Because of how late I procrastinated I prompted Gemini to create the models with the schema pdf
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $table = 'households';
    protected $primaryKey = 'Household_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'Household_ID', 'Household_ID');
    }
}