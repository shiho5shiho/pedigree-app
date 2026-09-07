<x-app-layout title="病名マスタ一覧 | 家族カルテ">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-forest-900">病名マスタ一覧</h1>
        <a href="{{ route('medical-conditions.create') }}"
            class="bg-forest-700 text-white px-4 py-2 rounded hover:bg-forest-800">
            新規登録
        </a>
    </div>

    @if (session('status'))
    <div class="mb-4 bg-forest-50 border border-forest-300 text-forest-900 px-4 py-2 rounded">
        {{ session('status') }}
    </div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-cream-200 text-forest-900">
                <tr>
                    <th class="px-4 py-2">病名</th>
                    <th class="px-4 py-2">分類</th>
                    <th class="px-4 py-2 text-right">操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicalConditions as $condition)
                <tr class="border-t border-cream-200">
                    <td class="px-4 py-2">{{ $condition->name }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $condition->category ?? '-' }}</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('medical-conditions.edit', $condition) }}"
                            class="text-forest-700 hover:underline">編集</a>
                        <form action="{{ route('medical-conditions.destroy', $condition) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しますか？この病名を使っている病歴も同時に削除されます。');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">削除</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-gray-400">
                        登録されている病名がありません。
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>