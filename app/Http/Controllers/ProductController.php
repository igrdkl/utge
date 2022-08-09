<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SizePrice;
use App\Models\ProductType;
use App\Models\SubCategory;
use App\Models\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\ProductFilter;
use App\Models\Localization;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilter $request, Category $category)
    {
        $products = Product::filter($request)->paginate(12);

        $productTypes = ProductType::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('site.product.index', [
            'products' => $products,
            'sizeprices' => SizePrice::getSizePrice(),
            'producttypes' => $productTypes,
            'categories' => $categories,
            'subcategories' => $subCategories,
        ]);
    }

    public function show($id, $size)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $localization = Localization::find($id);

        return view('site.product.show', [
            'product' => $product,
            'size' => $size,
            'categories' => $categories,
            'localization' => $localization,
        ]);
    }
}
