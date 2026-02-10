<x-admin-app-layout>
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Inventory Management') }}
        </h2>
    </x-slot>

    <!-- Main Content Area -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alpine.js Container for Modal Logic -->
            <div x-data="{ showAddModal: false }">
                
                <!-- 1. Product Table Container -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    
                    <!-- Header Actions Section -->
                    <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 uppercase tracking-wide">Inventory Master List</h2>
                            <p class="text-xs text-gray-500 uppercase font-semibold mt-1">Gensan Branch Product Database</p>
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            <button class="px-4 py-2 bg-gray-700 text-white text-xs font-bold uppercase rounded border border-gray-800 hover:bg-gray-800 transition" onclick="showActionAlert('Batch Upload', 'Initiating data processing...')">
                                Batch Upload
                            </button>
                            <button class="px-4 py-2 bg-blue-700 text-white text-xs font-bold uppercase rounded border border-blue-800 hover:bg-blue-800 transition" onclick="showActionAlert('Import', 'Opening CSV Import Utility...')">
                                Import CSV
                            </button>
                            <!-- Trigger for Add Modal -->
                            <button @click="showAddModal = true" class="px-4 py-2 bg-red-600 text-white text-xs font-bold uppercase rounded border border-red-700 hover:bg-red-700 transition shadow-md">
                                Add New Product
                            </button>
                        </div>
                    </div>

                    <!-- Filter & Search Bar -->
                    <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <select class="rounded border-gray-300 text-xs font-bold text-gray-600 uppercase focus:ring-red-500 focus:border-red-500 py-1">
                                <option>Bulk Actions (0 selected)</option>
                                <option>Archive Selected</option>
                                <option>Update Price</option>
                            </select>
                            <button class="text-xs font-black text-red-600 uppercase border border-red-600 px-3 py-1 rounded hover:bg-red-600 hover:text-white transition" onclick="showActionAlert('Bulk Action', 'Processing bulk archive...')">Apply</button>
                        </div>
                        
                        <div class="relative w-full md:w-80">
                            <input type="text" placeholder="SEARCH BY NAME OR BARCODE..." class="w-full pl-4 pr-10 py-1.5 border border-gray-300 rounded text-xs font-bold uppercase placeholder-gray-400 focus:ring-red-500 focus:border-red-500">
                        </div>
                    </div>

                    <!-- Main Data Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-200">
                                    <th class="px-6 py-3 w-10 text-center">
                                        <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    </th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Preview</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Product Description</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Barcode ID</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Retail (PHP)</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Discount (PHP)</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest text-right">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition border-b border-gray-100">
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="h-10 w-14 object-cover rounded border border-gray-300">
                                        @else
                                            <div class="h-10 w-14 bg-gray-200 rounded border border-gray-300 flex items-center justify-center text-[10px] text-gray-500 uppercase font-bold">No Img</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900 uppercase">{{ $product->product_name ?? $product->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">SKU: GENSAN-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }} | STOCKS: {{ $product->stocks }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-mono font-bold bg-gray-100 px-2 py-1 rounded text-gray-700">{{ $product->barcode }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-black text-gray-900">{{ number_format($product->price, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-red-600">
                                        {{ number_format($product->discounted ?? $product->discounted_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <!-- Dynamic Route Sync -->
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="inline-block px-3 py-1 border border-gray-600 text-gray-600 text-[10px] font-black uppercase rounded hover:bg-gray-600 hover:text-white transition mr-2">View</a>
                                        
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-block px-3 py-1 border border-blue-600 text-blue-600 text-[10px] font-black uppercase rounded hover:bg-blue-600 hover:text-white transition mr-2">Edit</a>
                                        
                                        <button type="button" class="px-3 py-1 border border-red-600 text-red-600 text-[10px] font-black uppercase rounded hover:bg-red-600 hover:text-white transition" onclick="confirmArchiving({{ $product->id }})">Archive</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-400 font-bold uppercase text-xs tracking-widest">No active products found in the database.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Professional Pagination Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                        <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest">
                            Showing <span class="text-gray-900">{{ $products->firstItem() }}</span> to <span class="text-gray-900">{{ $products->lastItem() }}</span> of <span class="text-gray-900">{{ $products->total() }}</span> records
                        </div>
                        <div class="flex gap-1">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>

                <!-- 2. ADD NEW PRODUCT MODAL (Utilitarian Design) -->
                <div x-show="showAddModal" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/80 p-4" 
                    style="display: none;">
                    
                    <div @click.away="showAddModal = false" class="bg-white w-full max-w-lg rounded shadow-2xl overflow-hidden border border-gray-300">
                        
                        <!-- Modal Header -->
                        <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">System Input: Add Product</h3>
                            <button @click="showAddModal = false" class="text-gray-400 hover:text-red-600 text-xl font-bold">&times;</button>
                        </div>

                        <!-- Form Body synced to admin.products.store -->
                        <form id="addProductForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                            @csrf
                            
                            <!-- I. Image Upload -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Product Image Attachment</label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col items-center justify-center w-full h-24 border border-dashed border-gray-400 rounded bg-gray-50 hover:bg-gray-100 cursor-pointer transition">
                                        <span class="text-[10px] font-black text-gray-500 uppercase">Select File (JPG/PNG)</span>
                                        <input type="file" class="hidden" name="image" required />
                                    </label>
                                </div>
                            </div>

                            <!-- II. Product Name (Synced: product_name) -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Product Designation / Name</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-bold uppercase focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="product_name" required>
                            </div>

                            <!-- III. Barcode & Stocks (Stocks added to sync with Controller) -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Barcode ID</label>
                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-mono font-bold focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="barcode" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Initial Stocks</label>
                                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-bold focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="stocks" required>
                                </div>
                            </div>

                            <!-- Price Grid (Synced: price & discounted) -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- IV. Retail Price -->
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Base Price (PHP)</label>
                                    <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-black focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="price" required>
                                </div>
                                <!-- V. Discounted Price -->
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Discounted Price (PHP)</label>
                                    <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-black focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none text-red-600" name="discounted">
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="pt-6 flex gap-3 border-t border-gray-100">
                                <button type="button" @click="showAddModal = false" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 font-bold uppercase text-[10px] rounded hover:bg-gray-300 transition">
                                    Cancel
                                </button>
                                <button type="button" onclick="submitProductForm()" class="flex-1 px-4 py-2 bg-red-600 text-white font-bold uppercase text-[10px] rounded hover:bg-red-700 transition shadow">
                                    Commit Record
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hidden Archive Form -->
            <form id="archive-form" method="POST" class="hidden">
                @csrf
                @method('PATCH')
            </form>

            <!-- Dashboard Scripts -->
            <script>
                function showActionAlert(title, text) {
                    Swal.fire({
                        title: title.toUpperCase(),
                        text: text,
                        icon: 'info',
                        confirmButtonColor: '#ef4444',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }

                function confirmArchiving(productId) {
                    Swal.fire({
                        title: 'CONFIRM ARCHIVE',
                        text: "This action will move the record to the archive database.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#b91c1c',
                        cancelButtonColor: '#4b5563',
                        confirmButtonText: 'ARCHIVE RECORD',
                        cancelButtonText: 'CANCEL'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('archive-form');
                            form.action = '/admin/products/' + productId + '/archive';
                            form.submit();
                        }
                    });
                }
                
                function submitProductForm() {
                    const form = document.getElementById('addProductForm');
                    if (form.checkValidity()) {
                        Swal.fire({
                            title: 'UPDATING DATABASE...',
                            text: 'Please wait while the system processes the request.',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading(); }
                        });
                        form.submit();
                    } else {
                        form.reportValidity();
                    }
                }

                document.getElementById('selectAll').addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            </script>
        </div>
    </div>
</x-admin-app-layout>