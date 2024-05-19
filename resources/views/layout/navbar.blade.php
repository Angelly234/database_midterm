<?php
    $navLinks = [
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Your Wallet', 'url' => '/wallet'],
    ];
?>

<h1 class="m-4 text-center text-2xl font-bold">SKME Exchange</h1>

    <div id="menu-toggle" class="block sm:hidden border border-gray-500 m-2 p-2 w-fit rounded-lg hover:cursor-pointer hover:bg-gray-800">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            strokeWidth="1.5"
            stroke="currentColor"
            class="w-6 h-6"
        >
            <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
            />
      </svg>
    </div>

    <div id="menu" class="grid sm:flex sm:gap-2 text-white sm:h-full duration-700 ease-in-out overflow-hidden sm:opacity-100 sm:visible justify-center">
        @foreach ($navLinks as $link)
            @php
                $isActive = request()->path() === trim($link['url'], '/');
                if ($link['url'] === '/') {
                    $isActive = request()->is('/');
                }
            @endphp
            <a href="{{ $link['url'] }}" class="px-3 py-2 hover:text-amber-300 my-1 rounded-md hover:bg-gray-700 sm:duration-200 {{ $isActive ? 'bg-zinc-700 sm:bg-none text--600 font-bold' : '' }}">
                {{ $link['name'] }}
            </a>
        @endforeach
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#menu-toggle').click(function() {
            $('#menu').toggleClass('hidden');
        });
    });
</script>