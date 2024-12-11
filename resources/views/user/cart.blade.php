<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery untuk AJAX -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-white">
    <header class="flex items-center justify-between p-4 text-white bg-amber-800">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold">NGOPI</span>
            <div class="flex space-x-1">
                <div class="w-4 h-4 bg-white rounded-full"></div>
                <div class="w-4 h-4 bg-white rounded-full"></div>
                <div class="w-4 h-4 bg-white rounded-full"></div>
            </div>
        </div>
        <nav class="flex mr-4 space-x-4">
            <a class="text-white" href="/user/home">Order</a>
            <a class="text-white" href="/user/cart">Cart</a>
            <a class="text-white" href="/">
                Log-out
            </a>
        </nav>
    </header>
    <main class="min-h-screen p-4">
        <h2 class="mb-4 text-3xl font-bold">Shopping Cart</h2>
        <div class="flex items-center justify-between mb-4">
            <button class="px-4 py-2 border rounded border-amber-800 text-amber-800">
                <a href="/user/home">&lt; Back to Order</a>
            </button>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="font-bold text-left">Product</th>
                    <th class="font-bold">Quantity</th>
                    <th class="font-bold text-right">Price</th>
                    <th class="font-bold text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr class="border-t">
                        <td class="flex items-center py-2 space-x-4">
                            <img class="object-cover w-12 h-12" src="{{ $item->product->image }}"
                                alt="{{ $item->product->name }}" />
                            <span>{{ $item->product->name }}</span>
                        </td>
                        <td class="text-center">
                            <form class="update-cart-form" data-cart-id="{{ $item->id }}"
                                action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                    class="w-16 text-center border rounded quantity-input">
                                <button type="submit" class="px-2 ml-2 border border-gray-300 rounded">Update</button>
                            </form>
                        </td>
                        <td class="text-right">Rp <span
                                class="item-price">{{ $item->product->price * $item->quantity }}</span></td>
                        <td class="text-right">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">×</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex items-center justify-end mt-4 mr-48">
            <span class="mr-16 font-bold">Total:</span>
            <span id="cartTotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="flex justify-end p-4 mt-4 text-white rounded">
            <button id="confirmOrder" class="px-4 py-2 mt-4 text-white rounded bg-amber-800">
                Confirm
            </button>
        </div>
    </main>
    <div class="p-4 text-center text-white bg-amber-800">
        <div class="flex items-center justify-center space-x-2">
            <span class="text-2xl font-bold">NGOPI</span>
            <div class="flex space-x-1">
                <div class="w-4 h-4 bg-white rounded-full"></div>
                <div class="w-4 h-4 bg-white rounded-full"></div>
                <div class="w-4 h-4 bg-white rounded-full"></div>
            </div>
        </div>
        <p class="mt-2">One Cup | One Love</p>
    </div>

    <script>
        $(document).ready(function() {
            $('#confirmOrder').on('click', function() {
                let total = $('#cartTotal').text().replace('Rp', '').replace(/\./g, '').trim();
                let orderData = {
                    _token: "{{ csrf_token() }}",
                    total: parseInt(total), 
                    order_date: new Date().toISOString().slice(0, 10), 
                };

                $.ajax({
                    url: "{{ route('order.store') }}",
                    method: "POST",
                    data: orderData,
                    success: function(response) {
                        alert("Order confirmed successfully!");
                        window.location.href = "/user/checkout"; 
                    },
                    error: function(xhr) {
                        alert("Error confirming order: " + xhr.responseText);
                    }
                });
            });

            $('.quantity-input').on('input', function() {
                let cartId = $(this).closest('form').data('cart-id');
                let quantity = $(this).val();
                let price = $(this).closest('tr').find('.item-price').data('price');
                let newPrice = price * quantity;
                $(this).closest('tr').find('.item-price').text(newPrice);

                let total = 0;
                $('.item-price').each(function() {
                    total += parseInt($(this).text().replace('Rp', '').replace('.', '').trim());
                });

                $('#cartTotal').text('Rp ' + new Intl.NumberFormat('id-ID').format(total));
            });
        });
    </script>
</body>

</html>
