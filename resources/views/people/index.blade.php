<x-app-layout title="家系図メンバー一覧 | 家族カルテ">
    <h1 class="text-2xl font-bold text-forest-900 mb-6">家系図メンバー一覧</h1>

    <div class="max-w-5xl mx-auto py-6 px-4">
        @if (session('status'))
        <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-md px-4 py-2">
            {{ session('status') }}
        </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('people.create') }}" class="bg-emerald-700 text-white px-4 py-2 rounded-md hover:bg-emerald-800">
                + 新規登録
            </a>
        </div>

        <table class="w-full bg-white border border-gray-200 rounded-md overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-2 text-sm font-medium text-gray-600">氏名</th>
                    <th class="text-left px-4 py-2 text-sm font-medium text-gray-600">性別</th>
                    <th class="text-left px-4 py-2 text-sm font-medium text-gray-600">生年月日</th>
                    <th class="text-left px-4 py-2 text-sm font-medium text-gray-600">状態</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($people as $person)
                <tr>
                    <td class="px-4 py-2">
                        <a href="{{ route('people.show', $person) }}" class="text-emerald-700 hover:underline">
                            {{ $person->last_name }} {{ $person->first_name }}
                        </a>
                    </td>
                    <td class="px-4 py-2">{{ $person->biologicalSexLabel() }}</td>
                    <td class="px-4 py-2">{{ optional($person->birth_date)->format('Y/m/d') ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $person->is_deceased ? '故人' : '存命' }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('people.edit', $person) }}" class="text-sm text-gray-600 hover:text-gray-900">編集</a>
                        <form action="{{ route('people.destroy', $person) }}" method="POST" class="inline"
                            onsubmit="return confirm('削除してよろしいですか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 ml-2">削除</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">まだ登録されていません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $people->links() }}</div>
    </div>
</x-app-layout>