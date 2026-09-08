<div class="mb-4">
    <label for="medical_condition_id" class="block font-medium text-sm text-gray-700">病名</label>
    <select name="medical_condition_id" id="medical_condition_id"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        <option value="">選択してください</option>
        @foreach ($conditions as $condition)
        <option value="{{ $condition->id }}"
            @selected(old('medical_condition_id', $medicalHistory->medical_condition_id ?? null) == $condition->id)>
            {{ $condition->name }}
        </option>
        @endforeach
    </select>
    @error('medical_condition_id')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-medium text-sm text-gray-700 mb-2">状態</label>
    <div class="flex gap-4">
        @foreach ($statuses as $key => $label)
        <label class="inline-flex items-center">
            <input type="radio" name="status" value="{{ $key }}"
                @checked(old('status', $medicalHistory->status ?? null) == $key)>
            <span class="ml-2">{{ $label }}</span>
        </label>
        @endforeach
    </div>
    @error('status')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="onset_age" class="block font-medium text-sm text-gray-700">発症年齢（任意）</label>
    <input type="number" name="onset_age" id="onset_age" min="0" max="255"
        value="{{ old('onset_age', $medicalHistory->onset_age ?? '') }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    @error('onset_age')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="diagnosed_date" class="block font-medium text-sm text-gray-700">診断日（任意）</label>
    <input type="date" name="diagnosed_date" id="diagnosed_date"
        value="{{ old('diagnosed_date', optional($medicalHistory->diagnosed_date ?? null)->format('Y-m-d')) }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    @error('diagnosed_date')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="notes" class="block font-medium text-sm text-gray-700">備考（任意）</label>
    <textarea name="notes" id="notes" rows="3"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes', $medicalHistory->notes ?? '') }}</textarea>
    @error('notes')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>