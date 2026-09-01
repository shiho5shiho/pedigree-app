<x-app-layout title="ダッシュボード | 家族カルテ">

    {{-- Hero --}}
    <section class="mb-12">

        <h1 class="text-4xl font-bold tracking-tight text-gray-900 leading-tight">
            家族の健康を<span class="text-teal-600">未来へつなぐ。</span>
        </h1>

        <p class="mt-5 max-w-3xl text-lg text-gray-600 leading-8">
            家族の血縁関係や病歴を記録・管理し、
            大切な健康情報を未来へ受け継ぐためのアプリケーションです。
        </p>

    </section>

    {{-- Menu --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- 家系図 --}}
        <div
            class="bg-white border border-gray-200 rounded-xl p-6 transition duration-200
                   hover:border-teal-500 hover:shadow-lg">

            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl">👨‍👩‍👧</span>
                <h2 class="text-lg font-semibold text-gray-900">
                    家系図メンバー
                </h2>
            </div>

            <p class="text-sm text-gray-600 leading-6">
                家族の情報を登録・管理します。
            </p>

            <p class="mt-5 text-xs text-amber-600 font-medium">
                🚧 順次公開予定
            </p>

        </div>

        {{-- 病歴 --}}
        <div
            class="bg-white border border-gray-200 rounded-xl p-6 transition duration-200
                   hover:border-teal-500 hover:shadow-lg">

            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl">🩺</span>
                <h2 class="text-lg font-semibold text-gray-900">
                    病歴記録
                </h2>
            </div>

            <p class="text-sm text-gray-600 leading-6">
                病歴や診断情報を記録・管理します。
            </p>

            <p class="mt-5 text-xs text-amber-600 font-medium">
                🚧 順次公開予定
            </p>

        </div>

    </section>

</x-app-layout>