<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AZTECH ADMIN') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Custom Scrollbar for a more professional look */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #062C6B;
            }
            ::-webkit-scrollbar-thumb {
                background: #ef4444;
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #dc2626;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#0B3D91] text-white">
        
        <!-- Flexbox Wrapper to hold Sidebar and Main Content -->
        <div class="flex min-h-screen">

            <!-- 1. Sidebar Component (Fixed position on large screens) -->
            @include('admin.layouts.sidebar')

            <!-- 2. Main Area (Grows to fill remaining space) -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                
                <!-- Top Navigation (Admin Blue) -->
                @include('admin.layouts.navigation')

                <!-- Page Heading (Header Slot) -->
                @if (isset($header))
                    <header class="bg-[#062C6B] shadow-lg border-b border-blue-900">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content (Slot) -->
                <!-- We set the background here for the main workspace -->
                <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>

                <!-- Optional: Admin Footer -->
                <footer class="bg-[#062C6B] py-4 text-center text-xs text-blue-300 border-t border-blue-900">
                    &copy; {{ date('Y') }} AZTECH Computer Enterprises Inc. - Price Checker Administration
                </footer>
            </div>
        </div>

        <!-- Extra Scripts for Sidebar Toggle functionality if needed -->
        <script>
            // This can be expanded if you want to add a mobile overlay toggle
            window.addEventListener('load', () => {
                console.log('AZTECH Admin Layout Initialized');
            });
        </script>
    </body>
</html>