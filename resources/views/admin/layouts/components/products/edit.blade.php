<x-admin-app-layout>
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Product Specifications') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Form Container -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                
                <!-- System Header -->
                <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Modification Interface: Record #001</h3>
                    <a href="{{ route('admin.products.index') }}" class="text-[10px] font-black text-gray-500 uppercase hover:text-red-600 transition">Discard Changes</a>
                </div>

                <form id="editProductForm" method="POST" class="p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        
                        <!-- Left Column: Visual Assets -->
                        <div class="md:col-span-1 space-y-6">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Current Product Media</label>
                                <div class="border border-gray-300 rounded bg-gray-50 p-2">
                                    <!-- Placeholder for Image -->
                                    <div class="h-48 w-full bg-gray-200 rounded border border-gray-300 flex items-center justify-center">
                                        <span class="text-[10px] font-black text-gray-500 uppercase">Image Preview</span>
                                    </div>
                                    <div class="mt-3">
                                        <label class="block w-full px-3 py-2 bg-gray-800 text-white text-[10px] font-black uppercase rounded cursor-pointer hover:bg-black transition text-center">
                                            Replace File
                                            <input type="file" class="hidden" name="image">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 border border-gray-200 rounded">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Barcode Reference</p>
                                <div class="h-10 bg-white border border-gray-300 flex items-center justify-center font-mono text-xs tracking-tighter">
                                    |||| | || ||| | ||| ||
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: System Data -->
                        <div class="md:col-span-2 space-y-5">
                            
                            <!-- Product Name -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Product Designation Name</label>
                                <input type="text" value="HIGH-END GAMING LAPTOP V2" class="w-full px-4 py-2 border border-gray-300 rounded text-xs font-bold uppercase focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="name" required>
                            </div>

                            <!-- Barcode ID -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Barcode Identification (EAN/UPC)</label>
                                <input type="text" value="4801122334455" class="w-full px-4 py-2 border border-gray-300 rounded text-xs font-mono font-bold focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none bg-gray-50" name="barcode" required>
                            </div>

                            <!-- Price Configuration -->
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Base Retail Price (PHP)</label>
                                    <input type="number" step="0.01" value="75000.00" class="w-full px-4 py-2 border border-gray-300 rounded text-xs font-black focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="price" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Discounted Value (PHP)</label>
                                    <input type="number" step="0.01" value="69999.00" class="w-full px-4 py-2 border border-gray-300 rounded text-xs font-black focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none text-red-600" name="discounted_price">
                                </div>
                            </div>

                            <!-- System Status -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Inventory Visibility Status</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded text-xs font-bold uppercase outline-none focus:ring-1 focus:ring-red-500">
                                    <option selected>ACTIVE / DISPLAYED</option>
                                    <option>HIDDEN / OUT OF STOCK</option>
                                    <option>ARCHIVED / RECALLED</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="pt-8 flex gap-3 border-t border-gray-100 justify-end">
                        <a href="{{ route('admin.products.index') }}" class="px-8 py-2 bg-gray-200 text-gray-700 font-bold uppercase text-[10px] rounded hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="button" onclick="submitEditForm()" class="px-8 py-2 bg-blue-700 text-white font-bold uppercase text-[10px] rounded hover:bg-blue-800 transition shadow">
                            Commit Specification Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Scripts -->
            <script>
                function submitEditForm() {
                    const form = document.getElementById('editProductForm');
                    if (form.checkValidity()) {
                        Swal.fire({
                            title: 'SYNCHRONIZING DATA...',
                            text: 'System is updating master inventory records.',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading(); },
                            timer: 1200
                        }).then(() => {
                            Swal.fire({
                                title: 'RECORD UPDATED',
                                text: 'The product specifications have been successfully committed.',
                                icon: 'success',
                                confirmButtonColor: '#1d4ed8'
                            });
                        });
                    } else {
                        form.reportValidity();
                    }
                }
            </script>
        </div>
    </div>
</x-admin-app-layout>