<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\responsesFolder;

class ResponseFolderController extends Controller
{
   
    public function __construct(){
        $this->data['controller'] = 'forms';
        $this->data['controller_name'] = 'Forms';
        $this->data['font_family'] = get_font_family();
    }
    
    public function add(Request $request){
        $this->data['formAction'] = 'add';
        return view('admin.response_folder.addedit')->with($this->data);
    }

    public function save(Request $request){
        $request->validate([
            'title' => 'required',
        ]);
        $action = $request->formAction;
        $message = 'Forms has been '.($action=='edit'?'updated':'added').' successfully';
        $block = 'responsive_folders';
        if($action=='edit'){
            $newData = responsesFolder::find($request->formid);
        }else{
            $newData = new responsesFolder();
        }
        $newData->title = $request->title;
        $newData->save();

        return redirect('forms?block='.$block)->withSuccess($message);

    }
    public function edit(Request $request){
        $this->data['detail_info'] = responsesFolder::find($request->id);
        $this->data['formAction'] = 'edit';
        return view('admin.response_folder.addedit')->with($this->data);
    }
    public function duplicate(Request $request){
        $this->data['detail_info'] = responsesFolder::find($request->id);
        $this->data['formAction'] = 'duplicate';
        return view('admin.response_folder.addedit')->with($this->data);
    }
    public function delete(Request $request){
        $data = responsesFolder::find($request->id);
        if(!$data){
            return redirect('forms?block=responsive_folders')->withError('Data not found');
        }
        responsesFolder::where('id',$data->id)->delete();
        return redirect('forms?block=responsive_folders')->withSuccess('Data deleted successfully');
    }
}
