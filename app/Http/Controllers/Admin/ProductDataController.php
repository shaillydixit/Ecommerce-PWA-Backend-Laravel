<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductData;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use App\Models\Subcategory;

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


    // /backend
    public function GetAllProduct()
    {
        $products = ProductData::latest()->paginate(10);
        return view('backend.product.product_all', compact('products'));
    } // End Method


    public function AddProduct()
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        return view('backend.product.product_add', compact('category', 'subcategory'));
    } // End Method


    public function StoreProduct(Request $request)
    {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(711, 960)->save('upload/product/'.$name_gen);
        $save_url = 'upload/product/'.$name_gen;

        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/product/'.$name_gen1);
        $save_url1 = 'upload/product/'.$name_gen1;


        $image2 = $request->file('image_two');
        $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
        Image::make($image2)->resize(711, 960)->save('upload/product/'.$name_gen2);
        $save_url2 = 'upload/product/'.$name_gen2;


        $image3 = $request->file('image_three');
        $name_gen3 = hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/product/'.$name_gen3);
        $save_url3 = 'upload/product/'.$name_gen3;



        $image4 = $request->file('image_four');
        $name_gen4 = hexdec(uniqid()).'.'.$image4->getClientOriginalExtension();
        Image::make($image4)->resize(711, 960)->save('upload/product/'.$name_gen4);
        $save_url4 = 'upload/product/'.$name_gen4;

        ProductData::insert([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,

        ]);
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }


    public function EditProduct($id)
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $product = ProductData::findOrFail($id);
        return view('backend.product.product_edit', compact('category', 'subcategory', 'product'));
    } // End Method

   public function UpdateProduct(Request $request, $id){
      
       if($request->file('image')){
        $oldImage = ProductData::findOrFail($id);
        unlink($oldImage->image);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(711, 960)->save('upload/product/'.$name_gen);
        $save_url = 'upload/product/'.$name_gen;

        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/product/'.$name_gen1);
        $save_url1 = 'upload/product/'.$name_gen1;


        $image2 = $request->file('image_two');
        $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
        Image::make($image2)->resize(711, 960)->save('upload/product/'.$name_gen2);
        $save_url2 = 'upload/product/'.$name_gen2;


        $image3 = $request->file('image_three');
        $name_gen3 = hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/product/'.$name_gen3);
        $save_url3 = 'upload/product/'.$name_gen3;



        $image4 = $request->file('image_four');
        $name_gen4 = hexdec(uniqid()).'.'.$image4->getClientOriginalExtension();
        Image::make($image4)->resize(711, 960)->save('upload/product/'.$name_gen4);
        $save_url4 = 'upload/product/'.$name_gen4;

        ProductData::findOrFail($id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,

        ]);
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
       }else{
        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/product/'.$name_gen1);
        $save_url1 = 'upload/product/'.$name_gen1;


        $image2 = $request->file('image_two');
        $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
        Image::make($image2)->resize(711, 960)->save('upload/product/'.$name_gen2);
        $save_url2 = 'upload/product/'.$name_gen2;


        $image3 = $request->file('image_three');
        $name_gen3 = hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/product/'.$name_gen3);
        $save_url3 = 'upload/product/'.$name_gen3;



        $image4 = $request->file('image_four');
        $name_gen4 = hexdec(uniqid()).'.'.$image4->getClientOriginalExtension();
        Image::make($image4)->resize(711, 960)->save('upload/product/'.$name_gen4);
        $save_url4 = 'upload/product/'.$name_gen4;
        ProductData::findOrFail($id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,

        ]);
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }
   }
   public function DeleteProduct($id){
       $product = ProductData::findOrFail($id);
       unlink($product->image);
       unlink($product->image_one);
       unlink($product->image_two);
       unlink($product->image_three);
       unlink($product->image_four);
        
       ProductData::findOrFail($id)->delete();
       $notification = array(
        'message' => 'Product Deleted Successfully',
        'alert-type' => 'danger'
    );
    return redirect()->back()->with($notification);
   }
}
