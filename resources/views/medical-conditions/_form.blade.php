@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-forest-800">病名</label>
        <input type="text" name="name" value="{{ old('name', $medicalCondition->name ?? '') }}"
            class="mt-1 block w-full rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
        @error('name')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-forest-800">分類（任意）</label>
        <input type="text" name="category" list="category-suggestions"
            value="{{ old('category', $medicalCondition->category ?? '') }}"
            class="mt-1 block w-full rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
        <datalist id="category-suggestions">
            <option value="内分泌・代謝">
            <option value="循環器">
            <option value="精神・神経">
            <option value="悪性腫瘍">
            <option value="免疫・アレルギー">
            <option value="その他">
        </datalist>
        @error('category')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8 flex gap-2">
    <button type="submit"
        class="rounded-full bg-forest-800 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-900 transition-colors">
        保存
    </button>
    <a href="{{ route('medical-conditions.index') }}"
        class="rounded-full border border-forest-200 text-forest-800 px-5 py-2.5 text-sm font-bold hover:bg-forest-50 transition-colors">
        キャンセル
    </a>
</div>