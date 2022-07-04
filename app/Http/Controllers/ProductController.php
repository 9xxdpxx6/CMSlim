<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($category_id, $product_alias) {
        $item = Product::where('alias', $product_alias)->first();

        return view('product.show', [
            'item' => $item
        ]);
    }

    public function showCategory(Request $request, $category_alias) {
        $category = Category::where('alias', $category_alias)->first();

        $paginate = 12;
        $products = Product::where('category_id', $category->id)->paginate($paginate);

        if (isset($request->orderBy)) {
            if ($request->orderBy == 'price-low-high') {
                $products = Product::where('category_id', $category->id)->orderBy('price')->paginate($paginate);
            }
            if ($request->orderBy == 'price-high-low') {
                $products = Product::where('category_id',$category->id)->orderBy('price', 'desc')->paginate($paginate);
            }
            if ($request->orderBy == 'name-a-z') {
                $products = Product::where('category_id',$category->id)->orderBy('title')->paginate($paginate);
            }
            if ($request->orderBy == 'name-z-a') {
                $products = Product::where('category_id',$category->id)->orderBy('title', 'desc')->paginate($paginate);
            }
        }

        if ($request->ajax()) {
            // return $request->orderBy;
            return view('ajax.order-by', [
                'products' => $products
            ])->render();
        }

        return view('categories.index', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
