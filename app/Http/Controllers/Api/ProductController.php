<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    //

    public function showproduct()
    {
        $productvalue = DB::table('producttable')->select()->get();

        return response()->json([$productvalue], 200);

    }

    public function productdelete($id)
    {

        $dlquerry = DB::table('producttable')->where('id', $id)->delete();

        if ($dlquerry) {
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }

    }

    public function productedit($id)
    {
        // return response()->json("ok data",200);

        $data = DB::table('producttable')->where('id', $id)->get();

        if ($data) {
            return response()->json([$data], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }

    }

    public function addproducts(Request $req)
    {
        // return response()->json(['message' => 'Category is not created successfully'], 200);
        $validation = Validator::make($req->all(), [
            "productname" => ['required'],
            "quntity" => ['required', 'integer'],
            "Description" => ['required'],
            "categoryid" => ['required'],
            "price" => ['required','numeric'],

        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors(),
            ], 422);
        } else {

            $Product_id = "";
         

            $userexist = DB::table('producttable')->select('id')->orderBy('id', 'Desc')->limit(1)->get();

            foreach ($userexist as $pid => $pvalue) {
                if (empty($pvalue->id)) {
                    $Product_id = 'product0';
                } else {
                    $Product_id = 'product' . $pvalue->id;

                }

            }

       

            $user = DB::table('producttable')->insert([
                'Productname' => $req->productname,
                'product_id' => $Product_id,
                'category_id' => $req->categoryid,
                'price'=>$req->price,
                'quntity' => $req->quntity,            
                'Description' => $req->Description,

            ]);

            if ($user) {
                return response()->json(['message' => 'product is added  successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to product '], 400);
            }
        }
    }

    public function update(Request $req)
    {
       

      

        $validation = Validator::make($req->all(), [
            "productname" => ['required'],
            "quntity" => ['required', 'integer'],
            "Description" => ['required'],
            "categoryid" => ['required'],
            "price" => ['required','numeric'],

        ]);


        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors(),
            ], 422);
        } else {
            $id = $req->id;

        $user = DB::table('producttable')->where('id', $id)->update([
            'Productname' => $req->productname,
            'price'=>$req->price,
            'category_id' => $req->categoryid,
            'quntity' => $req->quntity,
            'Description' => $req->Description,
        ]);
        if ($user) {
            return response()->json(['message' => 'product is edit  successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to product edit '], 400);
        }
    }
}
}
