<header class="bg-forest-600 border-b border-forest-700">
    <nav class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-lg font-black text-cream-50">
            <span class="w-9 h-9 rounded-xl bg-forest-700 flex items-center justify-center">
                <i class="ti ti-binary-tree text-xl text-cream-50"></i>
            </span>
            家族カルテ
        </a>

        @auth
        <div class="flex items-center gap-1">
            <a href="{{ route('people.index') }}"
                class="px-4 py-2 rounded-full text-sm font-bold transition-colors
                       {{ request()->routeIs('people.*') ? 'bg-forest-700 text-cream-50' : 'text-cream-100/80 hover:bg-forest-700 hover:text-cream-50' }}">
                家系図メンバー
            </a>
            <a href="{{ route('medical-conditions.index') }}"
                class="px-4 py-2 rounded-full text-sm font-bold transition-colors
                       {{ request()->routeIs('medical-conditions.*') ? 'bg-forest-700 text-cream-50' : 'text-cream-100/80 hover:bg-forest-700 hover:text-cream-50' }}">
                病名マスタ
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 rounded-full text-sm font-bold text-cream-100/80 hover:bg-forest-700 hover:text-cream-50 transition-colors">
                    ログアウト
                </button>
            </form>
        </div>
        @endauth
    </nav>
</header>