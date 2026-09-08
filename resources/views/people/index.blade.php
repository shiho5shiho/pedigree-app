<x-app-layout title="家系図メンバー一覧 | 家族カルテ">
    <div class="max-w-5xl mx-auto py-6 px-4">
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="inline-flex items-center gap-1.5 text-xs font-bold tracking-widest text-forest-600 uppercase mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-coral"></span>
                    FAMILY TREE
                </p>
                <h1 class="text-2xl font-black text-forest-900">家系図メンバー一覧</h1>
            </div>
            <a href="{{ route('people.create') }}"
                class="rounded-full bg-forest-800 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-900 transition-colors">
                + 新規登録
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
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">氏名</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">性別</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">生年月日</th>
                        <th class="px-4 py-3 text-sm font-bold text-forest-800">状態</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-forest-50">
                    @forelse ($people as $person)
                    <tr>
                        <td class="px-4 py-3">
                            <a href="{{ route('people.show', $person) }}" class="text-forest-700 font-medium hover:underline">
                                {{ $person->last_name }} {{ $person->first_name }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-forest-700/80">{{ $person->biologicalSexLabel() }}</td>
                        <td class="px-4 py-3 text-forest-700/80">{{ optional($person->birth_date)->format('Y/m/d') ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold
                                {{ $person->is_deceased ? 'bg-forest-100 text-forest-700' : 'bg-sage/20 text-forest-800' }}">
                                {{ $person->is_deceased ? '故人' : '存命' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('people.edit', $person) }}" class="text-sm font-bold text-forest-700 hover:underline">編集</a>
                            <form action="{{ route('people.destroy', $person) }}" method="POST" class="inline"
                                onsubmit="return confirm('削除してよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-600 hover:underline ml-3">削除</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-forest-700/60">まだ登録されていません。</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $people->links() }}</div>
    </div>
</x-app-layout>