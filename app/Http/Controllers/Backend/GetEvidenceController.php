<?php

namespace App\Http\Controllers\Backend;

use App\Evidence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetEvidenceController extends Controller
{
    public function getevidence(Request $request)
    {
        $id_code_evidence=$request['id_code_evidence'];
        $evidence=Evidence::where('parent_id',$id_code_evidence)->get();
        return response()->json($evidence,200);
    }
}
