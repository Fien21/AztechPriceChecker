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
            /* Custom Scrollbar adjusted for white theme */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f1f1; /* Changed from dark blue to light gray */
            }
            ::-webkit-scrollbar-thumb {
                background: #ef4444; /* Keep Admin Red */
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #dc2626;
            }
        </style>
    </head>
    <!-- CHANGED: bg-[#0B3D91] to bg-white and text-white to text-gray-900 -->
    <body class="font-sans antialiased bg-white text-gray-900">
        
        <!-- Flexbox Wrapper to hold Sidebar and Main Content -->
        <div class="flex min-h-screen">

            <!-- 1. Sidebar Component -->
            @include('admin.layouts.sidebar')

            <!-- 2. Main Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                
                <!-- Top Navigation (Ensure your navigation component is also set to a light background) -->
                @include('admin.layouts.navigation')

                <!-- Page Heading (Header Slot) -->
                @if (isset($header))
                    <!-- CHANGED: bg-[#062C6B] to bg-white and border color -->
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content (Slot) -->
                <!-- CHANGED: Main workspace background is now pure white -->
                <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none bg-white">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>

                <!-- Admin Footer -->
                <!-- CHANGED: bg-[#062C6B] to bg-gray-50 and text color -->
                <footer class="bg-gray-50 py-4 text-center text-xs text-gray-500 border-t border-gray-200">
                    &copy; {{ date('Y') }} AZTECH Computer Enterprises Inc. - Price Checker Administration
                </footer>
            </div>
        </div>

        <script>
            window.addEventListener('load', () => {
                console.log('AZTECH Admin Layout Initialized in Light Mode');
            });
        </script>
    </body>
</html>