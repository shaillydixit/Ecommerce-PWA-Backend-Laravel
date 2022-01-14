<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductData;
use Illuminate\Http\Request;

class ProductDataController extends Controller
{
    public function ProductListByRemark(Request $request)
    {
        $remark = $request->remark;
        $productlist = ProductData::where('remark', $remark)->get();
        return $productlist;
    }

    public function ProductListByCategory(Request $request)
    {
        $Category = $request->category;
        $productlist = ProductData::where('category', $Category)->get();
        return $productlist;
    }

    public function ProductListBySubCategory(Request $request)
    {
        $Category = $request->category;
        $SubCategory = $request->subcategory;
        $productlist = ProductData::where('category', $Category)->where('subcategory', $SubCategory)->get();
        return $productlist;
    }

    public function ProductBySearch(Request $request)
    {
        $key = $request->key;
        $productlist = ProductData::where('title', 'LIKE', "%{$key}%")->orWhere('brand', 'LIKE', "%{$key}%")->get();
        return $productlist;
    }

    public function SimilarProduct(Request $request)
    {
        $subcategory = $request->subcategory;
        $productlist = ProductData::where('subcategory', $subcategory)->orderBy('id', 'desc')->limit(6)->get();
        return $productlist;
    }

    public function ProductDetails(Request $request){
        $id = $request->id;
        $productList = ProductData::where('id', $id)->get();

        $item = [
            'productList' => $productList,
        ];
        return $item;
    }

}
