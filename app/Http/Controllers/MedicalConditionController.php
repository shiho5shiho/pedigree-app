<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalConditionRequest;
use App\Models\MedicalCondition;

class MedicalConditionController extends Controller
{
    public function index()
    {
        $medicalConditions = MedicalCondition::orderBy('category')
            ->orderBy('name')
            ->get();

        return view('medical-conditions.index', compact('medicalConditions'));
    }

    public function create()
    {
        return view('medical-conditions.create');
    }

    public function store(MedicalConditionRequest $request)
    {
        MedicalCondition::create($request->validated());

        return redirect()
            ->route('medical-conditions.index')
            ->with('status', '病名を登録しました。');
    }

    public function edit(MedicalCondition $medicalCondition)
    {
        return view('medical-conditions.edit', compact('medicalCondition'));
    }

    public function update(MedicalConditionRequest $request, MedicalCondition $medicalCondition)
    {
        $medicalCondition->update($request->validated());

        return redirect()
            ->route('medical-conditions.index')
            ->with('status', '病名を更新しました。');
    }

    public function destroy(MedicalCondition $medicalCondition)
    {
        // person_medical_histories 側は cascadeOnDelete のため、
        // この病名を使っている病歴も一緒に削除される点を事前に警告する
        $usageCount = $medicalCondition->histories()->count();

        $medicalCondition->delete();

        $message = $usageCount > 0
            ? "病名を削除しました。（紐づいていた病歴 {$usageCount} 件も削除されました）"
            : '病名を削除しました。';

        return redirect()
            ->route('medical-conditions.index')
            ->with('status', $message);
    }
}
