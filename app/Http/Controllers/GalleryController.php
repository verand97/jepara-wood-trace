<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('artist');
        
        if ($request->has('method') && in_array($request->input('method'), ['Hand-Carved', 'CNC-Assisted'])) {
            $query->where('production_method', $request->input('method'));
        }

        $products = $query->latest()->paginate(12);

        return view('gallery.index', compact('products'));
    }

    public function showProduct(string $id)
    {
        $product = Product::with('artist')->findOrFail($id);
        return view('gallery.product', compact('product'));
    }

    public function showArtist(string $id)
    {
        $artist = Artist::with('products')->findOrFail($id);
        return view('gallery.artist', compact('artist'));
    }
}
