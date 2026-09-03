<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }}さんの編集 | 家族カルテ">
    <div class="max-w-3xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-forest-900 mb-6">
            {{ $person->last_name }} {{ $person->first_name }} さんの編集
        </h1>

        <form method="POST" action="{{ route('people.update', $person) }}">
            @method('PUT')
            @include('people._form')
        </form>
    </div>
</x-app-layout>