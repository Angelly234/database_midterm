<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>
        @yield('title')
    </title>
</head>

<body class="min-h-screen flex flex-col justify-between bg-blue-900 text-white" style="font-family: Poppins">
    <div class="flex flex-col gap-4">
        @include('layout.navbar')
        <main class=" flex flex-col gap-4 justify-items-center>" >
            @yield('body')
        </main>
    </div>
    @include('layout.footer')
</body>
</html>