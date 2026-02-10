<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Specification Sheet') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main View Container -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                
                <!-- System Header -->
                <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Master Data Sheet: GENSAN-001</h3>
                    <div class="flex gap-2">
                        <button onclick="window.print()" class="px-3 py-1.5 bg-white border border-gray-300 text-[10px] font-black uppercase rounded hover:bg-gray-50 transition">Print Record</button>
                        <a href="{{ route('admin.products.index') }}" class="px-3 py-1.5 bg-gray-800 text-white text-[10px] font-black uppercase rounded hover:bg-black transition">Exit View</a>
                    </div>
                </div>

                <div class="p-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        
                        <!-- Product Visual & Barcode -->
                        <div class="md:col-span-1 space-y-6">
                            <div class="aspect-square bg-gray-100 border border-gray-200 rounded flex flex-col items-center justify-center shadow-inner">
                                <span class="text-[10px] font-black text-gray-300 uppercase mb-2">Primary Visual</span>
                                <div class="text-gray-200 text-4xl font-black">IMAGE</div>
                            </div>
                            
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded text-center">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Barcode Scan Area</p>
                                <div class="h-16 bg-white border border-gray-300 flex items-center justify-center font-mono text-xl tracking-widest overflow-hidden">
                                    |||| | || ||| | ||| ||
                                </div>
                                <p class="mt-2 font-mono text-xs font-black text-gray-900 tracking-widest">4801122334455</p>
                            </div>
                        </div>

                        <!-- Product Attributes -->
                        <div class="md:col-span-2 space-y-8">
                            
                            <!-- Name Header -->
                            <div class="border-b border-gray-200 pb-6">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Registered Designation</label>
                                <h1 class="text-3xl font-black text-gray-900 uppercase leading-none">High-End Gaming Laptop V2</h1>
                            </div>

                            <!-- Pricing Matrix -->
                            <div class="grid grid-cols-2 gap-8">
                                <div class="p-4 bg-gray-50 rounded border border-gray-100">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Retail MSRP</label>
                                    <p class="text-2xl font-black text-gray-900">PHP 75,000.00</p>
                                </div>
                                <div class="p-4 bg-red-50 rounded border border-red-100">
                                    <label class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-1 block">Active Promo</label>
                                    <p class="text-2xl font-black text-red-600">PHP 69,999.00</p>
                                </div>
                            </div>

                            <!-- System Metadata Grid -->
                            <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">System SKU</label>
                                    <p class="text-xs font-bold text-gray-700 uppercase">AZT-GENSAN-SKU-992</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Current Status</label>
                                    <p class="text-xs font-bold text-green-700 uppercase">Available for Scanner Preview</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Last Database Sync</label>
                                    <p class="text-[10px] font-bold text-gray-500 uppercase">OCT 25, 2023 - 02:30 PM</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Authorization Level</label>
                                    <p class="text-[10px] font-bold text-gray-500 uppercase">Admin - Full Access</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Operation Bar -->
                <div class="p-4 border-t border-gray-200 bg-gray-50 flex justify-end">
                    <a href="{{ route('admin.products.edit', 1) }}" class="px-10 py-2 bg-blue-700 text-white text-[10px] font-black uppercase rounded hover:bg-blue-800 transition shadow">
                        Enter Modification Mode
                    </a>
                </div>
            </div>
            
            <div class="mt-6 text-center">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em]">AZTECH Computer Enterprises Inc. Confidential System Document</p>
            </div>
        </div>
    </div>
</x-admin-app-layout>