<?php include "../includes/header.php";?>

<div class="flex min-h-screen bg-gray-100">
    <aside class="w-64 bg-[#1A237E] text-white flex-shrink-0">
        <div class="p-6 text-xl font-bold border-b border-blue-800">MaBagnole Admin</div>
        <nav class="p-4 space-y-2">
            <a href="#" class="block p-3 rounded-lg bg-blue-800 font-medium">Dashboard</a>
            <a href="#" class="block p-3 rounded-lg hover:bg-blue-800 transition">Manage Vehicles</a>
            <a href="#" class="block p-3 rounded-lg hover:bg-blue-800 transition">Reservations</a>
            <a href="#" class="block p-3 rounded-lg hover:bg-blue-800 transition">User Reviews</a>
        </nav>
    </aside>

    <main class="flex-1">
        <header class="bg-white h-16 flex items-center justify-between px-8 border-b">
            <h2 class="text-xl font-bold">Overview</h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Admin User</span>
                <div class="h-8 w-8 bg-orange-500 rounded-full"></div>
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-600">
                    <p class="text-xs font-bold text-gray-500 uppercase">Total Revenue</p>
                    <h3 class="text-2xl font-bold mt-1">$42,500</h3>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500">
                    <p class="text-xs font-bold text-gray-500 uppercase">Active Rentals</p>
                    <h3 class="text-2xl font-bold mt-1">18</h3>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                    <p class="text-xs font-bold text-gray-500 uppercase">Total Fleet</p>
                    <h3 class="text-2xl font-bold mt-1">54</h3>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                    <p class="text-xs font-bold text-gray-500 uppercase">New Users</p>
                    <h3 class="text-2xl font-bold mt-1">124</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h3 class="font-bold">Recent Reservations</h3>
                    <button class="text-sm text-blue-600 font-medium">Export CSV</button>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500 font-bold">
                        <tr>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Vehicle</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="text-sm hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">John Doe</td>
                            <td class="px-6 py-4 text-gray-600">Tesla Model 3</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Active</span></td>
                            <td class="px-6 py-4 font-bold">$340.00</td>
                            <td class="px-6 py-4 text-right"><button class="text-gray-400 hover:text-blue-900">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>