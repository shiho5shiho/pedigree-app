<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'maiden_name',
        'biological_sex',
        'birth_date',
        'is_deceased',
        'death_date',
        'birthplace',
        'biological_father_id',
        'biological_mother_id',
        'is_adopted',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'birth_date'  => 'date',
        'death_date'  => 'date',
        'is_deceased' => 'boolean',
        'is_adopted'  => 'boolean',
    ];

    // ログインアカウントとの紐づけ
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 実父（自己参照）
    public function biologicalFather(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'biological_father_id');
    }

    // 実母（自己参照）
    public function biologicalMother(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'biological_mother_id');
    }

    // 実父として登録されている人の子一覧
    public function biologicalFatherChildren(): HasMany
    {
        return $this->hasMany(Person::class, 'biological_father_id');
    }

    // 実母として登録されている人の子一覧
    public function biologicalMotherChildren(): HasMany
    {
        return $this->hasMany(Person::class, 'biological_mother_id');
    }

    // 父方・母方の子を合わせた全子一覧
    public function children()
    {
        return $this->biologicalFatherChildren->merge($this->biologicalMotherChildren);
    }

    // 病歴一覧
    public function medicalHistories(): HasMany
    {
        return $this->hasMany(PersonMedicalHistory::class);
    }
}
