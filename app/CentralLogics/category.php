<?php

namespace App\CentralLogics;

use App\Models\Category;
use App\Models\Item;
use App\Models\Store;

class CategoryLogic
{
    public static function parents()
    {
        return Category::where('position', 0)->get();
    }

    public static function child($parent_id)
    {
        return Category::where(['parent_id' => $parent_id])->get();
    }

    public static function products(int $category_id, $zone_id, int $limit,int $offset, $type)
    {
        $paginator = Item::
        whereHas('category',function($q)use($category_id){
            return $q->whereId($category_id)->orWhere('parent_id', $category_id);
        })
        ->when(config('module.current_module_data'), function($query)use($zone_id){
            $query->module(config('module.current_module_data')['id']);
            if(!config('module.current_module_data')['all_zone_service']) {
                $query->whereHas('store', function($q)use($zone_id){
                    return $q->whereIn('zone_id', json_decode($zone_id, true));
                });
            }
        })
        ->active()->type($type)->latest()->paginate($limit, ['*'], 'page', $offset);

        return [
            'total_size' => $paginator->total(),
            'limit' => $limit,
            'offset' => $offset,
            'products' => $paginator->items()
        ];
    }


    public static function stores(int $category_id, $zone_id, int $limit,int $offset, $type)
    {
        $paginator = Store::
        withOpen()
        ->whereHas('items.category', function($query)use($category_id){
            return $query->whereId($category_id)->orWhere('parent_id', $category_id);
        })
        ->when(config('module.current_module_data'), function($query)use($zone_id){
            $query->module(config('module.current_module_data')['id']);
            if(!config('module.current_module_data')['all_zone_service']) {
                $query->whereIn('zone_id', json_decode($zone_id, true));
            }
        })
        ->active()->type($type)->latest()->paginate($limit, ['*'], 'page', $offset);

        return [
            'total_size' => $paginator->total(),
            'limit' => $limit,
            'offset' => $offset,
            'stores' => $paginator->items()
        ];
    }


    public static function all_products($id, $zone_id)
    {
        $cate_ids=[];
        array_push($cate_ids,(int)$id);
        foreach (CategoryLogic::child($id) as $ch1){
            array_push($cate_ids,$ch1['id']);
            foreach (CategoryLogic::child($ch1['id']) as $ch2){
                array_push($cate_ids,$ch2['id']);
            }
        }
        
        return Item::whereIn('category_id', $cate_ids)
        ->when(config('module.current_module_data'), function($query)use($zone_id){
            $query->module(config('module.current_module_data')['id']);
            if(!config('module.current_module_data')['all_zone_service']) {
                $query->whereIn('zone_id', json_decode($zone_id, true));
            }
        })
        ->get();
    }
}
