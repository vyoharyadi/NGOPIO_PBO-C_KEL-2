<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-center bg-cover"
    style="background-image: url('https://storage.googleapis.com/a1aa/image/MUQqHq6nauqFElUYveKTPl3m0VRkEGYq5lzjDGlU4CnSSu7JA.jpg');">
    <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-lg bg-opacity-70">
        <h1 class="mb-6 text-2xl font-bold text-center">Hello, Welcome!</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="email">Email</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    type="email" id="email" name="email" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium" for="password">Password</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    type="password" id="password" name="password" required>
            </div>
            <button class="w-full py-2 text-white transition duration-200 rounded-lg bg-amber-700 hover:bg-amber-800"
                type="submit">Log In</button>
        </form>

        <p class="mt-6 text-sm text-center">Don't have Account? <a href="/signup" class="font-bold text-amber-700">Sign
                Up</a></p>
    </div>
</body>

</html>
