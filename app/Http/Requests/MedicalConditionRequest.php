<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalConditionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // v1は単一ユーザー運用のためPolicyなし
    }

    public function rules(): array
    {
        // 編集時は自分自身のレコードを重複チェックの対象から除外する
        $selfId = $this->route('medical_condition')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('medical_conditions', 'name')->ignore($selfId),
            ],
            'category' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'この病名はすでに登録されています。',
        ];
    }
}
