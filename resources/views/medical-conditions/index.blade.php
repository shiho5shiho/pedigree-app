<x-app-layout title="病名マスタ一覧 | 家族カルテ">
    <div class="max-w-3xl mx-auto py-6 px-4">
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="inline-flex items-center gap-1.5 text-xs font-bold tracking-widest text-forest-600 uppercase mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-coral"></span>
                    CONDITION MASTER
                </p>
                <h1 class="text-2xl font-black text-forest-900">病名マスタ一覧</h1>
            </div>
            <a href="{{ route('medical-conditions.create') }}"
                class="rounded-full bg-forest-800 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-900 transition-colors">
                新規登録
            </a>
        </div>

        @if (session('status'))
        <div class="mb-4 text-sm text-forest-800 bg-forest-50 border border-forest-100 rounded-xl px-4 py-2">
            {{ session('status') }}
        </div>
        @endif

        <div class="bg-white border border-forest-100 rounded-2xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-cream-100">
                    <tr>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">病名</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">分類</th>
                        <th class="px-4 py-3 text-right text-sm font-bold text-forest-800">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-forest-50">
                    @forelse ($medicalConditions as $condition)
                    <tr>
                        <td class="px-4 py-3">{{ $condition->name }}</td>
                        <td class="px-4 py-3">
                            @if ($condition->category)
                            <span class="inline-flex items-center rounded-full bg-sage/20 px-3 py-1 text-xs font-bold text-forest-800">
                                {{ $condition->category }}
                            </span>
                            @else
                            <span class="text-forest-700/40">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('medical-conditions.edit', $condition) }}"
                                class="text-sm font-bold text-forest-700 hover:underline">編集</a>
                            <form action="{{ route('medical-conditions.destroy', $condition) }}"
                                method="POST" class="inline"
                                onsubmit="return confirm('削除しますか？この病名を使っている病歴も同時に削除されます。');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-600 hover:underline">削除</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-forest-700/50">
                            登録されている病名がありません。
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>