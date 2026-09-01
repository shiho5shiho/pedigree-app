<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalCondition extends Model
{
    protected $fillable = [
        'name',
        'category',
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(PersonMedicalHistory::class);
    }
}
