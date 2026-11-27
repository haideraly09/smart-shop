<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index(Request $request)
{
    $search = $request->query('search');
    $lowStock = $request->boolean('low_stock');

    $products = Product::with(['category', 'brand', 'supplier'])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        })
        ->when($lowStock, fn ($query) => $query->lowStock())
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.products.index', compact('products', 'search', 'lowStock'));
}

    public function create()
    {
        return view('admin.products.create', $this->formData());
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['cost_price'] ??= 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product add ho gaya.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', array_merge(
            ['product' => $product],
            $this->formData()
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['cost_price'] ??= 0;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product update ho gaya.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product delete ho gaya.');
    }

    // create aur edit dono ke dropdowns ka data ek jagah
    private function formData(): array
    {
        return [
            'categories' => Category::orderBy('name')->get(),
            'brands'     => Brand::orderBy('name')->get(),
            'suppliers'  => Supplier::orderBy('name')->get(),
        ];
    }
}