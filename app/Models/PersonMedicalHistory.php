<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonMedicalHistory extends Model
{
    protected $fillable = [
        'person_id',
        'medical_condition_id',
        'status',
        'onset_age',
        'diagnosed_date',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'diagnosed_date' => 'date',
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(MedicalCondition::class, 'medical_condition_id');
    }
}
