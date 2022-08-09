<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesCategory;
use App\Models\ServicesType;
use Illuminate\Http\Request;
use App\Models\Localization;
use App\Http\Requests\MultiRequest;

class ServicesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicesTypes = ServicesType::all();
        $servicesCategories = ServicesCategory::all();

        return view('admin.servicesCategory.index', [
            'servicesTypes' => $servicesTypes,
            'servicesCategories' => $servicesCategories,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $servicesTypes = ServicesType::all();

        return view('admin.servicesCategory.create', [
            'servicesTypes' => $servicesTypes,
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
        $localization_title = new Localization();
        $localization_title->fill($request->validated());
        $localization_title->var = 'title';
        $localization_title->uk = $request->title_uk;
        $localization_title->ru = $request->title_ru;


        $servicesCategory = new ServicesCategory();
        $servicesCategory->fill($request->validated());
        $servicesCategory->service_type_id = $request->service_type_id;
        $servicesCategory->save();

        $servicesCategory->localization()->save($localization_title);


        return redirect()->route('servicesCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicesCategory $servicesCategory)
    {
        $servicesTypes = ServicesType::all();

        return view('admin.servicesCategory.update', [
            'servicesTypes' => $servicesTypes,
            'servicesCategory' => $servicesCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MultiRequest $request, ServicesCategory $servicesCategory)
    {
        $localization_title = [
            'var' => "title",
            'uk' => $request->title_uk,
            'ru' => $request->title_ru,
        ];

        $servicesCategory->fill($request->validated());
        $servicesCategory->service_type_id = $request->service_type_id;
        $servicesCategory->update();


        $servicesCategory->localization()->where('var', 'title')->update($localization_title);


        return redirect()->route('servicesCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(ServicesCategory $servicesCategory)
    {
        $servicesCategory->delete();
        return redirect()->route('servicesCategory.index');
    }
}
