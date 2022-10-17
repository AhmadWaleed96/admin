<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\ItemCampaign;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function get_basic_campaigns(Request $request){
        if (!$request->hasHeader('zoneId')) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => translate('messages.zone_id_required')]);
            return response()->json([
                'errors' => $errors
            ], 200);
        }
        $zone_id= $request->header('zoneId');
        try {
            $campaigns = Campaign::
            when(config('module.current_module_data'), function($query)use($zone_id){
                $query->module(config('module.current_module_data')['id']);
                if(!config('module.current_module_data')['all_zone_service']) {
                    $query->whereHas('stores', function($query)use($zone_id){
                        $query->whereIn('zone_id', json_decode($zone_id, true));
                    });
                }
            })
            ->running()->active()->get();
            $campaigns=Helpers::basic_campaign_data_formatting($campaigns, true);
            return response()->json($campaigns, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    public function basic_campaign_details(Request $request){
        if (!$request->hasHeader('zoneId')) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => translate('messages.zone_id_required')]);
            return response()->json([
                'errors' => $errors
            ], 200);
        }
        $zone_id= $request->header('zoneId');

        $validator = Validator::make($request->all(), [
            'basic_campaign_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        try {
            $campaign = Campaign::with(['stores'=>function($q)use($zone_id){
                $q->withOpen();
                if(!config('module.current_module_data')['all_zone_service']) {
                    $q->whereIn('zone_id', json_decode($zone_id, true));
                }
            }])
            ->when(config('module.current_module_data'), function($query){
                $query->module(config('module.current_module_data')['id']);
            })
            ->running()->active()->whereId($request->basic_campaign_id)->first();

            $campaign=Helpers::basic_campaign_data_formatting($campaign, false);

            $campaign['stores'] = Helpers::store_data_formatting($campaign['stores'], true);

            return response()->json($campaign, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    public function get_item_campaigns(Request $request){
        if (!$request->hasHeader('zoneId')) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => translate('messages.zone_id_required')]);
            return response()->json([
                'errors' => $errors
            ], 200);
        }
        $zone_id= $request->header('zoneId');
        try {
            $campaigns = ItemCampaign::active()
            ->when(config('module.current_module_data'), function($query)use($zone_id){
                $query->module(config('module.current_module_data')['id']);
                if(!config('module.current_module_data')['all_zone_service']) {
                    $query->whereHas('store', function($q)use($zone_id){
                        $q->whereIn('zone_id', json_decode($zone_id, true));
                    });
                }
            })
            ->running()->active()->get();
            $campaigns= Helpers::product_data_formatting($campaigns, true, false, app()->getLocale());
            return response()->json($campaigns, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
