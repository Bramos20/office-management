<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Office Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar')

        <main class="container mx-auto mt-6">
            @yield('content')
            @if(auth()->check())
                <div class="p-4">
                    <h2 class="text-lg font-semibold">Notifications</h2>
                    <ul>
                        @foreach(auth()->user()->notifications as $notification)
                            <li class="border-b py-2">
                                {{ $notification->data['message'] }} - 
                                <a href="{{ url('/tasks/' . $notification->data['task_id']) }}" class="text-blue-600">View Task</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
        </main>
    </div>
</body>
</html>
