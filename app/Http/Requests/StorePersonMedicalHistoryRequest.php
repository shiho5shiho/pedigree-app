<?php

namespace App\Http\Requests;

use App\Models\PersonMedicalHistory;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonMedicalHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_condition_id' => ['required', 'exists:medical_conditions,id'],
            'status' => ['required', 'in:'.implode(',', array_keys(PersonMedicalHistory::STATUSES))],
            'onset_age' => ['nullable', 'integer', 'min:0', 'max:255'],
            'diagnosed_date' => ['nullable', 'date', 'before_or_equal:today'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'medical_condition_id' => '病名',
            'status' => '状態',
            'onset_age' => '発症年齢',
            'diagnosed_date' => '診断日',
            'notes' => '備考',
        ];
    }
}
