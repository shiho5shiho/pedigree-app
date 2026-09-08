<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalCondition extends Model
{
    protected $fillable = [
        'name',
        'category',
    ];

    public function personMedicalHistories()
    {
        return $this->hasMany(PersonMedicalHistory::class);
    }
}
