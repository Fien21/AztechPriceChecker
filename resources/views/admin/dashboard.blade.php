<x-admin-app-layout>
    <!-- Include SweetAlert2 and Chart.js CDNs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <!-- Changed text to gray-800 for visibility on white -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Command Center - Price Checker System') }}
        </h2>
    </x-slot>

    <!-- Main Background changed to White -->
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Quick Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Products Managed -->
                <!-- Added shadow-xl and border-gray-100 -->
                <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-100 border-l-8 border-red-600">
                    <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Inventory Items</div>
                    <div class="text-3xl font-bold text-gray-800">2,450</div>
                    <div class="text-xs text-green-600 font-semibold mt-2">↑ 12 New items added today</div>
                </div>
                
                <!-- Daily Price Scans -->
                <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-100 border-l-8 border-blue-600">
                    <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Scans (Today)</div>
                    <div class="text-3xl font-bold text-gray-800">1,104</div>
                    <div class="text-xs text-blue-600 font-semibold mt-2">Live price previewing active</div>
                </div>

                <!-- System Health -->
                <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-100 border-l-8 border-green-500">
                    <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Scanner Server</div>
                    <div class="text-3xl font-bold text-green-600">ONLINE</div>
                    <div class="text-xs text-gray-400 font-semibold mt-2">Latency: 14ms</div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Chart Area -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-xl border border-gray-100 border-t-4 border-red-600">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Weekly Scan Volume</h3>
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-500 font-bold">LIVE DATA</span>
                    </div>
                    <canvas id="scanChart" height="180"></canvas>
                </div>

                <!-- Master Controls -->
                <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-100 border-t-4 border-red-600">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Master Controls</h3>
                    <div class="space-y-3">
                        <button onclick="navigateAction('Inventory', 'Opening Product Price Master...')" class="w-full text-left p-3 rounded-lg bg-gray-50 hover:bg-red-50 border border-gray-200 shadow-sm transition group flex items-center">
                            <span class="mr-3">📦</span>
                            <span class="font-semibold text-gray-700 group-hover:text-red-700">Update Product Prices</span>
                        </button>

                        <button onclick="navigateAction('Barcodes', 'Accessing Barcode Generator...')" class="w-full text-left p-3 rounded-lg bg-gray-50 hover:bg-red-50 border border-gray-200 shadow-sm transition group flex items-center">
                            <span class="mr-3">🏷️</span>
                            <span class="font-semibold text-gray-700 group-hover:text-red-700">Generate Barcode Labels</span>
                        </button>

                        <button onclick="navigateAction('Staff', 'Loading Staff Directory...')" class="w-full text-left p-3 rounded-lg bg-gray-50 hover:bg-red-50 border border-gray-200 shadow-sm transition group flex items-center">
                            <span class="mr-3">👷</span>
                            <span class="font-semibold text-gray-700 group-hover:text-red-700">Manage Staff Accounts</span>
                        </button>

                        <button onclick="navigateAction('Logs', 'Fetching system logs...')" class="w-full text-left p-3 rounded-lg bg-gray-50 hover:bg-red-50 border border-gray-200 shadow-sm transition group flex items-center">
                            <span class="mr-3">📋</span>
                            <span class="font-semibold text-gray-700 group-hover:text-red-700">Scan Activity History</span>
                        </button>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-widest">Database Tools</h4>
                        <button id="syncBtn" class="w-full bg-red-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-red-700 transition shadow-lg">
                            Force Price Sync
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Scripts -->
    <script>
        const ctx = document.getElementById('scanChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Guest Scans',
                    data: [850, 920, 1100, 1050, 1300, 1850, 1104],
                    borderColor: '#ef4444', 
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#ef4444'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });

        function navigateAction(title, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: 'info',
                confirmButtonColor: '#ef4444',
                timer: 1500,
                showConfirmButton: false
            });
        }

        document.getElementById('syncBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Sync Price Database?',
                text: "Update terminal prices.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Sync'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Success!', text: 'Terminals updated.', icon: 'success', confirmButtonColor: '#ef4444' });
                }
            })
        });
    </script>
</x-admin-app-layout>