<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\images;
use App\Models\imageGallery;
use App\Models\ImageGalleryCategory;
use DB;
class ImageController extends Controller 
{
    function delete_frontend_image(Request $request){

		$thisimg = $request->imgname;
		$column = $request->column;
		$table = $request->table;
		$id = $request->id;
		$isSlug = $request->isSlug;
		delimg($thisimg);
        if($isSlug=='true'){
            delete_image($column); 
        }else{ 
            if($table=='header_sliders'){
                DB::table($table)->where('id',$id)->delete(); 
            }else{
                DB::table($table)->where('id',$id)->update(array($column=>''));
            }
        }
    }
    
    function deleteEmailPostmage(Request $request){

		$emailId = $request->id;
        DB::table('email_post_images')->where('id',$id)->delete();
        return true;
          
    }
    function deleteEventPostmage(Request $request){

		$id = $request->id;
        DB::table('event_post_images')->where('id',$id)->delete();
        return true;
          
    }
    function delimage(Request $request){
		$img_slug = $request->img_slug;
		$img_name = $request->img_name;
        $form_logo = images::where('slug',$img_slug)->first();
        $remaning_img = array();
		if(isJson($form_logo->file_name)){
			$image = json_decode($form_logo->file_name);
			foreach($image as $single){
				if($single->img!=$img_name){
					$remaning_img[] = $single;
				}
			}
		}
        $form_logo->file_name = json_encode($remaning_img);
        $form_logo->save();
    }
    
	public function imageUpload(Request $request){
        $cate_id = $request->cate_id;
        $image_name = uploadimg($_FILES['file']);
        $imageGallery = new imageGallery();
        $imageGallery->category_id = $cate_id;
        $imageGallery->image = $image_name;
        $imageGallery->save();
        
	}
}
