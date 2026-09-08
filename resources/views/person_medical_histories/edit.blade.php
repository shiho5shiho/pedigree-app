<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }} さんの病歴 | 家族カルテ">
    <div class="py-6 max-w-2xl mx-auto px-4">
        <h2 class="text-2xl font-black text-forest-900 mb-6">
            {{ $person->last_name }} {{ $person->first_name }} さんの病歴を編集
        </h2>

        <form action="{{ route('people.medical-histories.update', [$person, $medicalHistory]) }}" method="POST"
            class="bg-white border border-forest-100 rounded-2xl p-6">
            @csrf
            @method('PUT')
            @include('person_medical_histories._form')

            <div class="flex justify-end gap-2 mt-2">
                <a href="{{ route('people.medical-histories.index', $person) }}"
                    class="rounded-full border border-forest-200 text-forest-800 px-5 py-2.5 text-sm font-bold hover:bg-forest-50 transition-colors">
                    キャンセル
                </a>
                <button type="submit"
                    class="rounded-full bg-forest-800 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-900 transition-colors">
                    更新
                </button>
            </div>
        </form>
    </div>
</x-app-layout>