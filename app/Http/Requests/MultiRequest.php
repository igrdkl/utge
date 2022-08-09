<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $request = [];

        if (isset($_REQUEST['title_uk']))
        {
            $request['title_uk'] = 'required|min:2';
        }

        if (isset($_REQUEST['title_ru']))
        {
            $request['title_ru'] = 'required|min:2';
        }

        if (isset($_REQUEST['description_uk']))
        {
            $request['description_uk'] = 'required|min:2';
        }

        if (isset($_REQUEST['description_ru']))
        {
            $request['description_ru'] = 'required|min:2';
        }

        if (isset($_REQUEST['product_type_id']))
        {
            $request['product_type_id'] = 'required';
        }

        if (isset($_REQUEST['service_type_id']))
        {
            $request['service_type_id'] = 'required';
        }

        if (isset($_REQUEST['category_id']))
        {
            $request['category_id'] = 'required';
        }

        if (isset($_REQUEST['news_category_id']))
        {
            $request['news_category_id'] = 'required';
        }

        if (isset($_REQUEST['service_category_id']))
        {
            $request['service_category_id'] = 'required';
        }

        if (isset($_REQUEST['sub_category_id']))
        {
            $request['sub_category_id'] = 'required';
        }

        if (isset($_REQUEST['home_view']))
        {
            $request['home_view'] = 'required';
        }

        if (isset($_REQUEST['route']))
        {
            $request['route'] = 'required';
        }

        if (isset($_REQUEST['image']))
        {
            $request['image'] = 'required|mimes:jpeg,png,jpg,svg';
        }

        if (isset($_REQUEST['sizecount']))
        {
            $count = $_REQUEST['sizecount'];
        }

        if (isset($_REQUEST['counter']))
        {
            $count = $_REQUEST['counter'];
        }

        if (isset($_REQUEST['size/1']))
        {
            for ($i = 1; $i <= $count; $i++) {
                $request['size/'.$i] = 'required';
            }
        }

        if (isset($_REQUEST['price/1']))
        {
            for ($i = 1; $i <= $count; $i++) {
                $request['price/'.$i] = 'required';
            }
        }

        if (isset($_REQUEST['price_units/1']))
        {
            for ($i = 1; $i <= $count; $i++) {
                $request['price_units/'.$i] = 'required';
            }
        }

        if (isset($_REQUEST['available/1']))
        {
            for ($i = 1; $i <= $count; $i++) {
                $request['available/'.$i] = 'required';
            }
        }

        // if (isset($_REQUEST['materials/1']))
        // {
        //     for ($i = 1; $i <= $count; $i++) {
        //         $request['materials/'.$i] = 'required';
        //     }
        // }

        if (isset($_REQUEST['units/1']))
        {
            for ($i = 1; $i <= $count; $i++) {
                $request['units/'.$i] = 'required';
            }
        }

        if (isset($_REQUEST['phone']))
        {
            $request['phone'] = 'required|min:10|max:20';
        }

        if (isset($_REQUEST['title_seo_uk']))
        {
            $request['title_seo_uk'] = 'required';
        }

        if (isset($_REQUEST['title_seo_ru']))
        {
            $request['title_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['og_title_seo_uk']))
        {
            $request['og_title_seo_uk'] = 'required';
        }

        if (isset($_REQUEST['og_title_seo_ru']))
        {
            $request['og_title_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['og_desc_seo_uk']))
        {
            $request['og_desc_seo_uk'] = 'required';
        }

        if (isset($_REQUEST['og_desc_seo_ru']))
        {
            $request['og_desc_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['desc_seo_ru']))
        {
            $request['desc_seo_uk'] = 'required';
        }

        if (isset($_REQUEST['desc_seo_ru']))
        {
            $request['desc_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['keywords_seo_uk']))
        {
            $request['keywords_seo_uk'] = 'required';
        }

        if (isset($_REQUEST['keywords_seo_ru']))
        {
            $request['keywords_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['custom_seo_uk']))
        {
            $request['custom_seo_uk'] = 'required';
        }

        if (isset($_REQUEST['custom_seo_ru']))
        {
            $request['custom_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['custom_seo_ru']))
        {
            $request['custom_seo_ru'] = 'required';
        }

        if (isset($_REQUEST['email']))
        {
            $request['email'] = 'required|regex:#^[a-zA-z-.]+@[a-z]+\.[a-z]{2,3}$#';
        }

        if (isset($_REQUEST['slider_order']))
        {
            $request['slider_order'] = 'required';
        }

        if (isset($_REQUEST['slider_link']))
        {
            $request['slider_link'] = 'required';
        }

        return $request;
    }
}
