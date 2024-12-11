<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pembayaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Vertikal tengah */
            align-items: center;
            /* Horizontal tengah */
            flex: 1;
            text-align: center;
            /* memastikan teks tetap rata tengah */
        }
    </style>
</head>

<body class="text-center bg-white">
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

    <main class="my-12">
        <h1 class="text-3xl font-bold text-amber-800">
            Pesanan telah terkirim!
        </h1>
        <p class="mt-8 font-bold text-amber-800">
            Silahkan Lakukan Pembayaran di Kasir dan Tunggu Pesanan Anda Datang! <br> Matur Sembah Nuwun!
        </p>
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
</body>

</html>
