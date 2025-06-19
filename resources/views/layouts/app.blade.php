<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
       const storeUrl = "{{ route('tasks.store') }}";
       toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right", 
            "timeOut": "3000"
        };
       
    </script>
    <script src="{{asset('js/httpService.js')}}"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow mb-4">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('tasks.index') }}" class="text-xl font-bold text-blue-600">Task Manager</a>
            <div class="flex space-x-4">
                <a href="{{ route('tasks.index') }}" class="text-gray-700 hover:text-blue-600">Tasks</a>
                <a href="{{ route('tasks.create') }}" class="text-gray-700 hover:text-blue-600">Create</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
    
    
</body>
</html>
