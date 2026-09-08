<x-app-layout title="ダッシュボード | 家族カルテ">

    {{-- Hero --}}
    <section class="relative mb-14">
        <x-decorative-blobs />

        <p class="inline-flex items-center gap-1.5 text-xs font-bold tracking-widest text-forest-600 uppercase mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-coral"></span>
            FAMILY HEALTH RECORD
        </p>

        <h1 class="text-4xl font-black tracking-tight text-forest-900 leading-tight">
            家族の健康を<span class="text-forest-600">未来へつなぐ。</span>
        </h1>

        <p class="mt-5 max-w-2xl text-lg text-forest-700/80 leading-8">
            家族の血縁関係や病歴を記録・管理し、
            大切な健康情報を未来へ受け継ぐためのアプリケーションです。
        </p>

        <div class="mt-6 flex items-center gap-2 text-sm">
            <span class="w-2 h-2 rounded-full bg-forest-600"></span>
            <span class="font-bold text-forest-900">v1開発中</span>
            <span class="text-forest-700/60">認証基盤・人物管理・病歴管理を実装済み</span>
        </div>
    </section>

    {{-- Menu --}}
    <section>
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-2 mb-6">
            <h2 class="text-2xl font-black text-forest-900">できること</h2>
            <p class="text-sm text-forest-700/60 max-w-sm">登録した家族の情報は、いつでも編集・追記できます。</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- 家系図（フラッグシップ機能として1枚だけダークカードで強調） --}}
            <a href="{{ route('people.index') }}"
                class="block bg-forest-600 rounded-2xl p-6 transition-transform duration-200 hover:-translate-y-0.5">

                <span class="w-10 h-10 rounded-xl bg-forest-700 flex items-center justify-center text-xl mb-4">👨‍👩‍👧</span>

                <h3 class="text-lg font-bold text-cream-50 mb-2">
                    家系図メンバー
                </h3>

                <p class="text-sm text-cream-100/70 leading-6">
                    家族の情報を登録し、親子関係をたどって家系図として管理します。
                </p>
            </a>

            {{-- 病名マスタ・病歴 --}}
            <a href="{{ route('medical-conditions.index') }}"
                class="block bg-white border border-forest-100 rounded-2xl p-6 transition-colors duration-200 hover:border-forest-600">

                <span class="w-10 h-10 rounded-xl bg-sage/20 flex items-center justify-center text-xl mb-4">🩺</span>

                <h3 class="text-lg font-bold text-forest-900 mb-2">
                    病名マスタ・病歴
                </h3>

                <p class="text-sm text-forest-700/80 leading-6">
                    病名マスタを管理します。各メンバーの病歴は、詳細ページから記録・管理できます。
                </p>
            </a>

        </div>
    </section>

</x-app-layout>