<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonMedicalHistoryRequest;
use App\Http\Requests\UpdatePersonMedicalHistoryRequest;
use App\Models\MedicalCondition;
use App\Models\Person;
use App\Models\PersonMedicalHistory;

class PersonMedicalHistoryController extends Controller
{
    public function index(Person $person)
    {
        $histories = $person->personMedicalHistories()
            ->with('medicalCondition')
            ->latest()
            ->get();

        return view('person_medical_histories.index', compact('person', 'histories'));
    }

    public function create(Person $person)
    {
        $conditions = MedicalCondition::orderBy('name')->get();
        $statuses = PersonMedicalHistory::STATUSES;

        return view('person_medical_histories.create', compact('person', 'conditions', 'statuses'));
    }

    public function store(StorePersonMedicalHistoryRequest $request, Person $person)
    {
        $person->personMedicalHistories()->create($request->validated());

        return redirect()
            ->route('people.medical-histories.index', $person)
            ->with('status', '病歴を登録しました。');
    }

    public function edit(Person $person, PersonMedicalHistory $medicalHistory)
    {
        $conditions = MedicalCondition::orderBy('name')->get();
        $statuses = PersonMedicalHistory::STATUSES;

        return view('person_medical_histories.edit', compact('person', 'medicalHistory', 'conditions', 'statuses'));
    }

    public function update(UpdatePersonMedicalHistoryRequest $request, Person $person, PersonMedicalHistory $medicalHistory)
    {
        $medicalHistory->update($request->validated());

        return redirect()
            ->route('people.medical-histories.index', $person)
            ->with('status', '病歴を更新しました。');
    }

    public function destroy(Person $person, PersonMedicalHistory $medicalHistory)
    {
        $medicalHistory->delete();

        return redirect()
            ->route('people.medical-histories.index', $person)
            ->with('status', '病歴を削除しました。');
    }
}
