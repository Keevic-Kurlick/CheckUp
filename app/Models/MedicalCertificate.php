<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property string $template_path
 * @method static string whereName()
 * @method static string whereTemplatePath()
 */
class MedicalCertificate extends Model
{
    use HasFactory;
}
