<header class="bg-forest-800 border-b border-forest-900">
    <nav class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-bold text-cream-100">
            <i class="ti ti-binary-tree text-2xl"></i>
            家族カルテ
        </a>

        @auth
        <a href="{{ route('people.index') }}" class="text-sm text-cream-100/80 hover:text-cream-100">
            家系図メンバー
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-cream-100/80 hover:text-cream-100">ログアウト</button>
        </form>
        @endauth
    </nav>
</header>