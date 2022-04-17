<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property string $status
 * @property int $patient_id
 * @property int $service_id
 * @method static wherePatientId(int $patientId)
 */
class Order extends Model
{
    use HasFactory;

    /** @var string  */
    public const AWAIT_STATUS        = 'await';

    /** @var string  */
    public const IN_PROGRESS_STATUS  = 'in_progress';

    /** @var string  */
    public const COMPLETE_STATUS     = 'complete';

    /** @var string  */
    public const  CANCEL_STATUS       = 'cancel';

    /** @var string[]  */
    public static array $statuses = [
        self::AWAIT_STATUS,
        self::IN_PROGRESS_STATUS.
        self::COMPLETE_STATUS,
        self::CANCEL_STATUS,
    ];

    /** @var array|string[]  */
    public const STATUS_MAP = [
        self::AWAIT_STATUS => 'В ожидании',
        self::IN_PROGRESS_STATUS => 'В обработке',
        self::COMPLETE_STATUS => 'Готово',
        self::CANCEL_STATUS => 'Отклонено',
    ];

    protected $fillable = [
        'status',
    ];

    /**
     * @param $service
     * @return Order
     */
    public static function create($patient, $service)
    {
        DB::beginTransaction();

        $order              = new Order();
        $order->status      = Order::AWAIT_STATUS;
        $order->patient_id  = $patient->id;
        $order->service_id  = $service->id;
        $order->save();

        DB::commit();

        return $order;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderInformation::class);
    }
}
