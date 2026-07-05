# バリデーションルール（v1）

## PersonRequest

| フィールド | ルール | エラーメッセージ |
|---|---|---|
| last_name | required | 姓を入力してください。 |
| | max:50 | 姓は50文字以内で入力してください。 |
| first_name | required | 名を入力してください。 |
| | max:50 | 名は50文字以内で入力してください。 |
| maiden_name | max:50 | 旧姓は50文字以内で入力してください。 |
| biological_sex | required | 性別を選択してください。 |
| | in:male,female,unknown | 性別の選択が不正です。 |
| birth_date | date | 生年月日は日付形式で入力してください。 |
| | before_or_equal:today | 生年月日には今日以前の日付を指定してください。 |
| is_deceased | required | 故人かどうかを選択してください。 |
| death_date | date | 死亡日は日付形式で入力してください。 |
| | after_or_equal:birth_date | 死亡日には生年月日以降の日付を指定してください。 |
| birthplace | max:100 | 出生地は100文字以内で入力してください。 |
| biological_father_id | exists:people,id | 選択された実父の情報が見つかりません。 |
| | 自分自身不可（カスタム） | 自分自身を実父として選択することはできません。 |
| biological_mother_id | exists:people,id | 選択された実母の情報が見つかりません。 |
| | 自分自身不可（カスタム） | 自分自身を実母として選択することはできません。 |
| is_adopted | required | 養子かどうかを選択してください。 |
| notes | max:2000 | メモは2000文字以内で入力してください。 |

## MedicalConditionRequest

| フィールド | ルール | エラーメッセージ |
|---|---|---|
| name | required | 病名を入力してください。 |
| | max:100 | 病名は100文字以内で入力してください。 |
| | unique:medical_conditions,name | この病名は既に登録されています。 |
| category | max:50 | カテゴリは50文字以内で入力してください。 |

## PersonMedicalHistoryRequest

| フィールド | ルール | エラーメッセージ |
|---|---|---|
| person_id | required | 対象の人物を指定してください。 |
| | exists:people,id | 指定された人物が見つかりません。 |
| medical_condition_id | required | 病名を選択してください。 |
| | exists:medical_conditions,id | 指定された病名が見つかりません。 |
| status | required | 診断状況を選択してください。 |
| | in:diagnosed,suspected,family_reported | 診断状況の選択が不正です。 |
| onset_age | integer | 発症年齢は数値で入力してください。 |
| | min:0 | 発症年齢は0以上で入力してください。 |
| | max:120 | 発症年齢は120以下で入力してください。 |
| diagnosed_date | date | 診断日は日付形式で入力してください。 |
| | before_or_equal:today | 診断日には今日以前の日付を指定してください。 |
| notes | max:2000 | メモは2000文字以内で入力してください。 |

## 実装メモ

- 上記のうち「required, max, date, in, exists, unique, min, after_or_equal, before_or_equal」は `lang/ja/validation.php` の翻訳＋`attributes`配列（フィールド名の日本語表示名）で自動的に反映される想定。
- 「自分自身不可」のカスタムルールのみ、対象FormRequestの`messages()`メソッドで個別に文言を指定する。