<?php

namespace App\Http\Services\Shop;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CategoryService {

    public function create($request) {
        try {

            Category::create([
                'name' => (string) $request->input('name')
            ]);

            $categoryLatest = Category::latest()->first();

            $avatar = $request->file('avatar');
            $fileName = $avatar->getClientOriginalName();
            $fileName = $categoryLatest->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
            
            $avatar->storeAs('assets\imgCategory', $fileName, 'local');
            
            $storedPath = $avatar->move('assets\imgCategory', $fileName, $avatar->getClientOriginalName());

            $path = $storedPath->getPathName();
            $path = '/public/'.str_ireplace('\\','/',$path);

            $categoryLatest->avatar = $path;
            $categoryLatest->save();
            
            Session::flash('success', 'Danh mục đã được tạo');

        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }
        
        return true;
    }

    public function edit($id, $request) {
        try {

            $categoryEdit = Category::find($id);

            $categoryEdit->name = $request->input('name');
            $categoryEdit->save();

            if  ($request->file('avatar') !== null) {

                $avatar = $request->file('avatar');
                $fileName = $avatar->getClientOriginalName();
                $fileName = $categoryEdit->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
                
                $avatar->storeAs('assets\imgCategory', $fileName, 'local');
                
                $avatar->move('assets\imgCategory', $fileName, $avatar->getClientOriginalName());
            
            }
            
            Session::flash('success', 'Danh mục đã được tạo');

        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return false;

        }
        
        return true;

    }

    public function update($id, $request) {
        try {

            $category = Category::find($id);

            $category->update([
                'name' => (string) $request->input('name')
            ]);

            if ($request->file('avatarEdit') != null) {

                if ($category->avatar != '/public/assets/avaCategory/category.jpg') {
                    
                    $s = $category->avatar;

                    $s = substr($s, 8);
                    
                    File::delete(public_path($s));
                    
                }

                $avatar = $request->file('avatarEdit');
                $fileName = $avatar->getClientOriginalName();
                $fileName = $category->id.substr($fileName, strpos($fileName, '.', strlen($fileName) - 5), strlen($fileName));
                
                $avatar->storeAs('public\assets\avaCategory', $fileName, 'local');
                
                $storedPath = $avatar->move('assets/avaCategory1', $fileName, $avatar->getClientOriginalName());
    
                $path = $storedPath->getPathName();
                $path = '/public/'.str_ireplace('\\','/',$path);
    
                $category->avatar = $path;
                $category->save();

            }
            
            Session::flash('success', 'Cập nhật danh mục thành công');

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
        
        return true;

    }

}