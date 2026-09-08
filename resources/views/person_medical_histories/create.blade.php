<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }} さんの病歴 | 家族カルテ">
    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-black text-forest-900 mb-6">
            {{ $person->last_name }} {{ $person->first_name }} さんの病歴を追加
        </h2>

        <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('people.medical-histories.store', $person) }}" method="POST"
                class="bg-white shadow rounded-lg p-6">
                @csrf
                @include('person_medical_histories._form', ['medicalHistory' => null])

                <div class="flex justify-end gap-2">
                    <a href="{{ route('people.medical-histories.index', $person) }}"
                        class="px-4 py-2 text-gray-600">キャンセル</a>
                    <button type="submit" class="bg-forest-700 text-cream-50 px-4 py-2 rounded hover:bg-forest-800">
                        登録
                    </button>
                </div>
            </form>
        </div>
</x-app-layout>