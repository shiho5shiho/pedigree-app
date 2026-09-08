<div class="mb-4">
    <label for="medical_condition_id" class="block text-sm font-medium text-forest-800">病名</label>
    <select name="medical_condition_id" id="medical_condition_id"
        class="mt-1 block w-full rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
        <option value="">選択してください</option>
        @foreach ($conditions as $condition)
        <option value="{{ $condition->id }}"
            @selected(old('medical_condition_id', $medicalHistory->medical_condition_id ?? null) == $condition->id)>
            {{ $condition->name }}
        </option>
        @endforeach
    </select>
    @error('medical_condition_id')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-forest-800 mb-2">状態</label>
    <div class="flex gap-4">
        @foreach ($statuses as $key => $label)
        <label class="inline-flex items-center gap-2">
            <input type="radio" name="status" value="{{ $key }}"
                class="border-forest-300 text-forest-700 focus:ring-forest-600"
                @checked(old('status', $medicalHistory->status ?? null) == $key)>
            <span class="text-sm text-forest-800">{{ $label }}</span>
        </label>
        @endforeach
    </div>
    @error('status')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="onset_age" class="block text-sm font-medium text-forest-800">発症年齢（任意）</label>
    <input type="number" name="onset_age" id="onset_age" min="0" max="255"
        value="{{ old('onset_age', $medicalHistory->onset_age ?? '') }}"
        class="mt-1 block w-full rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
    @error('onset_age')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="diagnosed_date" class="block text-sm font-medium text-forest-800">診断日（任意）</label>
    <input type="date" name="diagnosed_date" id="diagnosed_date"
        value="{{ old('diagnosed_date', optional($medicalHistory->diagnosed_date ?? null)->format('Y-m-d')) }}"
        class="mt-1 block w-full rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600 shadow-sm">
    @error('diagnosed_date')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="notes" class="block text-sm font-medium text-forest-800">備考（任意）</label>
    <textarea name="notes" id="notes" rows="3"
        class="mt-1 block w-full rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600 shadow-sm">{{ old('notes', $medicalHistory->notes ?? '') }}</textarea>
    @error('notes')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>