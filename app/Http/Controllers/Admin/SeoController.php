<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Seo;
use Illuminate\Routing\RouteUri;
use App\Http\Requests\MultiRequest;
use App\Models\Localization;


class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seos = Seo::all();
        return view('admin.seo.index', [
            'seos' => $seos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MultiRequest $request)
    {

        $seo = new Seo();

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
        $localization_custom_seo->uk = htmlspecialchars($request->custom_seo_uk, ENT_QUOTES);
        $localization_custom_seo->ru = htmlspecialchars($request->custom_seo_uk, ENT_QUOTES);


        $seo->fill($request->validated());
        $seo->save();

        $seo->localization()->save($localization_title_seo);
        $seo->localization()->save($localization_og_title_seo);
        $seo->localization()->save($localization_desc_seo);
        $seo->localization()->save($localization_og_desc_seo);
        $seo->localization()->save($localization_key_seo);
        $seo->localization()->save($localization_custom_seo);

        return redirect()->route('seo.index');
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
    public function edit(Seo $seo)
    {
        return view('admin.seo.update', [
            'seo' => $seo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Seo $seo, MultiRequest $request)
    {
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
            'var' => 'custom_seo',
            'uk' => $request->custom_seo_uk,
            'ru' => $request->custom_seo_ru
        ];

        $seo->fill($request->validated());
        $seo->update();

        $seo->localization()->where('var', 'title_seo')->update($localization_title_seo);
        $seo->localization()->where('var', 'desc_seo')->update($localization_desc_seo);
        $seo->localization()->where('var', 'og_title_seo')->update($localization_og_title_seo);
        $seo->localization()->where('var', 'og_desc_seo')->update($localization_og_desc_seo);
        $seo->localization()->where('var', 'key_seo')->update($localization_key_seo);
        $seo->localization()->where('var', 'custom_seo')->update($localization_custom_seo);


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo)
    {
        //
    }


    public function delete(Seo $seo)
    {
        $seo->forceDelete();
        return redirect()->route('seo.index');
    }
}
