<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script>
        function togglePopup(id) {
            const popup = document.getElementById(id);
            popup.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <div class="w-64 min-h-screen p-4 text-white bg-amber-800">
            <div class="flex items-center mb-8 space-x-2">
                <span class="text-2xl font-bold">NGOPI</span>
                <div class="flex space-x-1">
                    <div class="w-4 h-4 bg-white rounded-full"></div>
                    <div class="w-4 h-4 bg-white rounded-full"></div>
                    <div class="w-4 h-4 bg-white rounded-full"></div>
                </div>
            </div>
            <nav class="space-y-4">
                <a class="block px-4 py-2 rounded bg-amber-500" href="/admin/menu">Menu</a>
                <a class="block px-4 py-2 rounded bg-amber-700" href="/admin/account">Account</a>
            </nav>
        </div>

        <div class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold">Menu</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <form method="GET" action="{{ route('menu.index') }}">
                            <input class="px-4 py-2 pl-10 border rounded-full" placeholder="Search..." type="text"
                                name="search" value="{{ request('search') }}" />
                            <i
                                class="absolute text-gray-500 transform -translate-y-1/2 fas fa-search left-3 top-1/2"></i>
                        </form>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a class="text-black" href="/">
                            Log-out
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mb-6">
                <button onclick="togglePopup('addMenuPopup')" class="px-4 py-2 text-white bg-green-500 rounded">
                    Add Menu
                </button>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="p-4 bg-white rounded-lg shadow">
                        <img alt="{{ $product->name }}" class="object-cover w-full h-40 rounded"
                            src="{{ $product->image }}" width="300" height="200" />
                        <div class="mt-4">
                            <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                            <p class="text-lg font-semibold text-gray-800">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">{{ $product->detail }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <button onclick="togglePopup('editMenuPopup{{ $product->id }}')"
                                    class="px-4 py-1 text-white rounded bg-amber-600">Edit</button>
                            </div>
                        </div>
                    </div>
                    <div id="editMenuPopup{{ $product->id }}" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50">
                        <div class="relative max-w-md p-6 mx-auto mt-20 bg-white rounded-lg shadow-lg">
                            <h2 class="text-lg font-bold">Edit Menu</h2>
                            <form method="POST" action="{{ route('menu.update', $product->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mt-4">
                                    <label>Image URL</label>
                                    <input type="text" name="image" value="{{ $product->image }}"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div class="mt-4">
                                    <label>Product Name</label>
                                    <input type="text" name="name" value="{{ $product->name }}"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div class="mt-4">
                                    <label>Price</label>
                                    <input type="number" name="price" value="{{ $product->price }}"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div class="mt-4">
                                    <label>Description</label>
                                    <textarea name="detail" class="w-full p-2 border rounded">{{ $product->detail }}</textarea>
                                </div>
                                <div class="flex justify-end mt-4 space-x-2">
                                    <button type="button" onclick="togglePopup('editMenuPopup{{ $product->id }}')"
                                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                    <button type="submit"
                                        class="px-4 py-2 text-white bg-blue-500 rounded">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="addMenuPopup" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50">
        <div class="relative max-w-md p-6 mx-auto mt-20 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-bold">Add Menu</h2>
            <form method="POST" action="{{ route('menu.store') }}">
                @csrf
                <div class="mt-4">
                    <label>Image URL</label>
                    <input type="text" name="image" class="w-full p-2 border rounded">
                </div>
                <div class="mt-4">
                    <label>Product Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded">
                </div>
                <div class="mt-4">
                    <label>Price</label>
                    <input type="number" name="price" class="w-full p-2 border rounded">
                </div>
                <div class="mt-4">
                    <label>Description</label>
                    <textarea name="detail" class="w-full p-2 border rounded"></textarea>
                </div>
                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" onclick="togglePopup('addMenuPopup')"
                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
