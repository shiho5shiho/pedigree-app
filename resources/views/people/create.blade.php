<x-app-layout title="人物の新規登録 | 家族カルテ">
    <div class="max-w-3xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-black text-forest-900 mb-6">人物の新規登録</h1>

        <form method="POST" action="{{ route('people.store') }}"
            class="bg-white border border-forest-100 rounded-2xl p-6">
            @include('people._form', ['person' => new \App\Models\Person()])
        </form>
    </div>
</x-app-layout>