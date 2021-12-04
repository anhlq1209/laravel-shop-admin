<?php

namespace App\Http\Services\Shop;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductService {

    public function create($request) {
        try {            
            Product::create([
                'name' => (string) $request->input('name'),
                'description' => (string) $request->input('description'),
                'category_id' => (string) $request->input('category_id'),
                'price' => (string) $request->input('price')
            ]);

            $productLastest = Product::latest()->first();

            $image = $request->file('avatar');
            $fileName = $image->getClientOriginalName();
            $fileName = $productLastest->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
            
            $image->storeAs('assets\imgProduct', $fileName, 'local');
            
            $storedPath = $image->move('assets\imgProduct', $fileName, $image->getClientOriginalName());
            
            $productLastest->avatar = $storedPath;
            $productLastest->save();
            
            Session::flash('success', 'Tạo sản phẩm mới thành công');

        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }
        
        return true;
    }

}