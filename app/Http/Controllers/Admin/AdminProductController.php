<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $products = Product::latest()->paginate(50);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View { return view('admin.products.create', ['product' => new Product()]); }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Product::generateUniqueSlug($data['name']);
        $data['is_published'] = $request->boolean('is_published');
        if ($request->hasFile('image')) $data['image'] = $this->uploadImage($request->file('image'), 'products');
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View { return view('admin.products.edit', compact('product')); }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request);
        if ($data['name'] !== $product->name) $data['slug'] = Product::generateUniqueSlug($data['name'], $product->id);
        $data['is_published'] = $request->boolean('is_published');
        if ($request->hasFile('image')) $data['image'] = $this->uploadImage($request->file('image'), 'products', $product->image);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) $this->deleteImage($product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:physical,service,digital'],
            'availability' => ['required', 'in:available,sold_out,preorder'],
            'description' => ['required', 'string', 'max:5000'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'preorder_ends_at' => ['nullable', 'required_if:availability,preorder', 'date'],
            'production_estimate' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }
}
