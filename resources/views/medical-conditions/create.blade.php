<x-app-layout title="病名の新規登録 | 家族カルテ">
    <div class="max-w-2xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-forest-900 mb-6">病名の新規登録</h1>

        <form method="POST" action="{{ route('medical-conditions.store') }}">
            @include('medical-conditions._form', ['medicalCondition' => new \App\Models\MedicalCondition()])
        </form>
    </div>
</x-app-layout>