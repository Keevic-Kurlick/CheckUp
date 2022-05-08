<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $passport_series
 * @property string $passport_number
 * @property string $inn
 * @property string $snils
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $passport_path
 * @property string $analysis_path
 * @property int    $order_id
 */
class OrderInformation extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string */
    protected $table = 'order_information';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderInfo_id', 'order_id');
    }
}
