<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="text-center bg-white shadow-xl rounded-2xl p-10 max-w-md w-full">

        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="w-20 h-20 flex items-center justify-center rounded-full bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 14h.01M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-6xl font-extrabold text-gray-800">404</h1>

        <!-- Message -->
        <h2 class="mt-2 text-2xl font-semibold text-gray-700">
            Page Not Found
        </h2>

        <p class="mt-3 text-gray-500">
            Sorry, the page you are looking for doesn’t exist or has been moved.
        </p>

        <!-- Buttons -->
        <div class="mt-6 flex flex-col gap-3">

            <a href="{{ url('/dashboard') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                Go Home
            </a>

            <button onclick="history.back()"
                class="border border-gray-300 hover:bg-gray-100 text-gray-700 py-2 rounded-lg transition">
                Go Back
            </button>

        </div>

    </div>

</body>

</html>
