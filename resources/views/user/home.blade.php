<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        NGOPIO
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="text-gray-900 bg-white">
    <header class="flex items-center justify-between p-4 text-white bg-amber-800">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold">
                NGOPI
            </span>
            <div class="flex space-x-1">
                <div class="w-4 h-4 bg-white rounded-full">
                </div>
                <div class="w-4 h-4 bg-white rounded-full">
                </div>
                <div class="w-4 h-4 bg-white rounded-full">
                </div>
            </div>
        </div>
        <nav class="flex mr-4 space-x-4">
            <a class="text-white" href="/user/home">
                Order
            </a>
            <a class="text-white" href="/user/cart">
                Cart
            </a>
            <a class="text-white" href="/">
                Log-out
            </a>
        </nav>
    </header>

    <main class="p-4 space-y-8">
        <div class="flex items-center justify-end space-x-2">
            <form method="GET" action="{{ route('product.index') }}">
                <input class="px-4 py-2 pl-10 border rounded-full" placeholder="Search..." type="text" name="search"
                    value="{{ request('search') }}" />
                <i class="absolute text-gray-500 transform -translate-y-1/2 fas fa-search left-3 top-1/2"></i>
            </form>
            <button class="p-2 bg-white border border-gray-300 rounded text-amber-800">
                <a class=""" href="/user/cart">
                    Checkout &gt;
                </a>
            </button>
        </div>

        @foreach ($products as $product)
            <div class="flex flex-col items-center space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                <img class="w-full rounded-lg md:w-1/3" src="{{ $product->image }}" alt="{{ $product->name }}" />
                <div class="flex flex-col space-y-2">
                    <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                    <p>{{ $product->detail }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-semibold">Rp {{ $product->price }}</span>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="p-2 bg-white border border-gray-300 rounded text-amber-800">Add to
                                Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <div class="p-4 text-center text-white bg-amber-800">
        <div class="flex items-center justify-center space-x-2">
            <span class="text-2xl font-bold">
                NGOPI
            </span>
            <div class="flex space-x-1">
                <div class="w-4 h-4 bg-white rounded-full">
                </div>
                <div class="w-4 h-4 bg-white rounded-full">
                </div>
                <div class="w-4 h-4 bg-white rounded-full">
                </div>
            </div>
        </div>
        <p class="mt-2">
            One Cup | One Love
        </p>
    </div>
</body>

</html>
