<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Http\Services\Shop\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $images = ProductImage::where('product_id', $id)->get();

        return view('pages.product.edit', [
            'title' => 'Edit product',
            'product' => $product,
            'categories' => $categories,
            'images' => $images
        ]);
    }

    public function update($id, Request $request) {

        if ($this->productService->update($id, $request)) {
            Session::flash('success', 'Cập nhật thông tin Product thành công');
            return redirect()->back();
        }
        
        Session::flash('error', 'Cập nhật thất bại');
        return redirect()->back()->withInput();
    }

    public function destroy($id) {
        if (Product::where('id', $id)->delete()) {
            Session::flash('success', 'Xóa Category thành công');
            return true;
        }
        
        Session::flash('error', 'Xóa thất bại');
        return false;
    }

    public function deleteImage($id) {
        ProductImage::find($id)->delete();
    }

    //  TEST
    public function test() {
        
        return view('test');

    }

    public function testStore(Request $request) {

        if ($request->isMethod('post')) {

            $image = $request->file('img');
            $storedPath = $image->move('template/assets/imgProduct', $image->getClientOriginalName());
            dd($image, $storedPath);
            exit();

        }
        
    }
}
