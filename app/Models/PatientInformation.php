<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $passport_series
 * @property string $passport_number
 * @property string $inn
 * @property string $snils
 * @property string $check_status
 * @property int    $patient_id
 * @method static whereId(int $id)
 * @method void needConfirm(Builder $query)
 */
class PatientInformation extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string */
    public const CHECK_STATUS_CANCELLED = 'cancelled';

    /** @var string */
    public const CHECK_STATUS_NEED_CONFIRM = 'need_confirm';

    /** @var string */
    public const CHECK_STATUS_CONFIRMED = 'confirmed';

    /** @var string[] */
    public const CHECK_STATUSES = [
        self::CHECK_STATUS_CANCELLED,
        self::CHECK_STATUS_NEED_CONFIRM,
        self::CHECK_STATUS_CONFIRMED,
    ];

    /** @var string[] */
    protected $fillable = [
        'passport_series',
        'passport_number',
        'inn',
        'snils'
    ];

    /** @var string */
    protected $table = 'patient_information';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'patientinfo_id');
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function needConfirmScope(Builder $query)
    {
        $query->where('check_status', self::CHECK_STATUS_NEED_CONFIRM);
    }
}
