<!-- Sidebar Wrapper -->
<aside x-data="{ open: true }" 
       :class="open ? 'w-64' : 'w-20'" 
       class="bg-[#062C6B] min-h-screen transition-all duration-300 shadow-xl hidden md:flex flex-col text-white sticky top-0">
    
    <!-- Sidebar Header (Logo Area) -->
    <div class="p-6 flex items-center border-b border-blue-900 h-20">
        <img src="{{ asset('images/astik.jpg') }}" alt="Logo" class="h-10 w-auto rounded-full">
        <span x-show="open" class="ml-3 font-bold text-lg tracking-wider overflow-hidden whitespace-nowrap">AZTECH ADMIN</span>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard Link -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center p-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 shadow-md' : 'hover:bg-red-600/50' }}">
            <span class="text-xl">📊</span>
            <span x-show="open" class="ml-4 font-medium">Dashboard</span>
        </a>

        <!-- Product Management -->
        <a href="#" 
           class="flex items-center p-3 rounded-lg transition hover:bg-red-600/50">
            <span class="text-xl">📦</span>
            <span x-show="open" class="ml-4 font-medium">Product Master</span>
        </a>

        <!-- Staff Management -->
        <a href="#" 
           class="flex items-center p-3 rounded-lg transition hover:bg-red-600/50">
            <span class="text-xl">👷</span>
            <span x-show="open" class="ml-4 font-medium">Staff Accounts</span>
        </a>

        <!-- Scan History -->
        <a href="#" 
           class="flex items-center p-3 rounded-lg transition hover:bg-red-600/50">
            <span class="text-xl">🏷️</span>
            <span x-show="open" class="ml-4 font-medium">Scan Logs</span>
        </a>

        <div class="pt-4 mt-4 border-t border-blue-900">
            <span x-show="open" class="px-3 text-xs font-semibold text-blue-400 uppercase">Settings</span>
            
            <a href="{{ route('admin.profile.edit') }}" 
               class="flex items-center p-3 mt-2 rounded-lg transition {{ request()->routeIs('admin.profile.edit') ? 'bg-red-600' : 'hover:bg-red-600/50' }}">
                <span class="text-xl">⚙️</span>
                <span x-show="open" class="ml-4 font-medium">Profile</span>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center p-3 mt-2 rounded-lg transition hover:bg-red-800 text-red-300 hover:text-white">
                    <span class="text-xl">🚪</span>
                    <span x-show="open" class="ml-4 font-medium">Log Out</span>
                </button>
            </form>
        </div>
    </nav>
</aside>