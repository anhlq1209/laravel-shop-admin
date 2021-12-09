<?php

namespace App\Http\Services\Shop;

use App\Models\Product;
use App\Models\ProductImage;
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

            $productLatest = Product::latest()->first();

            $avatar = $request->file('avatar');
            $fileName = $avatar->getClientOriginalName();
            $fileName = $productLatest->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
            
            $avatar->storeAs('assets\imgProduct', $fileName, 'local');
            
            $storedPath = $avatar->move('assets\imgProduct', $fileName, $avatar->getClientOriginalName());

            $path = $storedPath->getPathName();
            $path = '/'.str_ireplace('\\','/',$path);

            $productLatest->avatar = $path;
            $productLatest->save();

            // Images
            if ($request->file('images') !== null) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    ProductImage::create([
                        'product_id' => $productLatest->id
                    ]);

                    $imgLatest = ProductImage::latest()->first();

                    $fileNameImg = $image->getClientOriginalName();
                    $fileNameImg = $imgLatest->id.substr($fileNameImg, strpos($fileNameImg, '.', strlen($fileNameImg) - 5), strlen($fileNameImg));
                    
                    $image->storeAs('assets\imgProduct', $fileNameImg, 'local');
                    
                    $storedPath = $image->move('assets\imgProduct', $fileNameImg, $image->getClientOriginalName());

                    $path = $storedPath->getPathName();
                    $path = '/'.str_ireplace('\\','/',$path);

                    $imgLatest->image = $path;
                    $imgLatest->save();
                }
            }
            
            Session::flash('success', 'Tạo sản phẩm mới thành công');

        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }
        
        return true;
    }

    public function update($id, $request) {

        dd($request);
        exit();

        try {

            $productUpdate = Product::where('id', $id);
    
            $productUpdate->name = $request->input('name');
            $productUpdate->description = $request->input('description');
            $productUpdate->category_id = $request->input('category_id');
            $productUpdate->price = $request->input('price');

            if ($request->file('avatarEdit') !== null) {
                
                $avatar = $request->file('avatarEdit');
                $fileNameAvatar = $avatar->getClientOriginalName();
                $fileNameImg = $productUpdate->id.substr($fileNameAvatar, strpos($fileNameAvatar, '.', strlen($fileNameAvatar) - 5), strlen($fileNameAvatar));
                
                $avatar->storeAs('assets\imgProduct', $fileNameImg, 'local');
                
                $storedPath = $avatar->move('assets\imgProduct', $fileNameImg, $avatar->getClientOriginalName());

                $path = $storedPath->getPathName();
                $path = '/'.str_ireplace('\\','/',$path);


                $productUpdate->avatar = $path;
            }

            if ($request->file('images') !== null) {

                $images = $request->file('images');

                foreach ($images as $image) {

                    ProductImage::create([
                        'product_id' => $productUpdate->id
                    ]);

                    $imgLatest = ProductImage::latest()->first();

                    $fileNameImg = $image->getClientOriginalName();
                    $fileNameImg = $imgLatest->id.substr($fileNameImg, strpos($fileNameImg, '.', strlen($fileNameImg) - 5), strlen($fileNameImg));
                    
                    $image->storeAs('assets\imgProduct', $fileNameImg, 'local');
                    
                    $storedPath = $image->move('assets\imgProduct', $fileNameImg, $image->getClientOriginalName());

                    $path = $storedPath->getPathName();
                    $path = '/'.str_ireplace('\\','/',$path);

                    $imgLatest->image = $path;
                    $imgLatest->save();
                    
                }

            }

            Session::flash('success', 'Cập nhật thông tin Product thành công');
            return redirect()->back();
        
        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }

    }

}