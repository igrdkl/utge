<?php

namespace App\Filters;
use Illuminate\Support\Facades\DB;

class ProductFilter extends QueryFilter
{

    public function subcategoryid($id)
    {
        return $this->builder->when($id, function($query) use($id){
            foreach($id as $i){
                $i++;
            }
            $query
            ->leftJoin('sub_categories as suub_'.$i.'', 'suub_'.$i.'.id', '=', 'products.sub_category_id')
            ->select('products.id')
            ->orWhere('sub_category_id', $id);
        });
    }

    public function categoryid($id)
    {
        return $this->builder->when($id, function($query) use($id){
            foreach($id as $i){
                $i++;
            }
            $query
            ->leftJoin('sub_categories as suuub_'.$i.'','suuub_'.$i.'.id', '=', 'products.sub_category_id')
            ->leftJoin('categories as caat_'.$i.'', 'caat_'.$i.'.id', '=', 'suuub_'.$i.'.category_id')
            ->select('products.id')
            ->orWhere('suuub_'.$i.'.category_id', $id);
        });
    }


    public function producttypeid($id)
    {

        return $this->builder->when($id, function($query) use($id){
            foreach($id as $i){
                $i++;
            }
            $query
            ->leftJoin('sub_categories as sub_'.$i.'', 'sub_'.$i.'.id', '=', 'products.sub_category_id')
            ->leftJoin('categories as cat_'.$i.'', 'cat_'.$i.'.id', '=', 'sub_'.$i.'.category_id')
            ->leftJoin('product_types as prt_'.$i.'', 'prt_'.$i.'.id', '=', 'cat_'.$i.'.product_type_id')
            ->select('products.id')
            ->orWhere('cat_'.$i.'.product_type_id', $id);
        });
    }

    public function searchcategory($id)
    {
        return $this->builder->when($id, function($query) use($id){
            $query
            ->leftJoin('sub_categories','sub_categories.id', '=', 'products.sub_category_id')
            ->leftJoin('categories','categories.id', '=', 'sub_categories.category_id')
            ->select('product.id');
        });
    }

    public function search_field($search_str = '')
    {
        return $this->builder
        ->leftJoin('localizations', 'products.id', '=', 'localizations.localizationable_id')
        ->where('products.id', 'LIKE', '"%'.$search_str.'%"');

    }
}
