<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $passport_series
 * @property string $passport_number
 * @property string $inn
 * @property string $snils
 * @method static whereId(int $id)
 */
class PatientInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'passport_series',
        'passport_number',
        'inn',
        'snils'
    ];

    protected $table = 'patient_information';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
