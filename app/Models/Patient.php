<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @parent
 * @property int $patientinfo_id
 */
class Patient extends User
{
    use HasFactory;
}
