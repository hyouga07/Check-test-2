<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return $this->buildProductList($request, false);
    }

    public function search(Request $request)
    {
        return $this->buildProductList($request, true);
    }

    private function buildProductList(Request $request, bool $isSearch)
    {
        $keyword = $request->input('keyword');
        $sort    = $request->input('sort');
        $query = Product::query();
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        if ($sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'low') {
            $query->orderBy('price', 'asc');
        } else {
            $query->orderBy('id', 'asc');
        }
        $products = $query->paginate(6)->withQueryString();
        return view('index', [
            'products' => $products,
            'keyword'  => $keyword ?? '',
            'sort'     => $sort ?? '',
            'isSearch' => $isSearch,
        ]);
    }

    public function showRegisterForm()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function register(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $path = $request->file('image')->store('products', 'public');
        $product = Product::create([
            'name'        => $validated['name'],
            'price'       => $validated['price'],
            'image'       => $path,
            'description' => $validated['description'],
        ]);
        $product->seasons()->attach($validated['seasons']);
        return redirect('/products');
    }

    public function detail($productId)
    {
        return $this->showUpdateForm($productId);
    }

    public function showUpdateForm($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $selectedSeasons = $product->seasons
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();
        return view('detail', [
            'product'         => $product,
            'selectedSeasons' => $selectedSeasons,
        ]);
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        $validated = $request->validated();
        $product = Product::findOrFail($productId);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }
        $product->name        = $validated['name'];
        $product->price       = $validated['price'];
        $product->description = $validated['description'];
        $product->save();
        $product->seasons()->sync($validated['seasons']);
        return redirect("/products");
    }

    public function delete($productId)
    {
        $product = Product::findOrFail($productId);
        $product->seasons()->detach();
        $product->delete();
        return redirect('/products');
    }
}
