<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Http\Services\Shop\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::all();
        return view('pages.product.index', [
            'title' => 'Products',
            'products' => $products
        ]);
    }

    public function create() {
        $categories = Category::all();
        return view('pages.product.create', [
            'title' => 'New product',
            'categories' => $categories
        ]);
    }

    public function store(ProductFormRequest $request) {
        if ($this->productService->create($request)) {
            return redirect()->back();
        }
            
        Session::flash('error', 'Vui lòng nhập đủ thông tin Product');
        return redirect()->back()->withInput();
        
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();
        $images = ProductImage::where('product_id', '=', $id)->get();

        return view('pages.product.edit', [
            'title' => 'Edit product',
            'product' => $product,
            'images' => $images,
            'categories' => $categories
        ]);
    }

    public function update($id, Request $request) {

        if ($this->productService->update($id, $request)) {
            Session::flash('success', 'Cập nhật thông tin Product thành công');
            return redirect()->back();
        }
            
        // Session::flash('error', 'Cập nhật thất bại');
        return redirect()->back()->withInput();
    }

    public function destroy($id) {

        return $this->productService->delete($id);

    }

    public function deleteImage($id) {

        $image = ProductImage::find($id);

        if ($image->image != '/public/assets/imgProduct/product.jpg') {
                
            $s = $image->image;

            $s = substr($s, 8);
            
            File::delete(public_path($s));                    

        }

        $image->delete();

    }

    public function deleteImage($id) {
        ProductImage::find($id)->delete();
    }

    //  TEST
    public function test() {
        
        return view('test');

    }

    public function testStore(Request $request) {
            
            $s = '/public/assets/avaAccount/1.jpg';

            $s = substr($s, 8);

            dd($s);

            // if (File::exists(public_path('test.txt'))){
            //     File::delete(public_path('test.txt'));
            //     dd('File deleted.');
            // } else {
            //     dd('File does not exists.');
            // }


            // $image = $request->file('img');
            // $storedPath = $image->move('template/assets/imgProduct', $image->getClientOriginalName());
            // dd($image, $storedPath);
            // exit();
        
    }
}
