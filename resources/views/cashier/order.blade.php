<!-- views/cashier/order.blade.php -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
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
                <a class="block px-4 py-2 rounded bg-amber-700" href="/cashier/menu">Menu</a>
                <a class="block px-4 py-2 rounded bg-amber-500" href="/cashier/order">Order</a>
            </nav>
        </div>
        <div class="w-3/4 p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold">Orders</h1>
                <div class="relative">
                    <input class="px-4 py-2 border rounded-full" placeholder="Search..." type="text" />
                    <i class="absolute text-gray-500 fas fa-search right-3 top-3"></i>
                </div>
                <div class="flex items-center">
                    <a class="text-black" href="/">Log-out</a>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($orders as $order)
                    <div class="p-4 bg-gray-200 rounded-lg shadow">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center w-10 h-10 mr-2 text-white bg-green-700 rounded-full">
                                    {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-bold">{{ $order->user->name }}</div>
                                    <div class="text-sm text-gray-600">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>
                            </div>
                            <div class="px-2 py-1 text-black rounded {{ $order->status == 'pending' ? 'bg-yellow-400' : 'bg-green-400' }}"
                                id="status-{{ $order->id }}">
                                <span class="status-text">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                        <div class="mb-2 text-sm text-gray-600">{{ $order->created_at->format('D, d M Y') }}</div>
                        <div class="mb-2 text-sm text-gray-600">{{ $order->created_at->format('H:i') }}</div>
                        <hr class="mb-2" />
                        <div class="mb-2 text-sm text-gray-600">Products</div>
                        @foreach ($order->orderItems as $item)
                            <div class="flex justify-between mb-2">
                                <div>{{ $item->product_name }}</div>
                                <div>{{ $item->quantity }}</div>
                                <div>Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                        <hr class="mb-2" />
                        <div class="flex justify-between mb-2">
                            <div>Total:</div>
                            <div>Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        </div>
                        @if ($order->status == 'pending')
                            <button id="done-button-{{ $order->id }}"
                                class="px-4 py-2 text-white rounded bg-amber-800"
                                onclick="markAsComplete({{ $order->id }})">
                                Done!
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function markAsComplete(orderId) {
            fetch(`/cashier/order/${orderId}/complete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                    },
                    body: JSON.stringify({
                        status: 'completed'
                    }) // Mengirim status baru
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const statusElement = document.getElementById(`status-${orderId}`);
                        statusElement.classList.remove('bg-yellow-400');
                        statusElement.classList.add('bg-green-400'); 
                        const statusText = statusElement.querySelector('.status-text');
                        statusText.textContent = 'Completed'; 
                        const doneButton = document.getElementById(`done-button-${orderId}`);
                        doneButton.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>
