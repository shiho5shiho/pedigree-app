<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }} | 家族カルテ">
    <div class="max-w-3xl mx-auto py-6 px-4">
        <div class="flex items-center gap-4 mb-6">
            <span class="w-14 h-14 rounded-2xl bg-forest-600 text-cream-50 flex items-center justify-center text-xl font-black shrink-0">
                {{ mb_substr($person->last_name, 0, 1) }}
            </span>
            <h1 class="text-2xl font-black text-forest-900">
                {{ $person->last_name }} {{ $person->first_name }}
            </h1>
        </div>

        @if (session('status'))
        <div class="mb-4 text-sm text-forest-800 bg-forest-50 border border-forest-100 rounded-xl px-4 py-2">
            {{ session('status') }}
        </div>
        @endif

        <div class="bg-white border border-forest-100 rounded-2xl p-6 space-y-3">
            <dl class="grid grid-cols-2 gap-y-3 text-sm">
                <dt class="text-forest-700/60">旧姓</dt>
                <dd>{{ $person->maiden_name ?? '-' }}</dd>

                <dt class="text-forest-700/60">性別</dt>
                <dd>{{ $person->biologicalSexLabel() }}</dd>

                <dt class="text-forest-700/60">生年月日</dt>
                <dd>{{ optional($person->birth_date)->format('Y年m月d日') ?? '-' }}</dd>

                <dt class="text-forest-700/60">出生地</dt>
                <dd>{{ $person->birthplace ?? '-' }}</dd>

                <dt class="text-forest-700/60">状態</dt>
                <dd>{{ $person->is_deceased ? '故人（' . optional($person->death_date)->format('Y年m月d日') . '）' : '存命' }}</dd>

                <dt class="text-forest-700/60">父</dt>
                <dd>
                    @if ($person->biologicalFather)
                    <a href="{{ route('people.show', $person->biologicalFather) }}" class="text-forest-700 font-medium hover:underline">
                        {{ $person->biologicalFather->last_name }} {{ $person->biologicalFather->first_name }}
                    </a>
                    <span class="text-xs text-forest-700/50">（{{ $person->fatherRoleLabel() }}）</span>
                    @else
                    -
                    @endif
                </dd>

                <dt class="text-forest-700/60">母</dt>
                <dd>
                    @if ($person->biologicalMother)
                    <a href="{{ route('people.show', $person->biologicalMother) }}" class="text-forest-700 font-medium hover:underline">
                        {{ $person->biologicalMother->last_name }} {{ $person->biologicalMother->first_name }}
                    </a>
                    <span class="text-xs text-forest-700/50">（{{ $person->motherRoleLabel() }}）</span>
                    @else
                    -
                    @endif
                </dd>

                <dt class="text-forest-700/60">子</dt>
                <dd>
                    @forelse ($person->children() as $child)
                    @php
                    // $personが父・母どちらの立場でこの子と繋がっているかによってラベルを出し分ける
                    $label = $child->biological_father_id === $person->id
                    ? $child->fatherRelationshipLabel()
                    : $child->motherRelationshipLabel();
                    @endphp
                    <div>
                        <a href="{{ route('people.show', $child) }}" class="text-forest-700 font-medium hover:underline">
                            {{ $child->last_name }} {{ $child->first_name }}
                        </a>
                        <span class="text-xs text-forest-700/50">（{{ $label }}）</span>
                    </div>
                    @empty
                    -
                    @endforelse
                </dd>
            </dl>

            @if ($person->notes)
            <div class="pt-3 border-t border-forest-100">
                <p class="text-sm text-forest-700/60 mb-1">備考</p>
                <p class="text-sm whitespace-pre-line">{{ $person->notes }}</p>
            </div>
            @endif
        </div>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('people.edit', $person) }}"
                class="rounded-full bg-forest-800 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-900 transition-colors">
                編集
            </a>
            <a href="{{ route('people.medical-histories.index', $person) }}"
                class="rounded-full border border-forest-200 text-forest-800 px-5 py-2.5 text-sm font-bold hover:bg-forest-50 transition-colors">
                病歴一覧を見る
            </a>
            <a href="{{ route('people.index') }}"
                class="rounded-full border border-forest-200 text-forest-800 px-5 py-2.5 text-sm font-bold hover:bg-forest-50 transition-colors">
                一覧に戻る
            </a>
        </div>
    </div>
</x-app-layout>