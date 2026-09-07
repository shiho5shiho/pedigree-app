@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">病名</label>
        <input type="text" name="name" value="{{ old('name', $medicalCondition->name ?? '') }}"
            class="mt-1 block w-full rounded border-gray-300">
        @error('name')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">分類（任意）</label>
        <input type="text" name="category" list="category-suggestions"
            value="{{ old('category', $medicalCondition->category ?? '') }}"
            class="mt-1 block w-full rounded border-gray-300">
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

<div class="mt-6">
    <button type="submit" class="bg-forest-700 text-white px-4 py-2 rounded hover:bg-forest-800">
        保存
    </button>
</div>