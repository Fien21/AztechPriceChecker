<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase tracking-widest">Archived Records</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-900 uppercase">Archive History</h2>
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-800 text-white text-[10px] font-bold uppercase rounded">Back to Active List</a>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-[10px] font-black uppercase text-gray-500">Product Name</th>
                            <th class="px-6 py-3 text-[10px] font-black uppercase text-gray-500">Barcode</th>
                            <th class="px-6 py-3 text-right text-[10px] font-black uppercase text-gray-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 text-sm font-bold uppercase">{{ $product->product_name }}</td>
                            <td class="px-6 py-4 text-xs font-mono">{{ $product->barcode }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white text-[10px] font-black uppercase rounded">Permanent Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-app-layout>