<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string $name
 * @property string $description
 * @property string $template_path
 * @method static string whereName()
 * @method static string whereTemplatePath()
 */
class MedicalCertificate extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string[] $fillable */
    protected $fillable  = [
        'name',
        'description',
        'template_path',
    ];
}
