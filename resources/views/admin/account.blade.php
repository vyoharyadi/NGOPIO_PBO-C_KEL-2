<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Account
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
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
                <a class="block px-4 py-2 rounded bg-amber-700" href="/admin/menu">
                    Menu
                </a>
                <a class="block px-4 py-2 rounded bg-amber-500" href="/admin/account">
                    Account
                </a>
            </nav>
        </div>
        <div class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold">
                    Account
                </h1>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <a class="text-black" href="/">
                            Log-out
                        </a>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="w-full border border-collapse border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left border-b border-gray-200">#</th>
                            <th class="p-3 text-left border-b border-gray-200">Name</th>
                            <th class="p-3 text-left border-b border-gray-200">Phone</th>
                            <th class="p-3 text-left border-b border-gray-200">Email</th>
                            <th class="p-3 text-left border-b border-gray-200">Role</th>
                            <th class="p-3 text-left border-b border-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-3 border-b">{{ $loop->iteration }}</td>
                                <td class="p-3 border-b">{{ $user->name }}</td>
                                <td class="p-3 border-b">{{ $user->phone }}</td>
                                <td class="p-3 border-b">{{ $user->email }}</td>
                                <td class="p-3 border-b">{{ $user->role }}</td>
                                <td class="p-3 border-b">
                                    <button
                                        onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->phone }}', '{{ $user->email }}', '{{ $user->role }}')"
                                        class="px-3 py-1 mr-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                        Edit
                                    </button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="editModal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                <div class="w-1/3 p-6 bg-white rounded shadow-lg">
                    <h2 class="mb-4 text-xl font-bold">Edit User</h2>
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block font-medium" for="editName">Name</label>
                            <input id="editName" name="name" type="text" class="w-full p-2 border rounded"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium" for="editPhone">Phone</label>
                            <input id="editPhone" name="phone" type="text" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium" for="editEmail">Email</label>
                            <input id="editEmail" name="email" type="email" class="w-full p-2 border rounded"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium" for="editRole">Role</label>
                            <select id="editRole" name="role" class="w-full p-2 border rounded">
                                <option value="admin">Admin</option>
                                <option value="cashier">Cashier</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full p-2 text-white bg-blue-500 rounded hover:bg-blue-600">Save
                            Changes</button>
                    </form>
                    <button onclick="closeEditModal()"
                        class="w-full p-2 mt-2 text-white bg-gray-500 rounded hover:bg-gray-600">Cancel</button>
                </div>
            </div>

            <script>
                function openEditModal(id, name, phone, email, role) {
                    document.getElementById('editModal').style.display = 'flex';
                    document.getElementById('editName').value = name;
                    document.getElementById('editPhone').value = phone;
                    document.getElementById('editEmail').value = email;
                    document.getElementById('editRole').value = role;
                    document.getElementById('editForm').action = `/users/${id}`;
                }

                function closeEditModal() {
                    document.getElementById('editModal').style.display = 'none';
                }
            </script>
        </div>
    </div>
</body>

</html>
