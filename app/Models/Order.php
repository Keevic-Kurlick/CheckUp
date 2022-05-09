<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @property int    $id
 * @property string $status
 * @property int    $patient_id
 * @property int    $service_id
 * @property int    $orderResult_id
 * @property-read Orderres
 * @method static whereId(int $orderId)
 * @method static wherePatientId(int $patientId)
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;

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

    /** @var string */
    public const ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE = 'make_analysis';

    /** @var string[] */
    public const ADDITIONAL_STEPS = [
        self::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE,
    ];

    /** @var array|string[]  */
    public const STATUS_MAP = [
        self::AWAIT_STATUS => 'В ожидании',
        self::IN_PROGRESS_STATUS => 'В обработке',
        self::COMPLETE_STATUS => 'Готово',
        self::CANCEL_STATUS => 'Отклонено',
    ];

    /** @var string[] */
    public const MAP_STEPS_NAMES_ACTION = [
        self::IN_PROGRESS_STATUS            => 'Взять в работу',
        self::COMPLETE_STATUS               => 'Завершить',
        self::CANCEL_STATUS                 => 'Отклонить',
        self::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE => 'Сгенерировать справку'
    ];

    /** @var string[] */
    public const MAP_STEPS_BUTTON_COLOR = [
        self::IN_PROGRESS_STATUS                => 'info',
        self::COMPLETE_STATUS                   => 'success',
        self::CANCEL_STATUS                     => 'warning',
        self::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE     => 'info',
    ];

    /** @var \string[][] */
    public const SEQUENCE_STEPS = [
        Order::AWAIT_STATUS => [
            Order::IN_PROGRESS_STATUS,
        ],
        Order::IN_PROGRESS_STATUS => [
            Order::COMPLETE_STATUS,
            Order::CANCEL_STATUS,
        ],
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'status',
        'doctor_id',
        'orderInfo_id',
    ];

    /**
     * @param $patient
     * @param $service
     * @return Order
     * @throws \Throwable
     */
    public static function create($patient, $service): Order
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
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'doctor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'patient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderInformation::class, 'id', 'orderInfo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderResult(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderResult::class, 'Order_id', 'id');
    }
}
