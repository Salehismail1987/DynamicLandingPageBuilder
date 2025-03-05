<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blogCategories;
use App\Models\ImageGalleryCategory;

class BlogCategoryController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'blogcategory';
        $this->data['controller_name'] = 'Blog Category';
        $this->data['font_family'] = get_font_family();
        
        $this->data['all_categories'] = ImageGalleryCategory::all();
    }
    public function addView(){
        if(!check_auth_permission(['blog-category'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        return view('admin.blogcategory.add')->with($this->data);
    }
    public function add(Request $request){
        if(!check_auth_permission(['blog-category'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $request->validate([
            'title' => 'required',
        ]);
        
        $newData = new blogCategories();
        $newData->title = $request->title;
        $newData->save();

        return  redirect('blog?block=blog_category')->withSuccess('Blog Category has been added successfully'); 
    }

    public function editView(Request $request){
        if(!check_auth_permission(['blog-category'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['record_id'] = $request->id;
        $data = blogCategories::find($request->id);
        
        if(!$data){
            return redirect('blog?block=blog_category')->withError('Data not found');
        }
       
        $this->data['detail_info'] = $data;
        return view('admin.blogcategory.edit')->with($this->data);
    }

    public function update(Request $request){
        if(!check_auth_permission(['blog-category'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $request->validate([
            'title' => 'required',
        ]);
        
        $newData = blogCategories::find($request->id);
        $newData->title = $request->title;
        $newData->save();

        return  redirect('blog?block=blog_category')->withSuccess('Blog Category has been updated successfully'); 
    }

    public function delete(Request $request){
        if(!check_auth_permission(['blog-category'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $data = blogCategories::find($request->id);
        if(!$data){
            return redirect('blog?block=blog_category')->withError('Data not found');
        }
        blogCategories::where('id',$data->id)->delete();
        return redirect('blog?block=blog_category')->withSuccess('Data deleted successfully');
    }
}
