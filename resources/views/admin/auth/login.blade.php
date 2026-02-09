<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin Login - AZTECH</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- TailwindCSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Particles.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>

        <!-- Custom Styling for specific colors -->
        <style>
            body { 
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif; 
                line-height: 1.5;
            }
            .bg-custom-dark-blue {
                background-color: #0B3D91;
            }
            .card-shadow-soft { box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
            
            /* Admin Red Button Style */
            .btn-admin-primary { background-color: #ef4444; color: white; }
            .btn-admin-primary:hover { background-color: #dc2626; }

            /* Mimic input styles for the custom components */
            .input-style {
                border-color: #d1d5db; /* gray-300 */
                border-radius: 0.5rem; /* rounded-lg */
                padding: 0.5rem 1rem;
                width: 100%;
                transition: all 0.15s ease-in-out;
            }
            .input-style:focus {
                outline: none;
                border-color: #3b82f6; /* blue-500 for focus consistency */
                box-shadow: 0 0 0 1px #3b82f6;
            }
        </style>
    </head>
    <body class="h-screen bg-custom-dark-blue relative overflow-hidden font-sans antialiased">
        
        <!-- Particles Background -->
        <div id="tsparticles" class="absolute inset-0 z-0"></div>

        <!-- Top Bar (Kept as requested) -->
        <header class="bg-[#062C6B] shadow-lg h-20 flex items-center px-6 z-10 relative">
            <img src="{{ asset('images/astik.jpg') }}" alt="Logo" class="h-12 w-auto rounded-full mr-3 object-cover">
            <span class="text-xl font-bold text-white">AZTECH Computer Enterprises Inc.</span>
        </header>

        <!-- Main Content Wrapper (Centered Login Card) -->
        <div class="relative flex justify-center items-center flex-1 z-10 h-[calc(100vh-5rem)]">
            
            <!-- Login Card (White) -->
            <div class="w-full sm:max-w-md bg-white p-6 rounded-lg shadow-xl card-shadow-soft">
                
                <!-- Back Button -->
                <a href="/" class="text-gray-500 hover:text-gray-800 transition duration-150 flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Roles
                </a>

                <!-- Logo Banner -->
                <div class="mx-auto mb-6">
                    <img src="{{ asset('images/astikcover.jpg') }}" alt="AZTECH COMPUTER SHOP Logo" 
                         class="w-full h-auto object-contain" 
                         style="max-height: 80px;">
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
                        {{ session('status') }}
                    </div>
                @endif
            
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center mb-6">
                        {{ __('Admin Login') }}
                </h2>
            
                <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                    @csrf
            
                    <!-- Email Address -->
                    <div>
                        {{-- Assuming x-input-label renders a standard label --}}
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email') }}</label>
                        
                        {{-- Applying input style to mimic custom components --}}
                        <input id="email" class="input-style block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        
                        {{-- Assuming x-input-error handles error display --}}
                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Password') }}</label>
            
                        <input id="password" class="input-style block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            
                        @error('password')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
            
                    <div class="flex items-center justify-between mt-6 pt-2">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
            
                        {{-- Primary Button styled RED for Admin --}}
                        <button type="submit" class="btn-admin-primary py-2 px-4 rounded-lg font-semibold transition ms-3">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
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