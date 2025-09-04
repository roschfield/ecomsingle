<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
class HomeController extends Controller
{
    public function Index()
    {
        
        $collections = Collection::with(['products' => function ($query) {
            $query->where('is_active', true)
                ->take(4); 
      
            }])
            ->take(2)
            ->get();

       return view('pages.home', compact('collections'));
    }

    public function Shop()
    {
        $categories= Category::where('is_acive',1)->get();
        $products= Product::where('is_active',1)->get();

        return view('pages.shop',compact('categories','products'));
    }
    public function About()
    {
        return view('pages.about');
    }

    public function Contact()
    {
        return view('pages.contact');
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
