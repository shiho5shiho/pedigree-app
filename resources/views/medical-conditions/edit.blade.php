<x-app-layout title="{{ $medicalCondition->name }} の編集 | 家族カルテ">
    <div class="max-w-2xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-forest-900 mb-6">
            {{ $medicalCondition->name }} の編集
        </h1>

        <form method="POST" action="{{ route('medical-conditions.update', $medicalCondition) }}">
            @method('PUT')
            @include('medical-conditions._form')
        </form>
    </div>
</x-app-layout>