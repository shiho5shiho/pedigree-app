# テーブル定義（v1）

## people

| カラム名 | 型 | 制約 |
|---|---|---|
| id | bigint | PK |
| user_id | bigint | FK(users.id), nullable, ON DELETE SET NULL |
| last_name | varchar(50) | NOT NULL |
| first_name | varchar(50) | NOT NULL |
| maiden_name | varchar(50) | nullable |
| biological_sex | enum(male,female,unknown) | NOT NULL |
| birth_date | date | nullable |
| is_deceased | boolean | NOT NULL, default false |
| death_date | date | nullable |
| birthplace | varchar(100) | nullable |
| biological_father_id | bigint | FK(people.id), nullable, ON DELETE SET NULL |
| biological_mother_id | bigint | FK(people.id), nullable, ON DELETE SET NULL |
| is_adopted | boolean | NOT NULL, default false |
| notes | text | nullable |
| created_by | bigint | FK(users.id), nullable, ON DELETE SET NULL |
| created_at / updated_at | timestamp | - |

## medical_conditions

| カラム名 | 型 | 制約 |
|---|---|---|
| id | bigint | PK |
| name | varchar(100) | NOT NULL, UNIQUE |
| category | varchar(50) | nullable |
| created_at / updated_at | timestamp | - |

## person_medical_histories

| カラム名 | 型 | 制約 |
|---|---|---|
| id | bigint | PK |
| person_id | bigint | FK(people.id), NOT NULL, ON DELETE CASCADE |
| medical_condition_id | bigint | FK(medical_conditions.id), NOT NULL, ON DELETE CASCADE |
| status | enum(diagnosed,suspected,family_reported) | NOT NULL |
| onset_age | tinyint unsigned | nullable |
| diagnosed_date | date | nullable |
| notes | text | nullable |
| created_by | bigint | FK(users.id), nullable, ON DELETE SET NULL |
| created_at / updated_at | timestamp | - |

## 設計メモ

- `biological_father_id` / `biological_mother_id` は `nullOnDelete`。親レコードを削除しても子の記録自体は消さない方針。
- `person_medical_histories` の `person_id` / `medical_condition_id` は `cascadeOnDelete`。本人や病名が消えたら病歴単体は意味を持たないため連動削除。
- 兄弟姉妹関係は専用テーブルを持たない。`biological_father_id` / `biological_mother_id` が一致する人物を検索して導出する。
- `biological_sex`は`gender`ではなく医学的な生物学的性を表す名前にしている。X連鎖遺伝（血友病・色覚異常等）やBRCA関連リスクなど、遺伝学的リスク評価において生物学的性別が直接関わるため。