<x-app-layout title="新規登録 | 家族カルテ">
    <div class="max-w-md mx-auto bg-cream-50 border border-forest-100 rounded-lg shadow-sm p-8">
        <h1 class="text-xl font-bold mb-6 text-center text-forest-800">新規登録</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-forest-800">名前</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-forest-100 focus:border-forest-500 focus:ring-forest-500 shadow-sm">
                @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-forest-800">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-forest-800">パスワード（確認）</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-md border-forest-100 focus:border-forest-500 focus:ring-forest-500 shadow-sm">
            </div>

            <button type="submit"
                class="w-full bg-forest-800 text-cream-50 rounded-md py-2 font-medium hover:bg-forest-700 transition-colors">
                登録する
            </button>
        </form>

        <p class="text-sm text-forest-500 text-center mt-6">
            すでにアカウントをお持ちですか？
            <a href="{{ route('login') }}" class="text-forest-800 underline">ログイン</a>
        </p>
    </div>
</x-app-layout>