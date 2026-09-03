@csrf

{{-- 基本情報 --}}
<h2 class="text-sm font-semibold text-forest-800 border-b border-forest-100 pb-2 mb-4">基本情報</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">姓 <span class="text-red-500">*</span></label>
        <input type="text" name="last_name" value="{{ old('last_name', $person->last_name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('last_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">名 <span class="text-red-500">*</span></label>
        <input type="text" name="first_name" value="{{ old('first_name', $person->first_name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('first_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">旧姓・養子縁組前の姓</label>
        <input type="text" name="maiden_name" value="{{ old('maiden_name', $person->maiden_name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('maiden_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">生物学的性別 <span class="text-red-500">*</span></label>
        <select name="biological_sex" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @foreach (['male' => '男性', 'female' => '女性', 'unknown' => '不明'] as $value => $label)
            <option value="{{ $value }}" @selected(old('biological_sex', $person->biological_sex ?? '') === $value)>
                {{ $label }}
            </option>
            @endforeach
        </select>
        @error('biological_sex') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">生年月日</label>
        <input type="date" name="birth_date" value="{{ old('birth_date', optional($person->birth_date ?? null)->format('Y-m-d')) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('birth_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">出生地</label>
        <input type="text" name="birthplace" value="{{ old('birthplace', $person->birthplace ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('birthplace') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- 本人の生存状況（本人の話であることを明示するため単独セクション化） --}}
<h2 class="text-sm font-semibold text-forest-800 border-b border-forest-100 pb-2 mb-4 mt-8">
    {{ $person->last_name ?? 'ご本人' }}{{ $person->first_name ?? '' }} さんの生存状況
</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_deceased" value="1" id="is_deceased"
            @checked(old('is_deceased', $person->is_deceased ?? false))
        onchange="document.getElementById('death_date_field').classList.toggle('hidden', !this.checked)">
        <label for="is_deceased" class="text-sm font-medium text-gray-700">死亡している</label>
    </div>

    <div id="death_date_field" class="{{ old('is_deceased', $person->is_deceased ?? false) ? '' : 'hidden' }}">
        <label class="block text-sm font-medium text-gray-700">死亡日</label>
        <input type="date" name="death_date" value="{{ old('death_date', optional($person->death_date ?? null)->format('Y-m-d')) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('death_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- 血縁関係 --}}
<h2 class="text-sm font-semibold text-forest-800 border-b border-forest-100 pb-2 mb-4 mt-8">血縁関係</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">父</label>
        <div class="flex items-center gap-2 mt-1">
            <select name="biological_father_id" id="biological_father_id" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">選択なし</option>
                @foreach ($people as $candidate)
                <option value="{{ $candidate->id }}" @selected((int) old('biological_father_id', $person->biological_father_id ?? '') === $candidate->id)>
                    {{ $candidate->last_name }} {{ $candidate->first_name }}
                </option>
                @endforeach
            </select>
            <button type="button" onclick="openQuickAddModal('biological_father_id')"
                class="text-xs text-emerald-700 whitespace-nowrap hover:underline">＋新規</button>
        </div>
        <div class="flex items-center gap-2 mt-2">
            <input type="checkbox" name="is_father_adopted" value="1" id="is_father_adopted"
                @checked(old('is_father_adopted', $person->is_father_adopted ?? false))>
            <label for="is_father_adopted" class="text-xs text-gray-600">父とは養子縁組による関係</label>
        </div>
        @error('biological_father_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">母</label>
        <div class="flex items-center gap-2 mt-1">
            <select name="biological_mother_id" id="biological_mother_id" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">選択なし</option>
                @foreach ($people as $candidate)
                <option value="{{ $candidate->id }}" @selected((int) old('biological_mother_id', $person->biological_mother_id ?? '') === $candidate->id)>
                    {{ $candidate->last_name }} {{ $candidate->first_name }}
                </option>
                @endforeach
            </select>
            <button type="button" onclick="openQuickAddModal('biological_mother_id')"
                class="text-xs text-emerald-700 whitespace-nowrap hover:underline">＋新規</button>
        </div>
        <div class="flex items-center gap-2 mt-2">
            <input type="checkbox" name="is_mother_adopted" value="1" id="is_mother_adopted"
                @checked(old('is_mother_adopted', $person->is_mother_adopted ?? false))>
            <label for="is_mother_adopted" class="text-xs text-gray-600">母とは養子縁組による関係</label>
        </div>
        @error('biological_mother_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- 備考 --}}
<h2 class="text-sm font-semibold text-forest-800 border-b border-forest-100 pb-2 mb-4 mt-8">備考</h2>

<div>
    <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $person->notes ?? '') }}</textarea>
    @error('notes') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
</div>

<div class="mt-8 flex gap-2">
    <button type="submit" class="bg-emerald-700 text-white px-4 py-2 rounded-md hover:bg-emerald-800">
        保存
    </button>
    <a href="{{ route('people.index') }}" class="px-4 py-2 rounded-md border border-gray-300">キャンセル</a>
</div>

{{-- 親人物クイック登録モーダル --}}
<div id="quick-add-modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold text-forest-900 mb-4">新しい人物を登録</h3>
        <p class="text-xs text-gray-500 mb-4">氏名と性別のみの簡易登録です。詳細は後から編集画面で入力できます。</p>

        <div class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">姓 <span class="text-red-500">*</span></label>
                <input type="text" id="quick_last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">名 <span class="text-red-500">*</span></label>
                <input type="text" id="quick_first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">生物学的性別 <span class="text-red-500">*</span></label>
                <select id="quick_biological_sex" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="male">男性</option>
                    <option value="female">女性</option>
                    <option value="unknown">不明</option>
                </select>
            </div>
            <p id="quick-add-error" class="text-sm text-red-600 hidden"></p>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button type="button" onclick="closeQuickAddModal()" class="px-4 py-2 rounded-md border border-gray-300">
                キャンセル
            </button>
            <button type="button" onclick="submitQuickAdd()" class="bg-emerald-700 text-white px-4 py-2 rounded-md hover:bg-emerald-800">
                登録して選択
            </button>
        </div>
    </div>
</div>

<script>
    const peopleStoreUrl = @json(route('people.store'));

    let quickAddTargetSelectId = null;

    function openQuickAddModal(targetSelectId) {
        quickAddTargetSelectId = targetSelectId;
        document.getElementById('quick_last_name').value = '';
        document.getElementById('quick_first_name').value = '';
        document.getElementById('quick_biological_sex').value = 'male';
        document.getElementById('quick-add-error').classList.add('hidden');
        document.getElementById('quick-add-modal').classList.remove('hidden');
    }

    function closeQuickAddModal() {
        document.getElementById('quick-add-modal').classList.add('hidden');
    }

    async function submitQuickAdd() {
        const lastName = document.getElementById('quick_last_name').value.trim();
        const firstName = document.getElementById('quick_first_name').value.trim();
        const biologicalSex = document.getElementById('quick_biological_sex').value;
        const errorEl = document.getElementById('quick-add-error');

        if (!lastName || !firstName) {
            errorEl.textContent = '姓と名は必須です。';
            errorEl.classList.remove('hidden');
            return;
        }

        try {
            const response = await fetch(peopleStoreUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    last_name: lastName,
                    first_name: firstName,
                    biological_sex: biologicalSex,
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                const firstError = data.errors ? Object.values(data.errors)[0][0] : (data.message ?? '登録に失敗しました。');
                errorEl.textContent = firstError;
                errorEl.classList.remove('hidden');
                return;
            }

            // 父・母どちらのセレクトにも選択肢として追加しておく（後で逆側の親として使う可能性があるため）
            ['biological_father_id', 'biological_mother_id'].forEach((selectId) => {
                const select = document.getElementById(selectId);
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.name;
                select.appendChild(option);
            });

            // クリック元のセレクトに、今登録した人物を選択状態にする
            document.getElementById(quickAddTargetSelectId).value = data.id;

            closeQuickAddModal();
        } catch (e) {
            errorEl.textContent = '通信エラーが発生しました。';
            errorEl.classList.remove('hidden');
        }
    }
</script>