<?php

namespace App\Http\Controllers\Admin;

// use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Localization;
use App\Models\SizePrice;
use App\Filters\ProductFilter;
use App\Http\Requests\MultiRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\LocalizationRequest;
use App\Models\CategoryProduct;
use App\Models\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilter $request)
    {


        $products = Product::filter($request)->paginate(12);


        $productTypes = ProductType::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.product.index', [
            'products' => $products,
            'producttypes' => $productTypes,
            'categories' => $categories,
            'subcategories' => $subCategories,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $productType = ProductType::all();
        $subCategory = SubCategory::all();

        return view('admin.product.create', [
            'categories' => $category,
            'producttypes' => $productType,
            'subcategories' => $subCategory
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(MultiRequest $request)
    {
        $product = new Product();

        $localization_title = new Localization();
        $localization_title->fill($request->validated());
        $localization_title->var = 'title';
        $localization_title->uk = $request->title_uk;
        $localization_title->ru = $request->title_ru;

        $localization_desc = new Localization();
        $localization_desc->fill($request->validated());
        $localization_desc->var = 'description';
        $localization_desc->uk = $request->description_uk;
        $localization_desc->ru = $request->description_ru;



        //seo add
        $localization_title_seo = new Localization();
        $localization_title_seo->fill($request->validated());
        $localization_title_seo->var = 'title_seo';
        $localization_title_seo->uk = $request->title_seo_uk;
        $localization_title_seo->ru = $request->title_seo_ru;

        $localization_og_title_seo = new Localization();
        $localization_og_title_seo->fill($request->validated());
        $localization_og_title_seo->var = 'og_title_seo';
        $localization_og_title_seo->uk = $request->og_title_seo_uk;
        $localization_og_title_seo->ru = $request->og_title_seo_ru;

        $localization_desc_seo = new Localization();
        $localization_desc_seo->fill($request->validated());
        $localization_desc_seo->var = 'desc_seo';
        $localization_desc_seo->uk = $request->desc_seo_uk;
        $localization_desc_seo->ru = $request->desc_seo_ru;

        $localization_og_desc_seo = new Localization();
        $localization_og_desc_seo->fill($request->validated());
        $localization_og_desc_seo->var = 'og_desc_seo';
        $localization_og_desc_seo->uk = $request->og_desc_seo_uk;
        $localization_og_desc_seo->ru = $request->og_desc_seo_ru;

        $localization_key_seo = new Localization();
        $localization_key_seo->fill($request->validated());
        $localization_key_seo->var = 'key_seo';
        $localization_key_seo->uk = $request->keywords_seo_uk;
        $localization_key_seo->ru = $request->keywords_seo_ru;

        $localization_custom_seo = new Localization();
        $localization_custom_seo->fill($request->validated());
        $localization_custom_seo->var = 'custom_seo';
        $localization_custom_seo->uk = $request->custom_seo_uk;
        $localization_custom_seo->ru = $request->custom_seo_ru;
        //seo end



        $product->fill($request->except(['size/', 'price/', 'available/']));
        $product->save();

        for($i = 1; $i <= $request->sizecount; $i++){
            $size_price = new SizePrice();
            $size_price->fill($request->validated());
            $size = 'size/'.$i;
            $price = 'price/'.$i;
            $available = 'available/'.$i;
            $price_units = 'price_units/'.$i;
            $size_price->size = $request->$size;
            $size_price->price = $request->$price;
            $size_price->available = $request->$available;
            $size_price->price_units = $request->$price_units;

            $product->sizePrices()->save($size_price);
        }

        $product->localization()->save($localization_title);
        $product->localization()->save($localization_title_seo);
        $product->localization()->save($localization_og_title_seo);
        $product->localization()->save($localization_desc);
        $product->localization()->save($localization_desc_seo);
        $product->localization()->save($localization_og_desc_seo);
        $product->localization()->save($localization_key_seo);
        $product->localization()->save($localization_custom_seo);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $product->addMediaFromRequest('image')
            ->toMediaCollection('images');
        }

        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $product->addMediaFromRequest('pdf')
            ->toMediaCollection('pdf');
        }




        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.show', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subCategories = SubCategory::all();

        return view('admin.product.update', [
            'product' => $product,
            'subCategories' => $subCategories,
            'selected_subCategories' => $product->$subCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MultiRequest $request, Product $product)
    {
        $localization_title = [
            'var' => 'title',
            'uk' => $request->title_uk,
            'ru' => $request->title_ru
        ];

        $localization_description = [
            'var' => 'description',
            'uk' => $request->description_uk,
            'ru' => $request->description_ru
        ];

        //seo update
        $localization_title_seo = [
            'var' => 'title_seo',
            'uk' => $request->title_seo_uk,
            'ru' => $request->title_seo_ru
        ];
        $localization_desc_seo = [
            'var' => 'desc_seo',
            'uk' => $request->desc_seo_uk,
            'ru' => $request->desc_seo_ru
        ];
        $localization_og_title_seo = [
            'var' => 'og_title_seo',
            'uk' => $request->og_title_seo_uk,
            'ru' => $request->og_title_seo_ru
        ];
        $localization_og_desc_seo = [
            'var' => 'og_desc_seo',
            'uk' => $request->og_desc_seo_uk,
            'ru' => $request->og_desc_seo_ru
        ];
        $localization_key_seo = [
            'var' => 'key_seo',
            'uk' => $request->keywords_seo_uk,
            'ru' => $request->keywords_seo_ru
        ];
        $localization_custom_seo = [
            'var' => 'custom_seo_uk',
            'uk' => $request->custom_seo_uk,
            'ru' => $request->custom_seo_ru
        ];
        //seo end

        $product->fill($request->except(['size.', 'price.', 'available.', 'price_units.']));
        $product->update();


        foreach ($product->sizePrices as $size) {
            $size->delete();
        }
        for($i = 1; $i <= $request->sizecount; $i++){
            $size_price = new SizePrice();
            $size_price->fill($request->validated());
            $size = 'size/'.$i;
            $price = 'price/'.$i;
            $available = 'available/'.$i;
            $price_units = 'price_units/'.$i;
            $size_price->size = $request->$size;
            $size_price->price = $request->$price;
            $size_price->available = $request->$available;
            $size_price->price_units = $request->$price_units;

            $product->sizePrices()->save($size_price);
        }

        $product->localization()->where('var', 'title')->update($localization_title);
        $product->localization()->where('var', 'description')->update($localization_description);

        //seo update
        $product->localization()->where('var', 'title_seo')->update($localization_title_seo);
        $product->localization()->where('var', 'desc_seo')->update($localization_desc_seo);
        $product->localization()->where('var', 'og_title_seo')->update($localization_og_title_seo);
        $product->localization()->where('var', 'og_desc_seo')->update($localization_og_desc_seo);
        $product->localization()->where('var', 'key_seo')->update($localization_key_seo);
        $product->localization()->where('var', 'custom_seo')->update($localization_custom_seo);
        //seo end

        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $product->addMediaFromRequest('pdf')
            ->toMediaCollection('pdf');
        }

        return redirect()->route('product.index');
    }

    public function mediaUpdate(ImageRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {

            $product->clearMediaCollection('images');
            $product->addMediaFromRequest('image')
            ->toMediaCollection('images');

        }

        return redirect()->route('product.edit', $product->id);
    }
    public function mediaUpdatePdf(ImageRequest $request, Product $product)
    {

        if ($request->hasFile('pdf')) {

            $product->clearMediaCollection('pdf');
            $product->addMediaFromRequest('pdf')
            ->toMediaCollection('pdf');

        }

        return redirect()->route('product.edit', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        //
    }

}






