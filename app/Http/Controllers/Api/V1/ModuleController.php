<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;


class ModuleController extends Controller
{

    public function index(Request $request)
    {
        $modules = Module::active()->get();
        $modules = array_map(function($item){
            if(count($item['translations'])>0)
            {
                foreach($item['translations'] as $translation){
                    if($translation['key']=='module_name')
                    {
                        $item['module_name'] = $translation['value'];
                    }

                    if($translation['key']=='description')
                    {
                        $item['description'] = $translation['value'];
                    }                   
                }

            }
            return $item;
        },$modules->toArray());
        return response()->json($modules);
    }

}
