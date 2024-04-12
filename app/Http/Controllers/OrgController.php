<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Org;
use App\Http\Requests\OrgCreateRequest;

class OrgController extends Controller
{
    
    public function create_org (OrgCreateRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            
            $existingOrg = Org::where('org_no', $validated['org_no'])->get();

            if ($existingOrg->count() > 0) {
                throw new \Exception("單位編號已存在");
            } else {
                $org = new Org($validated);
                $org->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success'=>false,'message' => $e->getMessage()],400);
        }

        return response()->json(['success'=>true,'message' => $validated],200);
    }
    
}
