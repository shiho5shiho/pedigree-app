<!-- docs/design-tokens.md -->
# デザイントークン

家族カルテのために作成したLP（プロダクト紹介ランディングページ）のビジュアルスタイルを、
アプリ本体（Bladeテンプレート）に統一するために抽出したデザイントークン。

適用箇所: `resources/views/components/app-layout.blade.php` の `tailwind.config`

## 色

| トークン     | 用途                                                                                              | 値        |
| ------------ | ------------------------------------------------------------------------------------------------- | --------- |
| `forest-50`  | ごく薄い背景・アラート背景                                                                        | `#EFF4F0` |
| `forest-100` | カード・入力欄のヘアラインボーダー                                                                | `#DCE8DE` |
| `forest-200` | ボタン・入力欄のボーダー（100と300の中間値・補完）                                                | `#CBE0D0` |
| `forest-300` | 補助的なアクセント                                                                                | `#8FB39A` |
| `forest-600` | **大きい塗り面のメインカラー**（ナビ背景・強調カード背景・プライマリボタン）                      | `#2F5140` |
| `forest-700` | `forest-600`要素のホバー・ボーダー・アイコン背景                                                  | `#21392C` |
| `forest-800` | 見出しテキストなど、面積の小さい用途のみ（大きい塗り面には使わない）                              | `#1A2E22` |
| `forest-900` | 本文見出しの文字色・モーダルの半透明オーバーレイ（`forest-900/40`）のみ。大きい塗り面には使わない | `#14241B` |
| `cream-50`   | カード内の白背景に近い色                                                                          | `#FAF8F3` |
| `cream-100`  | ページ全体の背景・テーブルヘッダー背景                                                            | `#F5F1E8` |
| `cream-200`  | やや濃いクリーム                                                                                  | `#EDE6D6` |
| `sage`       | バッジ・アイコン背景（装飾円）                                                                    | `#A9C6AE` |
| `coral`      | eyebrowラベルのドット等、控えめなアクセント                                                       | `#E2937A` |

※ `forest-200` はLPスクリーンショットには存在しない値だが、フォーム部品のボーダー用に
`forest-100` と `forest-300` の中間値として補完した。

**改訂メモ：** 当初はナビ背景・強調カードに`forest-800`〜`900`を使っていたが、実機で見ると
LPの印象より重く・黒っぽく感じられたため、大きい塗り面はすべて`forest-600`に変更した。
`800`/`900`は見出し文字色やモーダルの暗幕など、面積の小さい・半透明の用途にのみ残している。

## フォント

- 本文・見出しともに `Noto Sans JP`（Google Fonts経由）
- 見出しは `font-black`（900）〜 `font-bold`（700）の極太ウェイトを使用し、装飾的なセリフ体は使わない

## 形状・コンポーネントパターン

| 要素                   | クラス例                                                                                                                                             | 備考                                                                                          |
| ---------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| カード                 | `bg-white border border-forest-100 rounded-2xl p-6`                                                                                                  | 影ではなくヘアラインボーダーで区切る。`shadow`はほぼ使わない                                  |
| 強調カード（ダーク）   | `bg-forest-600 rounded-2xl p-6`                                                                                                                      | フラッグシップ機能など、グリッド内で1枚だけ強調したい場合に使用                               |
| プライマリボタン       | `rounded-full bg-forest-600 text-cream-50 px-5 py-2.5 text-sm font-bold hover:bg-forest-700`                                                         | pill形状                                                                                      |
| セカンダリボタン       | `rounded-full border border-forest-200 text-forest-800 px-5 py-2.5 text-sm font-bold hover:bg-forest-50`                                             | 枠線のみ                                                                                      |
| バッジ                 | `inline-flex items-center rounded-full bg-sage/20 px-3 py-1 text-xs font-bold text-forest-800`                                                       | ステータス表示等。「実装済み」等の説明バッジは冗長と判断し不使用に                            |
| eyebrowラベル          | `inline-flex items-center gap-1.5 text-xs font-bold tracking-widest text-forest-600 uppercase` + 先頭に `w-1.5 h-1.5 rounded-full bg-coral` のドット | 見出しの前に添える英字ラベル（`FAMILY HEALTH RECORD`等）                                      |
| 装飾円（ヒーロー背景） | `<x-decorative-blobs />`（`components/decorative-blobs.blade.php`）                                                                                  | セージ×コーラルの滲んだ円。親要素に`relative`が必要。ダッシュボード・ログイン・新規登録で使用 |
| 入力欄                 | `rounded-xl border-forest-200 focus:border-forest-600 focus:ring-forest-600`                                                                         | 角丸をやや強め、フォーカス色をforest-600に統一                                                |
| テーブル               | `bg-white border border-forest-100 rounded-2xl overflow-hidden` + `thead` は `bg-cream-100`                                                          | 影なし                                                                                        |
| アイコンボックス       | `w-10 h-10 rounded-xl bg-sage/20 flex items-center justify-center`                                                                                   | ナビ・ダッシュボードのアイコン装飾（ダークカード上では`bg-forest-700`）                       |

## 対応範囲（Issue #9）

- [x] `components/app-layout.blade.php`（tailwind.config・フォント読み込み）
- [x] `components/navigation.blade.php`
- [x] `components/decorative-blobs.blade.php`（新規）
- [x] `dashboard.blade.php`
- [x] `auth/login.blade.php`, `auth/register.blade.php`
- [x] `people/*.blade.php`
- [x] `medical-conditions/*.blade.php`
- [x] `person_medical_histories/*.blade.php`
- [ ] `welcome.blade.php`（`/` は常にログイン画面へリダイレクトされるため未使用。別Issueで削除を検討）