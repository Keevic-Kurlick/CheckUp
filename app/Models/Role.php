<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static whereName(string $name)
 */
class Role extends Model
{
    /** @var string ROLE_PATIENT */
    public const ROLE_PATIENT   = 'patient';

    /** @var string ROLE_DOCTOR */
    public const ROLE_DOCTOR    = 'doctor';

    /** @var string ROLE_ADMIN */
    public const ROLE_ADMIN     = 'admin';

    /** @var string[] ROLES */
    public const ROLES = [
        self::ROLE_PATIENT,
        self::ROLE_DOCTOR,
        self::ROLE_ADMIN,
    ];

    use HasFactory;

    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @param string $roleName
     * @return int
     */
    public static function getRoleIdByName(string $roleName): int {
        return self::whereName($roleName)->pluck('id')->first();
    }
}
