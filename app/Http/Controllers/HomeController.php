<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function Index(Request $request)
    {
        $search = $request->get('search');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);
        $collections = Collection::with(['products' => function ($query) {
            $query->where('is_active', true)
                ->take(4); 
      
            }])
            ->take(3)
            ->get();

       return view('pages.home', compact('products', 'search','collections'));
    }
    
    

    public function Shop(Request $request)
    {
        $categories = Category::where('is_acive', 1)->get();
        $collections = Collection::all(); // For dropdown filter

        $query = Product::where('is_active', 1);

        //Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        //In stock filter
        if ($request->has('in_stock') && $request->in_stock !== '') {
            if ($request->in_stock == '1') {
                $query->where('stock_quantity', '>', 0);
            } else {
                $query->where('stock_quantity', '<=', 0);
            }
        }

        //Collection filter (featured, on sale, popular)
        if ($request->filled('collection')) {
            $query->whereHas('collection', function ($q) use ($request) {
                $q->where('id', $request->collection)
                ->orWhere('slug', $request->collection);
            });
        }

        //Sorting
        switch ($request->sort) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'high_low':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest(); // default sort
        }

        $products = $query->paginate(12);

        return view('pages.shop', compact('categories', 'collections', 'products'));
   }


    




    public function About()
    {
        return view('pages.about');
    }

    

    public function Category($id)
    {
       $category = Category::with('products')->findOrFail($id);

        return view('category.category', compact('category'));
        
    }

    public function ProductDetails($id)
    {
      
        $product = Product::with('category')->findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
                                   ->where('id', '!=', $product->id)
                                   ->take(4)
                                   ->get();
        return view('products.productdetails',compact('product','relatedProducts'));
        
    }
    public function Collection($id)
    {
       $collection = Collection::with('products')->findOrFail($id);

        return view('collections.collection', compact('collection'));
    
    }

}
