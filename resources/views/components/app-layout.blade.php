<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '家族カルテ' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // LPデザイン（家族カルテ product intro LP）から抽出したデザイントークン
        // docs/design-tokens.md にも同じ値を記載しているので、変更時は両方更新すること
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            50: '#EFF4F0',
                            100: '#DCE8DE',
                            200: '#CBE0D0',
                            300: '#8FB39A',
                            600: '#2F5140',
                            700: '#21392C',
                            800: '#1A2E22',
                            900: '#14241B',
                        },
                        cream: {
                            50: '#FAF8F3',
                            100: '#F5F1E8',
                            200: '#EDE6D6',
                        },
                        sage: '#A9C6AE',
                        coral: '#E2937A',
                    },
                    fontFamily: {
                        sans: ['"Noto Sans JP"', '"Hiragino Sans"', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
</head>

<body class="bg-cream-100 text-forest-900 font-sans">
    <x-navigation />

    <main class="max-w-5xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>
</body>

</html>