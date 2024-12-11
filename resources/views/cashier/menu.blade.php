<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Menu
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-white ">
    <div class="flex h-auto">
        <div class="w-64 min-h-screen p-4 text-white bg-amber-800">
            <div class="flex items-center mb-8 space-x-2">
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
            <nav class="space-y-4">
                <a class="block px-4 py-2 rounded bg-amber-500" href="/cashier/menu">
                    Menu
                </a>
                <a class="block px-4 py-2 rounded bg-amber-700" href="/cashier/order">
                    Order
                </a>
            </nav>
        </div>
        <div class="flex-1 p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold">
                    Menus
                </h1>
                <div class="relative">
                    <form method="GET" action="{{ route('cashier.search') }}" class="relative">
                        <input class="w-full px-4 py-2 pl-10 border rounded-full" type="text" name="search"
                            value="{{ request('search') }}" placeholder="Search..." />
                        <i class="absolute text-gray-500 transform -translate-y-1/2 fas fa-search left-3 top-1/2"></i>
                    </form>
                </div>
                <div class="flex items-center">
                    <a class="text-black" href="/">
                        Log-out
                    </a>
                </div>
            </div>
            @if ($products->isEmpty())
                <p class="mt-4 text-center text-gray-500">No products found.</p>
            @else
                <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($products as $product)
                        <div class="p-4 border rounded">
                            <img alt="{{ $product->name }}" class="object-cover w-full h-32 rounded" height="100"
                                src="{{ $product->image }}" width="150" />
                            <div class="mt-2 text-center">
                                <h2 class="font-bold">{{ $product->name }}</h2>
                                <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <form action="{{ route('cashier.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="px-4 py-1 mt-2 text-white rounded bg-amber-600">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="w-1/4 p-4 bg-gray-200">
            @foreach ($cartItems as $item)
                <div class="p-2 mb-4 border rounded">
                    <div class="flex items-center mb-2">
                        <img alt="{{ $item->product->name }}" class="w-12 h-12 rounded" height="50"
                            src="{{ $item->product->image }}" width="50" />
                        <div class="flex-1 ml-2">
                            <h3 class="font-bold">{{ $item->product->name }}</h3>
                            <p>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('cashier.cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    <div class="flex items-center justify-start gap-2">
                        <form action="{{ route('cashier.cart.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}"
                                class="px-2 border border-gray-300 rounded">-</button>
                            <span>{{ $item->quantity }}</span>
                            <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                class="px-2 border border-gray-300 rounded">+</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between mb-4">
                <span>Total :</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <form action="{{ route('cashier.cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2 text-white rounded bg-amber-800">
                    Confirm
                </button>
            </form>
            @if (session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>
