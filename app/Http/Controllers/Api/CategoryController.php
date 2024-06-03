<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function showcategory()
    {

        $catdata = DB::table('category')->get();

        return response()->json($catdata, 200);

    }

    public function addcategory(Request $req)
    {

        $validation = validator::make($req->all(), [
            "catname" => ['required']]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors(),
            ], 422);
        } else {

            $cateid = DB::table('category')->select('id')->orderBy('id', 'DESC')->limit(1)->get();

            $userexist = DB::table('category')->where('category_name', '=', $req->name)->count();
            if ($userexist >= 1) {
                return response()->json(['message' => 'Category is alredy  existed'], 404);
            } else {
                if (count($cateid) == 0) {
                    $idata = 0;
                } else {
                    foreach ($cateid as $data => $catdata) {
                        $idata = $catdata->id;
                    }
                }

                $user = DB::table('category')->insert([

                    'category_name' => $req->catname,
                    'category_id' => 'Catid' . $idata,

                ]);

                if ($user) {
                    return response()->json(['message' => 'Category is not created successfully'], 200);
                } else {
                    return response()->json(['message' => 'Category is not created'], 404);
                }
            }
        }
    }
    public function categorydelete($id){
        $dlquerry=DB::table('category')->where('id', $id)->delete();

if($dlquerry){
    return response()->json(['message' => 'category deleted successfully'],200);
}else{
    return response()->json(['message' => 'category not found'], 404);
}

    }
}
