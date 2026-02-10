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
                                <option>Delete Selected</option>
                                <option>Update Price</option>
                            </select>
                            <button class="text-xs font-black text-red-600 uppercase border border-red-600 px-3 py-1 rounded hover:bg-red-600 hover:text-white transition" onclick="showActionAlert('Bulk Action', 'Processing bulk update...')">Apply</button>
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
                                <!-- Static Row Example -->
                                <tr class="hover:bg-gray-50 transition border-b border-gray-100">
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-10 w-14 bg-gray-200 rounded border border-gray-300 flex items-center justify-center text-[10px] text-gray-500 uppercase font-bold">No Img</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900 uppercase">High-End Gaming Laptop V2</div>
                                        <div class="text-[10px] text-gray-400 font-bold">GENSAN-STOCK-001</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-mono font-bold bg-gray-100 px-2 py-1 rounded text-gray-700">4801122334455</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-black text-gray-900">75,000.00</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-red-600">
                                        69,999.00
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <!-- Professional Text Buttons -->
                                        <button class="px-3 py-1 border border-blue-600 text-blue-600 text-[10px] font-black uppercase rounded hover:bg-blue-600 hover:text-white transition mr-2" onclick="showActionAlert('Edit', 'Loading product details for update...')">Edit</button>
                                        <button class="px-3 py-1 border border-red-600 text-red-600 text-[10px] font-black uppercase rounded hover:bg-red-600 hover:text-white transition" onclick="confirmDeletion(1)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Professional Pagination Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                        <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest">
                            Records: <span class="text-gray-900">1 - 50</span> of <span class="text-gray-900">2,450</span>
                        </div>
                        <div class="flex gap-1">
                            <button class="px-3 py-1 border border-gray-300 bg-white rounded text-[10px] font-bold text-gray-400 cursor-not-allowed uppercase">Prev</button>
                            <button class="px-3 py-1 bg-red-600 text-white rounded text-[10px] font-bold uppercase">1</button>
                            <button class="px-3 py-1 bg-white border border-gray-300 rounded text-[10px] font-bold text-gray-700 hover:bg-gray-100 uppercase transition">2</button>
                            <button class="px-3 py-1 bg-white border border-gray-300 rounded text-[10px] font-bold text-gray-700 hover:bg-gray-100 uppercase transition">Next</button>
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

                        <!-- Form Body -->
                        <form id="addProductForm" method="POST" class="p-6 space-y-4">
                            @csrf
                            
                            <!-- I. Image Upload (Professional Placeholder) -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Product Image Attachment</label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col items-center justify-center w-full h-24 border border-dashed border-gray-400 rounded bg-gray-50 hover:bg-gray-100 cursor-pointer transition">
                                        <span class="text-[10px] font-black text-gray-500 uppercase">Select File (JPG/PNG)</span>
                                        <input type="file" class="hidden" name="image" required />
                                    </label>
                                </div>
                            </div>

                            <!-- II. Product Name -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Product Designation / Name</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-bold uppercase focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="name" required>
                            </div>

                            <!-- III. Barcode -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Barcode Identification Number</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-mono font-bold focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="barcode" required>
                            </div>

                            <!-- Price Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- IV. Retail Price -->
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Base Price (PHP)</label>
                                    <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-black focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none" name="price" required>
                                </div>
                                <!-- V. Discounted Price -->
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 tracking-widest">Discounted Price (PHP)</label>
                                    <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded text-xs font-black focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none text-red-600" name="discounted_price">
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

            <!-- Dashboard Scripts -->
            <script>
                // Standard Information Alert
                function showActionAlert(title, text) {
                    Swal.fire({
                        title: title.toUpperCase(),
                        text: text,
                        icon: 'info',
                        confirmButtonColor: '#ef4444',
                        timer: 1500,
                        showConfirmButton: false,
                        customClass: {
                            title: 'text-sm font-black uppercase'
                        }
                    });
                }

                // Standard Deletion Confirmation
                function confirmDeletion(productId) {
                    Swal.fire({
                        title: 'CONFIRM DELETION',
                        text: "This action will remove the record from the database permanently.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#b91c1c',
                        cancelButtonColor: '#4b5563',
                        confirmButtonText: 'DELETE RECORD',
                        cancelButtonText: 'CANCEL'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'DELETED',
                                text: 'The record has been purged.',
                                icon: 'success',
                                confirmButtonColor: '#4b5563'
                            });
                        }
                    });
                }
                
                // Form Submission Logic
                function submitProductForm() {
                    const form = document.getElementById('addProductForm');
                    if (form.checkValidity()) {
                        Swal.fire({
                            title: 'UPDATING DATABASE...',
                            text: 'Please wait while the system processes the request.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            timer: 1200,
                            timerProgressBar: true
                        }).then(() => {
                            Swal.fire({
                                title: 'SUCCESS',
                                text: 'New entry synchronized with master inventory.',
                                icon: 'success',
                                confirmButtonColor: '#b91c1c'
                            }).then(() => {
                                // Accessing Alpine.js component data to close modal
                                const modalData = document.querySelector('[x-data]').__x.$data;
                                modalData.showAddModal = false;
                            });
                        });
                    } else {
                        form.reportValidity();
                    }
                }

                // Checkbox Logic
                document.getElementById('selectAll').addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            </script>
        </div>
    </div>
</x-admin-app-layout>