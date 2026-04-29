<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SIKAPI' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="bg-background text-on-background antialiased flex">
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

    <x-navigations.sidebar />

    <main class="flex-1 flex flex-col ml-0 md:ml-[280px] min-h-screen overflow-hidden w-full">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>

</html>
