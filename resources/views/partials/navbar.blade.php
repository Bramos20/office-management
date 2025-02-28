<nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('dashboard') }}" class="font-bold text-lg">Office Management</a>
        <div>
            @auth
                <a href="{{ route('logout') }}" class="ml-4">Logout</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>
</nav>
