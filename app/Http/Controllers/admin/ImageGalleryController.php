<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\imageGallery;
use App\Models\ImageGalleryCategory;

class ImageGalleryController extends Controller
{
    public function getCateImages(Request $request) {
        
        $cate_id = $request->cate_id;
        $getImages = $request->getImages;
        $image_gallery = imageGallery::where('category_id',$cate_id)->get();
        
        $html = '';
        if(count($image_gallery)>0){
            foreach($image_gallery as $single){
                $html .= '<div class="col-md-3 imgdiv">';
                if($getImages){
                    $html .= '<div class="selectimgdiv" data-img_id="'.$single->id.'" data-img_name="'.$single->image.'">';
                }       
                $html .= '<img src="'.url('assets/uploads'.get_current_url() .'/'. $single->image).'" width="100%"/>';
                //if(!$getImages){
                    $html .= '<img src="'.base_url('assets/admin2/img/cross-round.png').'" class="btnimgdel" data-imgid="'.$single->id.'" width="20px">';
                //}
                if($getImages){
                    $html .= '</div>';
                }
                $html .= '</div>';
            }
        }else{
        $html = '<div class="col-md-12">
                    <div class="text-center"> No record Found</div>
                </div>';
        }
        echo $html;
    }
    function delete_gallery_image(Request $request){

		$imgid = $request->imgid;
        $imgg= imageGallery::where('id',$imgid)->first();
        if(isset($imgg->image)){
            delimg($imgg->image);
        }
        imageGallery::where('id',$imgid)->delete();
    }
}
