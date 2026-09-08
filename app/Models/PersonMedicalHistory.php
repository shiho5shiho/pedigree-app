<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    const STATUSES = [
        'diagnosed' => '診断済み',
        'suspected' => '疑いあり',
        'family_reported' => '家族からの伝聞',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function medicalCondition()
    {
        return $this->belongsTo(MedicalCondition::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
