<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '家族カルテ' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            50: '#f5f8f5',
                            100: '#e6eee7',
                            300: '#aecab3',
                            500: '#729c78',
                            700: '#4f7a58',
                            800: '#3d6146',
                            900: '#2e4a35',
                        },
                        cream: {
                            50: '#fdfcf9',
                            100: '#faf6ec',
                            200: '#f3ecd8',
                        },
                    },
                    fontFamily: {
                        sans: ['"Hiragino Sans"', '"Noto Sans JP"', 'sans-serif'],
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