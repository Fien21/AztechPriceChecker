<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display the active product list.
     */
    public function index()
    {
        // Fetch only active products
        $products = Product::where('status', 'active')->latest()->paginate(10);

        return view('admin.layouts.components.products.index', compact('products'));
    }

    /**
     * Display the archived product list.
     */
    public function archived()
    {
        // Fetch only archived products
        $products = Product::where('status', 'archived')->latest()->get();

        return view('admin.layouts.components.products.archived', compact('products'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'barcode'      => 'required|string|unique:products,barcode',
            'price'        => 'required|numeric',
            'discounted'   => 'nullable|numeric',
            'stocks'       => 'required|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Set default status as 'active'
        Product::create($validated + ['status' => 'active']);

        return back()->with('success', 'Product created successfully.');
    }

    /**
     * Display the specific product record (Fixes 404 Error).
     */
    public function show(int $id)
    {
        // Find the product by ID or fail
        $product = Product::findOrFail($id);

        // Return the view located in your components folder
        return view('admin.layouts.components.products.view', compact('product'));
    }

    /**
     * Show the form for editing the specific product.
     */
    public function edit(int $id)
    {
        // Find the product by ID or fail
        $product = Product::findOrFail($id);

        // Return the edit view
        return view('admin.layouts.components.products.edit', compact('product'));
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        // Validate the incoming request
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'barcode'      => 'required|string|unique:products,barcode,' . $id,
            'price'        => 'required|numeric',
            'discounted'   => 'nullable|numeric',
            'stocks'       => 'required|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return back()->with('success', 'Product updated successfully.');
    }

    /**
     * Move a product to archived status and redirect to the Archived Page.
     */
    public function archive(int $id)
    {
        $product = Product::findOrFail($id);

        $product->update(['status' => 'archived']);

        return redirect()->route('admin.products.archived')
                         ->with('success', 'Product moved to archives successfully.');
    }

    /**
     * Permanently delete a product along with its image.
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        // Delete image from storage if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Product permanently removed.');
    }
}