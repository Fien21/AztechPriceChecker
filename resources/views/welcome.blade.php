<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AZTECH Multi-Auth Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- TailwindCSS CDN (Replaces original large style block) -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Particles.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>

        <!-- Custom Styling for specific colors and layout details from the image -->
        <style>
            /* Ensure Figtree font is used */
            body { 
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif; 
                line-height: 1.5;
            }

            /* Custom Button and Card Styles based on the screenshot colors */
            .card-shadow-soft { box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
            
            /* Blue Role (Web - now Customer) */
            .btn-blue-primary { background-color: #3b82f6; }
            .btn-blue-primary:hover { background-color: #2563eb; }
            .card-border-blue { border-color: #3b82f6; }

            /* Red Role (Admin) */
            .btn-red-primary { background-color: #ef4444; }
            .btn-red-primary:hover { background-color: #dc2626; }
            .card-border-red { border-color: #ef4444; }

            /* Green Role (Teacher - now Staff) */
            .btn-green-primary { background-color: #22c55e; }
            .btn-green-primary:hover { background-color: #16a34a; }
            .card-border-green { border-color: #22c55e; }
        </style>
    </head>
    <body class="h-screen bg-[#0B3D91] relative overflow-hidden font-sans antialiased">
        
        <!-- Particles Background -->
        <div id="tsparticles" class="absolute inset-0 z-0"></div>

        <!-- Main Wrapper -->
        <div class="relative min-h-screen flex flex-col selection:bg-[#FF2D20] selection:text-white">

            <!-- Top Bar with Logo and Company Name (H-20, Z-10) - KEPT AS REQUESTED -->
            <header class="bg-[#062C6B] shadow-lg h-20 flex items-center px-6 z-10 relative">
                <img src="{{ asset('images/astik.jpg') }}" alt="Logo" class="h-12 w-auto rounded-full mr-3 object-cover">
                <span class="text-xl font-bold text-white">AZTECH Computer Enterprises Inc.</span>
            </header>
            
            <!-- Navigation Container (Centered, replacing main content area) -->
            <div class="flex flex-col items-center justify-center flex-1 z-10 p-6">
                
                <!-- Role Selection Block (White Card) -->
                <div class="bg-white p-12 rounded-xl shadow-2xl w-full max-w-5xl text-center">
                    
                    <h1 class="text-3xl font-extrabold text-[#FF2D20] mb-3">Welcome</h1>

                    <!-- Image Position: astikcover.jpg used as the prominent logo banner -->
                    <div class="mx-auto my-4" style="max-width: 500px; height: 120px;">
                        <img src="{{ asset('images/astikcover.jpg') }}" alt="AZTECH COMPUTER SHOP Logo" 
                             class="w-full h-full object-contain">
                    </div>
                    
                    <!-- SUBTITLE / DESCRIPTION -->
                    <p class="text-xl font-semibold text-gray-800 mb-6">
                        AZTECH GENSAN Product Price Checker with Barcode Scanner
                    </p>
                    <!-- END SUBTITLE -->

                    <p class="text-gray-700 mb-8 text-base">Please select your authentication role below:</p>

                    <!-- Navigation Links Grid -->
                    <!-- We use h-full on the cards and flex-col/justify-between inside to align buttons -->
                    <nav class="grid lg:grid-cols-3 gap-6 items-stretch">
                        
                        <!-- Role 1: Customer Price View (Web Guard) - Blue Styling -->
                        <div class="p-6 bg-white rounded-xl card-shadow-soft border border-gray-300 border-t card-border-blue flex flex-col justify-between h-full" style="border-width: 1px; border-top-width: 4px;">
                            <!-- Description Area (flex-grow pushes button down) -->
                            <div class="mb-6 flex-grow">
                                <h3 class="text-xl font-semibold mb-2 text-blue-700">Customer Price View</h3>
                                <p class="text-sm text-gray-600">View product prices instantly using the integrated barcode scanner.</p>
                            </div>
                            
                            <!-- Button Area -->
                            <div class="mt-auto">
                                @auth('web')
                                    <a href="{{ url('/dashboard') }}" 
                                        class="w-full py-3 px-4 btn-blue-primary text-white font-medium rounded-lg transition duration-300 shadow block">
                                        Go to Checker
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                        class="w-full py-3 px-4 btn-blue-primary text-white font-medium rounded-lg transition duration-300 shadow block">
                                        Customer Log in
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Role 2: Administrators (Admin Guard) - Red Styling -->
                        <div class="p-6 bg-white rounded-xl card-shadow-soft border border-gray-300 border-t card-border-red flex flex-col justify-between h-full" style="border-width: 1px; border-top-width: 4px;">
                            <!-- Description Area (flex-grow pushes button down) -->
                            <div class="mb-6 flex-grow">
                                <h3 class="text-xl font-semibold mb-2 text-red-700">Administrator Panel</h3>
                                <p class="text-sm text-gray-600">Manage product data, pricing tiers, and system configurations (Full Access).</p>
                            </div>
                            
                            <!-- Button Area -->
                            <div class="mt-auto">
                                @auth('admin')
                                    <a href="{{ url('/admin/dashboard') }}" 
                                        class="w-full py-3 px-4 btn-red-primary text-white font-medium rounded-lg transition duration-300 shadow block">
                                        Admin Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('admin.login') }}" 
                                        class="w-full py-3 px-4 btn-red-primary text-white font-medium rounded-lg transition duration-300 shadow block">
                                        Admin Log in
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Role 3: Staff Access (Teacher Guard) - Green Styling -->
                        <div class="p-6 bg-white rounded-xl card-shadow-soft border border-gray-300 border-t card-border-green flex flex-col justify-between h-full" style="border-width: 1px; border-top-width: 4px;">
                            <!-- Description Area (flex-grow pushes button down) -->
                            <div class="mb-6 flex-grow">
                                <h3 class="text-xl font-semibold mb-2 text-green-700">Staff Access Portal</h3>
                                <p class="text-sm text-gray-600">Internal access for inventory management, special pricing, and reports.</p>
                            </div>
                            
                            <!-- Button Area -->
                            <div class="mt-auto">
                                @auth('teacher')
                                    <a href="{{ url('/teacher/dashboard') }}" 
                                        class="w-full py-3 px-4 btn-green-primary text-white font-medium rounded-lg transition duration-300 shadow block">
                                        Staff Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('teacher.login') }}" 
                                        class="w-full py-3 px-4 btn-green-primary text-white font-medium rounded-lg transition duration-300 shadow block">
                                        Staff Log in
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <footer class="py-4 text-center text-sm text-white/70 relative z-10 bg-[#062C6B]/50 mt-auto">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
        
        <!-- Particles Script -->
        <script>
            tsParticles.load("tsparticles", {
                fullScreen: { enable: false },
                particles: {
                    number: { value: 60, density: { enable: true, value_area: 800 } },
                    color: { value: "#ffffff" },
                    shape: { type: "circle" },
                    opacity: { value: 0.5 },
                    size: { value: { min: 1, max: 3 } },
                    move: { enable: true, speed: 2, direction: "none", out_mode: "out" },
                },
                interactivity: {
                    events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: true, mode: "push" } },
                    modes: { repulse: { distance: 100 }, push: { quantity: 4 } }
                },
                retina_detect: true
            });
        </script>

    </body>
</html>