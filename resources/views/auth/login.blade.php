<x-app-layout title="ログイン | 家族カルテ">
    <div class="relative max-w-md mx-auto">
        <x-decorative-blobs class="opacity-60" />

        <div class="bg-white border border-forest-100 rounded-2xl p-8">
            <h1 class="text-xl font-black mb-6 text-center text-forest-900">ログイン</h1>

            @if (session('status'))
            <div class="mb-4 text-sm text-forest-800 bg-forest-50 border border-forest-100 rounded-xl px-4 py-2">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-forest-800">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full rounded-xl border-forest-100 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-forest-800">パスワード</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full rounded-xl border-forest-100 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" class="rounded border-forest-300 text-forest-700">
                    <label for="remember" class="ml-2 text-sm text-forest-700">ログイン状態を保持する</label>
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-forest-800 text-cream-50 py-2.5 font-bold hover:bg-forest-900 transition-colors">
                    ログイン
                </button>
            </form>

            <p class="text-sm text-forest-700/70 text-center mt-6">
                アカウントをお持ちでないですか？
                <a href="{{ route('register') }}" class="text-forest-800 font-bold underline">新規登録</a>
            </p>
        </div>
    </div>
</x-app-layout>