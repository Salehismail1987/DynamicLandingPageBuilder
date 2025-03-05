<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageGalleryCategory;
use Illuminate\Http\Request;
use DB;

class TipController extends Controller
{
    
	public function getTipData(Request $request)
	{
		
		$section =  $request->section;
		$tip = DB::connection('mysqlDashboard')->table('tips')->where('section',$section)->first();
		$html = '';

		if ($tip) {

			$tip_desc = $tip->desc;
			$tip_bottom_desc= $tip->desc_bottom;

			//fidning and repalcing shortcodes
			//$links = $dashboard_db->where(array('tip_id'=>$tip->id,'link_type'=>'tip'))->get('links')->result();
			$links = DB::connection('mysqlDashboard')->table('links')->where(array('tip_id'=>$tip->id,'link_type'=>'tip'))->get();
								
			foreach($links as $link){
				$link_replace = "<a href='".$link->link_href."'><b>".$link->link_text."</b></a>";
			
				$tip_desc = str_replace('['.$link->link_code.']', $link_replace, $tip_desc);
				

				$tip_bottom_desc = str_replace('['.$link->link_code.']', $link_replace, $tip_bottom_desc);
			}

			$html = '<div>
			<img width="60" src="'.env('dashboard_url').'assets/admin2/img/idea-icon.png">
			</div>
			<br>
			<h3>'.$tip->title.'</h3>
			<div>
			<p class="text-justify">'.nl2br($tip_desc).'</p>
			</div>';
			if (!empty($tip->video) && $tip->attachment_type == "video") {
				$html .= '<div>
				<video width="100%" controls>
				<source src="'.env('dashboard_url').'assets/uploads/'.get_current_url().$tip->video.'" type="video/mp4">
			  </video>
				</div>';
			}

			if (!empty($tip->image) && $tip->attachment_type == "image") {
				$html .= '<div>
				<img src="'.env('dashboard_url').'assets/uploads/'.get_current_url().$tip->image.'" width="100%" height="250" style="object-fit:contain">
			
				</div>';
			}
			if (!empty($tip_bottom_desc)) {
				$html .= '<br><p class="text-justify show-read-more">'.nl2br($tip_bottom_desc ).'</p>';
			}
		}
		echo $html;
		exit;
	}
}
