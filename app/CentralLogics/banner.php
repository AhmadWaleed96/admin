<?php

namespace App\CentralLogics;

use App\Models\Banner;
use App\Models\Item;
use App\Models\Store;
use App\CentralLogics\Helpers;

class BannerLogic
{
    public static function get_banners($zone_id, $featured = false)
    {
        $banners = Banner::active()
        ->when($featured, function($query){
            $query->featured();
        });
        if(config('module.current_module_data')) {
            $banners = $banners->module(config('module.current_module_data')['id'])
            ->when(!config('module.current_module_data')['all_zone_service'], function($query)use($zone_id){
                $query->whereIn('zone_id', json_decode($zone_id, true));
            });
        } else {
            $banners = $banners->whereIn('zone_id', json_decode($zone_id, true));
        }
   
        $banners = $banners->whereHas('module',function($query){
            $query->active();
        })
        ->get();

        $data = [];
        foreach($banners as $banner)
        {
            if($banner->type=='store_wise')
            {
                $store = Store::active()->find($banner->data);
                $data[]=[
                    'id'=>$banner->id,
                    'title'=>$banner->title,
                    'type'=>$banner->type,
                    'image'=>$banner->image,
                    'store'=> $store?Helpers::store_data_formatting($store, false):null,
                    'item'=>null
                ];
            }
            if($banner->type=='item_wise')
            {
                $item = Item::active()->find($banner->data);
                $data[]=[
                    'id'=>$banner->id,
                    'title'=>$banner->title,
                    'type'=>$banner->type,
                    'image'=>$banner->image,
                    'store'=> null,
                    'item'=> $item?Helpers::product_data_formatting($item, false, false, app()->getLocale()):null,
                ];
            }
        }
        return $data;
    }
}
