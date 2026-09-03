<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::orderBy('last_name')->orderBy('first_name')->paginate(20);

        return view('people.index', compact('people'));
    }

    public function create()
    {
        $people = Person::orderBy('last_name')->get();

        return view('people.create', compact('people'));
    }

    public function store(PersonRequest $request)
    {
        $person = Person::create($request->validated() + [
            'created_by' => Auth::id(),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'id' => $person->id,
                'name' => "{$person->last_name} {$person->first_name}",
            ], 201);
        }

        return redirect()->route('people.index')->with('status', '登録しました。');
    }

    public function show(Person $person)
    {
        $person->load(['biologicalFather', 'biologicalMother']);

        return view('people.show', compact('person'));
    }

    public function edit(Person $person)
    {
        $people = Person::where('id', '!=', $person->id)
            ->orderBy('last_name')
            ->get();

        return view('people.edit', compact('person', 'people'));
    }

    public function update(PersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        return redirect()->route('people.show', $person)->with('status', '更新しました。');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index')->with('status', '削除しました。');
    }
}
