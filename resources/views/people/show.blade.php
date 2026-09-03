<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }} | 家族カルテ">
    <div class="max-w-3xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-forest-900 mb-6">
            {{ $person->last_name }} {{ $person->first_name }}
        </h1>

        <div class="max-w-3xl mx-auto py-6 px-4">
            @if (session('status'))
            <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-md px-4 py-2">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-md p-6 space-y-3">
                <dl class="grid grid-cols-2 gap-y-2 text-sm">
                    <dt class="text-gray-500">旧姓</dt>
                    <dd>{{ $person->maiden_name ?? '-' }}</dd>

                    <dt class="text-gray-500">性別</dt>
                    <dd>{{ $person->biologicalSexLabel() }}</dd>

                    <dt class="text-gray-500">生年月日</dt>
                    <dd>{{ optional($person->birth_date)->format('Y年m月d日') ?? '-' }}</dd>

                    <dt class="text-gray-500">出生地</dt>
                    <dd>{{ $person->birthplace ?? '-' }}</dd>

                    <dt class="text-gray-500">状態</dt>
                    <dd>{{ $person->is_deceased ? '故人（' . optional($person->death_date)->format('Y年m月d日') . '）' : '存命' }}</dd>

                    <dt class="text-gray-500">父</dt>
                    <dd>
                        @if ($person->biologicalFather)
                        <a href="{{ route('people.show', $person->biologicalFather) }}" class="text-emerald-700 hover:underline">
                            {{ $person->biologicalFather->last_name }} {{ $person->biologicalFather->first_name }}
                        </a>
                        <span class="text-xs text-gray-400">（{{ $person->fatherRoleLabel() }}）</span>
                        @else
                        -
                        @endif
                    </dd>

                    <dt class="text-gray-500">母</dt>
                    <dd>
                        @if ($person->biologicalMother)
                        <a href="{{ route('people.show', $person->biologicalMother) }}" class="text-emerald-700 hover:underline">
                            {{ $person->biologicalMother->last_name }} {{ $person->biologicalMother->first_name }}
                        </a>
                        <span class="text-xs text-gray-400">（{{ $person->motherRoleLabel() }}）</span>
                        @else
                        -
                        @endif
                    </dd>

                    <dt class="text-gray-500">子</dt>
                    <dd>
                        @forelse ($person->children() as $child)
                        @php
                        // $personが父・母どちらの立場でこの子と繋がっているかによってラベルを出し分ける
                        $label = $child->biological_father_id === $person->id
                        ? $child->fatherRelationshipLabel()
                        : $child->motherRelationshipLabel();
                        @endphp
                        <div>
                            <a href="{{ route('people.show', $child) }}" class="text-emerald-700 hover:underline">
                                {{ $child->last_name }} {{ $child->first_name }}
                            </a>
                            <span class="text-xs text-gray-400">（{{ $label }}）</span>
                        </div>
                        @empty
                        -
                        @endforelse
                    </dd>
                </dl>

                @if ($person->notes)
                <div class="pt-3 border-t border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">備考</p>
                    <p class="text-sm whitespace-pre-line">{{ $person->notes }}</p>
                </div>
                @endif
            </div>

            <div class="mt-4 flex gap-2">
                <a href="{{ route('people.edit', $person) }}" class="bg-emerald-700 text-white px-4 py-2 rounded-md hover:bg-emerald-800">
                    編集
                </a>
                <a href="{{ route('people.index') }}" class="px-4 py-2 rounded-md border border-gray-300">
                    一覧に戻る
                </a>
            </div>
        </div>
</x-app-layout>