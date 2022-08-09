<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MultiRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Localization;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::all();

        return view('admin.subCategory.index', ['subCategories' => $subCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.subCategory.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MultiRequest $request)
    {
        $localization_title = new Localization();
        $localization_title->fill($request->validated());
        $localization_title->var = 'title';
        $localization_title->uk = $request->title_uk;
        $localization_title->ru = $request->title_ru;


        $subCategory = new SubCategory();

        $subCategory->fill($request->validated());
        $subCategory->category_id = $request->category_id;
        $subCategory->save();
        
        if (isset($request->sub_description_uk) || isset($request->sub_description_ru)) 
        {
            $localization_desc = new Localization();
            $localization_desc->fill($request->validated());
            $localization_desc->var = 'description';

            if ($request->sub_description_uk != null && $request->sub_description_ru != null) 
            {
                $localization_desc->uk = $request->sub_description_uk;
                $localization_desc->ru = $request->sub_description_ru;
            }

            if ($request->sub_description_uk != null && $request->sub_description_ru == null) 
            {
                $localization_desc->uk = $request->sub_description_uk;
                $localization_desc->ru = 'utge undefined description';
            }
            
            if ($request->sub_description_uk == null && $request->sub_description_ru != null) 
            {
                $localization_desc->uk = 'utge undefined description';
                $localization_desc->ru = $request->sub_description_ru;
            }

            if ($request->sub_description_uk == null && $request->sub_description_ru == null) 
            {
                $localization_desc->uk = 'utge undefined description';
                $localization_desc->ru = 'utge undefined description';
            }

            $subCategory->localization()->save($localization_desc);
        }

        $subCategory->localization()->save($localization_title);

        return redirect()->route('subCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        return view('admin.subCategory.show', [
            // 'category' => $category,
            // 'products' => $category->products,
            'subCategory' => $subCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();

        return view('admin.subCategory.update', [
            'categories' => $categories,
            'subCategory' => $subCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MultiRequest $request, SubCategory $subCategory)
    {

        $localization_title = [
            'var' => 'title',
            'uk' => $request->title_uk,
            'ru' => $request->title_ru
        ];


        $subCategory->update($request->validated());
        
        if (isset($request->sub_description_uk) || isset($request->sub_description_ru)) 
        {
            $localization_desc = [
                'var' => "description",
            ];

            if ($request->sub_description_uk != null && $request->sub_description_ru != null) 
            {
                $localization_desc['uk'] = $request->sub_description_uk;
                $localization_desc['ru'] = $request->sub_description_ru;
            }

            if ($request->sub_description_uk != null && $request->sub_description_ru == null) 
            {
                $localization_desc['uk'] = $request->sub_description_uk;
                $localization_desc['ru'] = 'utge undefined description';
            }
            
            if ($request->sub_description_uk == null && $request->sub_description_ru != null) 
            {
                $localization_desc['uk'] = 'utge undefined description';
                $localization_desc['ru'] = $request->sub_description_ru;
            }

            if ($request->sub_description_uk == null && $request->sub_description_ru == null) 
            {
                $localization_desc['uk'] = 'utge undefined description';
                $localization_desc['ru'] = 'utge undefined description';
            }

            $subCategory->localization()->where('var', 'description')->update($localization_desc);
        }
        $subCategory->localization()->where('var', 'title')->update($localization_title);


        $subCategory->localization()->update($localization_title);

        return redirect()->route('subCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {

    }
    public function delete(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subCategory.index');
    }
}
