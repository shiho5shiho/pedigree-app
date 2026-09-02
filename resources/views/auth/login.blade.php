<x-app-layout title="ログイン | 家族カルテ">
    <div class="max-w-md mx-auto bg-cream-50 border border-forest-100 rounded-lg shadow-sm p-8">
        <h1 class="text-xl font-bold mb-6 text-center text-forest-800">ログイン</h1>

        @if (session('status'))
        <div class="mb-4 text-sm text-forest-700">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-forest-800">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-forest-100 focus:border-forest-500 focus:ring-forest-500 shadow-sm">
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-forest-800">パスワード</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-md border-forest-100 focus:border-forest-500 focus:ring-forest-500 shadow-sm">
                @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember" class="rounded border-forest-300 text-forest-700">
                <label for="remember" class="ml-2 text-sm text-forest-700">ログイン状態を保持する</label>
            </div>

            <button type="submit"
                class="w-full bg-forest-800 text-cream-50 rounded-md py-2 font-medium hover:bg-forest-700 transition-colors">
                ログイン
            </button>
        </form>

        <p class="text-sm text-forest-500 text-center mt-6">
            アカウントをお持ちでないですか？
            <a href="{{ route('register') }}" class="text-forest-800 underline">新規登録</a>
        </p>
    </div>
</x-app-layout>