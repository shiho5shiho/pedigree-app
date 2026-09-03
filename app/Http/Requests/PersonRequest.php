<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // v1は単一ユーザー運用のためPolicyなし
    }

    protected function prepareForValidation(): void
    {
        // チェックボックスは未チェック時にキー自体が送られてこないため明示的に補完する
        $this->merge([
            'is_deceased' => $this->boolean('is_deceased'),
            'is_father_adopted' => $this->boolean('is_father_adopted'),
            'is_mother_adopted' => $this->boolean('is_mother_adopted'),
        ]);
    }

    public function rules(): array
    {
        // 編集時は自分自身を父・母に選べないようにする
        $selfId = $this->route('person')?->id;

        return [
            'last_name' => ['required', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'max:50'],
            'maiden_name' => ['nullable', 'string', 'max:50'],
            'biological_sex' => ['required', Rule::in(['male', 'female', 'unknown'])],
            'birth_date' => ['nullable', 'date'],
            'is_deceased' => ['boolean'],
            'death_date' => ['nullable', 'date', 'after_or_equal:birth_date'],
            'birthplace' => ['nullable', 'string', 'max:100'],
            'biological_father_id' => ['nullable', 'exists:people,id', Rule::notIn([$selfId])],
            'biological_mother_id' => ['nullable', 'exists:people,id', Rule::notIn([$selfId])],
            'is_father_adopted' => ['boolean'],
            'is_mother_adopted' => ['boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'biological_father_id.not_in' => '自分自身を父として選択することはできません。',
            'biological_mother_id.not_in' => '自分自身を母として選択することはできません。',
            'death_date.after_or_equal' => '死亡日は生年月日以降の日付を入力してください。',
        ];
    }
}
