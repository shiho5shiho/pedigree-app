<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }} さんの病歴 | 家族カルテ">
    <div class="py-6 max-w-4xl mx-auto px-4">
        <p class="inline-flex items-center gap-1.5 text-xs font-bold tracking-widest text-forest-600 uppercase mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-coral"></span>
            MEDICAL HISTORY
        </p>
        <h2 class="text-2xl font-black text-forest-900 mb-6">
            {{ $person->last_name }} {{ $person->first_name }} さんの病歴
        </h2>

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('people.show', $person) }}" class="text-sm font-bold text-forest-700 hover:underline">
                ← {{ $person->last_name }} {{ $person->first_name }} さんの詳細へ戻る
            </a>
            <a href="{{ route('people.medical-histories.create', $person) }}"
                class="rounded-full bg-forest-800 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-900 transition-colors">
                病歴を追加
            </a>
        </div>

        <div class="bg-white border border-forest-100 rounded-2xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-cream-100">
                    <tr>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">病名</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">状態</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">発症年齢</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">診断日</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">備考</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-forest-50">
                    @forelse ($histories as $history)
                    <tr>
                        <td class="px-4 py-3">{{ $history->medicalCondition->name }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center rounded-full bg-sage/20 px-3 py-1 text-xs font-bold text-forest-800">
                                {{ $history->statusLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $history->onset_age ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $history->diagnosed_date?->format('Y-m-d') ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $history->notes ?? '-' }}</td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('people.medical-histories.edit', [$person, $history]) }}"
                                class="text-sm font-bold text-forest-700 hover:underline">編集</a>
                            <form action="{{ route('people.medical-histories.destroy', [$person, $history]) }}"
                                method="POST" class="inline" onsubmit="return confirm('削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-600 hover:underline ml-3">削除</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-forest-700/50">
                            登録された病歴はありません。
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>