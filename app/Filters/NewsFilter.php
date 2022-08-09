<?php

namespace App\Filters;
use Illuminate\Support\Facades\DB;

class NewsFilter extends QueryFilter
{

    public function newsCategoryid($id)
    {
        return $this->builder->when($id, function($query) use($id){
            foreach($id as $i){
                $i++;
            }
            $query
            ->leftJoin('news_categories as suub_'.$i.'', 'suub_'.$i.'.id', '=', 'news.categories_id')
            ->select('news.id')
            ->orWhere('categories_id', $id);
        });
    }


}
