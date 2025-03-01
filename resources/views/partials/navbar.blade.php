<nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('dashboard') }}" class="font-bold text-lg">Office Management</a>
        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="ml-4 text-white">Logout</button>
                </form>
            
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>
</nav>
