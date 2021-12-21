<?php

namespace App\Http\Services\Shop;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductService {

    public function create($request) {
        try {

            Product::create([
                'name' => (string) $request->input('name'),
                'description' => (string) $request->input('description'),
                'category_id' => $request->input('category_id'),
                'price' => $request->input('price')
            ]);

            $productLatest = Product::latest()->first();

            $avatar = $request->file('avatar');
            $fileName = $avatar->getClientOriginalName();
            $fileName = $productLatest->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
            
            $avatar->storeAs('public\assets\avaProduct', $fileName, 'local');
            
            $storedPath = $avatar->move('assets/avaProduct', $fileName, $avatar->getClientOriginalName());

            $path = $storedPath->getPathName();
            $path = '/public/'.str_ireplace('\\','/',$path);

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
                    
                    $image->storeAs('public\assets\imgProduct', $fileNameImg, 'local');
                    
                    $storedPath = $image->move('assets/imgProduct', $fileNameImg, $image->getClientOriginalName());

                    $path = $storedPath->getPathName();
                    $path = '/public/'.str_ireplace('\\','/',$path);

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

        try {

            $product = Product::find($id);

            $product->update([
                'name' => (string) $request->input('name'),
                'description' => (string) $request->input('description'),
                'category_id' => $request->input('category_id'),
                'price' => $request->input('price')
            ]);

            if ($request->file('avatarEdit') != null) {

                if ($product->avatar != '/public/assets/avaProduct/product.jpg') {

                    $s = $product->avatar;

                    $s = substr($s, 8);
                    
                    File::delete(public_path($s));                    

                }

                $avatar = $request->file('avatarEdit');
                $fileName = $avatar->getClientOriginalName();
                $fileName = $product->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
                
                $avatar->storeAs('public\assets\avaProduct', $fileName, 'local');
                
                $storedPath = $avatar->move('assets/avaProduct', $fileName, $avatar->getClientOriginalName());
    
                $path = $storedPath->getPathName();
                $path = '/public/'.str_ireplace('\\','/',$path);
    
                $product->avatar = $path;
                $product->save();

            }

            // Images
            if ($request->file('images') !== null) {

                $images = $request->file('images');
                
                foreach ($images as $image) {

                    ProductImage::create([
                        'product_id' => $product->id
                    ]);

                    $imgLatest = ProductImage::latest()->first();

                    $fileNameImg = $image->getClientOriginalName();
                    $fileNameImg = $imgLatest->id.substr($fileNameImg, strpos($fileNameImg, '.', strlen($fileNameImg) - 5), strlen($fileNameImg));
                    
                    $image->storeAs('public\assets\imgProduct', $fileNameImg, 'local');
                    
                    $path = Storage::url('public/assets/avaProduct/product.jpg');

                    $imgLatest->image = $path;
                    $imgLatest->save();

                }
            }
            
            Session::flash('success', 'Cập nhật sản phẩm thành công');

        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }
        
        return true;
    }

    public function delete($id) {
        
        try {

            $product = Product::find($id);

            if ($product->avatar != '/public/assets/avaProduct/product.jpg') {

                $s = $product->avatar;

                $s = substr($s, 8);
                
                File::delete(public_path($s));                    

            }

            $images = ProductImage::where('product_id', '=', $id);

            foreach ($images as $img) {
                
                if ($img->image != '/public/assets/imgProduct/product.jpg') {

                    $s = $img->image;
        
                    $s = substr($s, 8);
                    
                    File::delete(public_path($s));                    
        
                }

            }

        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }
        
        Session::flash('success', 'Cập nhật sản phẩm thành công');
        return true;

    }

}