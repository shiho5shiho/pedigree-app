<x-app-layout title="{{ $person->last_name }} {{ $person->first_name }} さんの病歴 | 家族カルテ">
    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-black text-forest-900 mb-6">
            {{ $person->last_name }} {{ $person->first_name }} さんの病歴
        </h2>

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('people.show', $person) }}" class="text-forest-600 hover:underline text-sm">
                ← {{ $person->last_name }} {{ $person->first_name }} さんの詳細へ戻る
            </a>
            <a href="{{ route('people.medical-histories.create', $person) }}"
                class="bg-forest-800 text-cream-50 px-5 py-2.5 rounded-full font-bold hover:bg-forest-900 text-sm">
                病歴を追加
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-forest-50">
                    <tr>
                        <th class="px-4 py-2">病名</th>
                        <th class="px-4 py-2">状態</th>
                        <th class="px-4 py-2">発症年齢</th>
                        <th class="px-4 py-2">診断日</th>
                        <th class="px-4 py-2">備考</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $history)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $history->medicalCondition->name }}</td>
                        <td class="px-4 py-2">{{ $history->statusLabel() }}</td>
                        <td class="px-4 py-2">{{ $history->onset_age ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $history->diagnosed_date?->format('Y-m-d') ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $history->notes ?? '-' }}</td>
                        <td class="px-4 py-2 text-right whitespace-nowrap">
                            <a href="{{ route('people.medical-histories.edit', [$person, $history]) }}"
                                class="text-forest-600 hover:underline">編集</a>
                            <form action="{{ route('people.medical-histories.destroy', [$person, $history]) }}"
                                method="POST" class="inline" onsubmit="return confirm('削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">削除</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                            登録された病歴はありません。
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>