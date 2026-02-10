<aside x-data="{ 
        openProducts: {{ request()->routeIs('admin.products.*') ? 'true' : 'false' }}, 
        openScanner: {{ request()->routeIs('admin.scanner.*') ? 'true' : 'false' }},
        openStaff: {{ request()->routeIs('admin.staff.*') ? 'true' : 'false' }},
        openReports: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}
    }" 
    class="w-64 bg-[#062C6B] min-h-screen flex flex-col shadow-2xl sticky top-0 border-r border-blue-900 transition-all duration-300">
    
    <!-- Header / Logo Area -->
    <div class="h-20 flex items-center px-6 border-b border-blue-900 bg-[#041d44]">
        <img src="{{ asset('images/astik.jpg') }}" alt="Logo" class="h-10 w-auto rounded-full">
        <span class="ml-3 font-bold text-white text-lg tracking-widest uppercase">Aztech Admin</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-1 custom-scrollbar">
        
        <!-- 📊 Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg' : 'text-blue-100 hover:bg-red-600/20' }}">
            <span class="w-8">📊</span>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- 📦 Products Dropdown -->
        <div class="space-y-1">
            <button @click="openProducts = !openProducts" 
                class="w-full flex items-center justify-between p-3 rounded-lg text-blue-100 hover:bg-red-600/20 transition duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-red-600/10' : '' }}">
                <div class="flex items-center">
                    <span class="w-8">📦</span>
                    <span class="font-medium">Products</span>
                </div>
                <svg :class="openProducts ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openProducts" x-collapse x-cloak class="pl-8 space-y-1">
                <a href="{{ route('admin.products.index') }}" 
                   class="block p-2 text-sm transition {{ request()->routeIs('admin.products.index') ? 'text-red-500 font-bold' : 'text-blue-200 hover:text-red-400' }}">
                   Product List
                </a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Categories</a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Export Products</a>
            </div>
        </div>

        <!-- 🏷️ Scanner Dropdown -->
        <div class="space-y-1">
            <button @click="openScanner = !openScanner" 
                class="w-full flex items-center justify-between p-3 rounded-lg text-blue-100 hover:bg-red-600/20 transition duration-200">
                <div class="flex items-center">
                    <span class="w-8">🏷️</span>
                    <span class="font-medium">Scanner</span>
                </div>
                <svg :class="openScanner ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openScanner" x-collapse x-cloak class="pl-8 space-y-1">
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Scan Product</a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Scan Logs</a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Export Scan Logs</a>
            </div>
        </div>

        <!-- 👷 Staff Dropdown -->
        <div class="space-y-1">
            <button @click="openStaff = !openStaff" 
                class="w-full flex items-center justify-between p-3 rounded-lg text-blue-100 hover:bg-red-600/20 transition duration-200">
                <div class="flex items-center">
                    <span class="w-8">👷</span>
                    <span class="font-medium">Staff</span>
                </div>
                <svg :class="openStaff ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openStaff" x-collapse x-cloak class="pl-8 space-y-1">
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Staff Accounts</a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Export Staff List</a>
            </div>
        </div>

        <!-- 📑 Reports Dropdown -->
        <div class="space-y-1">
            <button @click="openReports = !openReports" 
                class="w-full flex items-center justify-between p-3 rounded-lg text-blue-100 hover:bg-red-600/20 transition duration-200">
                <div class="flex items-center">
                    <span class="w-8">📑</span>
                    <span class="font-medium">Reports</span>
                </div>
                <svg :class="openReports ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openReports" x-collapse x-cloak class="pl-8 space-y-1">
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Daily Scan Report</a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Monthly Summary</a>
                <a href="#" class="block p-2 text-sm text-blue-200 hover:text-red-400 transition">Export Reports</a>
            </div>
        </div>

        <!-- ⚙️ Settings -->
        <div class="pt-4 border-t border-blue-900 mt-4">
            <a href="{{ route('admin.profile.edit') }}" 
               class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.profile.edit') ? 'bg-red-600 text-white shadow-lg' : 'text-blue-100 hover:bg-red-600/20' }}">
                <span class="w-8">⚙️</span>
                <span class="font-medium">Settings</span>
            </a>
        </div>
    </nav>

    <!-- Logout Action -->
    <div class="p-4 bg-[#041d44] border-t border-blue-900">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center p-2 text-sm font-bold text-white bg-red-700 hover:bg-red-600 rounded-lg transition duration-200">
                <span class="mr-2">🚪</span> LOGOUT
            </button>
        </form>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ef4444; border-radius: 10px; }
    [x-cloak] { display: none !important; }
</style>