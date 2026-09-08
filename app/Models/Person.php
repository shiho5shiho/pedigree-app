<?php

namespace App\Models;

use Carbon\Carbon;
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
        'is_father_adopted',
        'is_mother_adopted',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
        'is_deceased' => 'boolean',
        'is_father_adopted' => 'boolean',
        'is_mother_adopted' => 'boolean',
    ];

    // ログインアカウントとの紐づけ
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ユーザーの生物学上の性別
    public function biologicalSexLabel(): string
    {
        return match ($this->biological_sex) {
            'male' => '男性',
            'female' => '女性',
            'unknown' => '不明',
        };
    }

    // この人物からみた父との続柄（子側の表示用）
    public function fatherRelationshipLabel(): string
    {
        return $this->is_father_adopted ? '養子' : '実子';
    }

    // この人物からみた母との続柄（子側の表示用）
    public function motherRelationshipLabel(): string
    {
        return $this->is_mother_adopted ? '養子' : '実子';
    }

    // 父を「親側」として表示する際のラベル
    public function fatherRoleLabel(): string
    {
        return $this->is_father_adopted ? '養親' : '実親';
    }

    // 母を「親側」として表示する際のラベル
    public function motherRoleLabel(): string
    {
        return $this->is_mother_adopted ? '養親' : '実親';
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
        return $this->biologicalFatherChildren
            ->merge($this->biologicalMotherChildren)
            ->sortBy(fn ($child) => $child->birth_date ?? Carbon::maxValue())
            ->values();
    }

    // 病歴一覧
    public function personMedicalHistories(): HasMany
    {
        return $this->hasMany(PersonMedicalHistory::class);
    }
}
