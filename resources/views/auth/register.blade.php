<x-app-layout title="新規登録 | 家族カルテ">
    <div class="relative max-w-md mx-auto">
        <x-decorative-blobs class="opacity-60" />

        <div class="bg-white border border-forest-100 rounded-2xl p-8">
            <h1 class="text-xl font-black mb-6 text-center text-forest-900">新規登録</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-forest-800">名前</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="mt-1 block w-full rounded-xl border-forest-100 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-forest-800">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-forest-800">パスワード（確認）</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 block w-full rounded-xl border-forest-100 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-forest-800 text-cream-50 py-2.5 font-bold hover:bg-forest-900 transition-colors">
                    登録する
                </button>
            </form>

            <p class="text-sm text-forest-700/70 text-center mt-6">
                すでにアカウントをお持ちですか？
                <a href="{{ route('login') }}" class="text-forest-800 font-bold underline">ログイン</a>
            </p>
        </div>
    </div>
</x-app-layout>