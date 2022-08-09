<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MultiRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Localization;
use App\Models\News;
use App\Models\NewsCategory;
use App\Filters\NewsFilter;
use App\Models\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsFilter $request, NewsCategory $newsCategories)
    {
        $news = News::filter($request)->paginate(12);

        $newsCategories = NewsCategory::all();

        return view('admin.news.index', [
            'news' => $news,
            'newsCategories' => $newsCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(NewsCategory $newsCategory)
    {
        $newsCategory = NewsCategory::all();

        return view('admin.news.create', [
            'newsCategories' => $newsCategory,
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
        $news = new News();
        $news->categories_id = $request->news_category_id;
        $news->save();

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

        $news->localization()->save($localization_title);
        $news->localization()->save($localization_desc);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $news->addMediaFromRequest('image')
            ->toMediaCollection('images');
        }


        return redirect()->route('news.index');
    }

    public function mediaUpdate(ImageRequest $request, News $news)
    {
         if ($request->hasFile('image')) {

            $news->clearMediaCollection('images');
            $news->addMediaFromRequest('image')
            ->toMediaCollection('images');

        }

        return redirect()->route('news.edit', $news->id);
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
    public function edit(News $news)
    {
        $newsCategory = NewsCategory::all();

        return view('admin.news.update', [
            'news' => $news,
            'newsCategories' => $newsCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MultiRequest $request, News $news)
    {
        $localization_title = [
            'var' => "title",
            'uk' => $request->title_uk,
            'ru' => $request->title_ru,
        ];

        $localization_desc = [
            'var' => "description",
            'uk' => $request->description_uk,
            'ru' => $request->description_ru
        ];

        $news->categories_id = $request->news_category_id;
        $news->update();

        $news->localization()->where('var', 'title')->update($localization_title);
        $news->localization()->where('var', 'description')->update($localization_desc);

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index');
    }

    public function delete(News $news)
    {
        $news->forceDelete();

        return redirect()->route('news.index');
    }
}
