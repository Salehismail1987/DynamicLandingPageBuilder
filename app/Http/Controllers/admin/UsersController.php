<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGalleryCategory;
use App\Models\userRolls;
use App\Models\User;
use Hash;
use DB;

class UsersController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'users';
        $this->data['controller_name'] = 'Users';
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['font_family'] = get_font_family();
    }

    public function addview()
    {
        $this->data['userRolls'] = userRolls::where('website' , preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get();
        return view('admin.add',$this->data);
    }  

    public function create(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
      
        $user = DB::connection('mysqlDashboard')->table('users')->where('email',$request->email)->first();
        
        if($user){
            $validator = \Validator::make([], []);
            $validator->errors()->add('email', 'The email has already been taken.');
            
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $profile_image = '';

        if(!empty($_FILES['userfile']) && $request->hasFile('userfile')){
            $ima_name= rand(9,9999).date('d-m-Y').'.'.$request->userfile->extension();
            $sourcePath =$_FILES['userfile']['tmp_name'];
            $targetPath = "assets/uploads/".get_current_url(). $ima_name;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $profile_image = $ima_name;
            }
        }

        $userRole = UserRolls::where('id',$request->roletype)->first('ranking');
        
        $add_data = [
            'website' => preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']),
            'name' => $request->name,
            'email' => $request->email,
            'user_role' => $request->roletype,
            'photo' => $profile_image,
            'admin_type' => $userRole->ranking == 1 ? '1' : '0',
            'password' => Hash::make($request->password),
            'kptoken' => base64_encode_password($request->password),
        ];

        // $user= User::create($add_data);
        DB::connection('mysqlDashboard')->table('users')->insert($add_data);
        checkSendNotification('Business info updated','New User created','settings_business_notifications','settings_business_notification_email');

        return  redirect('businessinfo?block=user_types'); 
    }

    public function editview(Request $request){

        $this->data['userRolls'] = userRolls::where('website' , preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get();
        // $user = User::find($request->id);
        $user = DB::connection('mysqlDashboard')->table('users')->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->where('id',$request->id)->first();
        
        if(!$user){
            return redirect('businessinfo?block=user_types')->withError('User not found');
        }
       
        $this->data['admin_info'] = $user;
        return view('admin.edit',$this->data);

    }

    public function update(Request $request){

        // $user = User::find($request->id);
        $user = DB::connection('mysqlDashboard')->table('users')->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->where('id',$request->id)->first();
        
        if(!$user){
            return redirect('businessinfo?block=user_types')->withError('User not found');
        }

        $profile_image = '';
       
        if(!empty($_FILES['userfile']) && $request->hasFile('userfile')){
            $ima_name= rand(9,9999).date('d-m-Y').'.'.$request->userfile->extension();
            $sourcePath =$_FILES['userfile']['tmp_name'];
            $targetPath = "assets/uploads/".get_current_url(). $ima_name;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $profile_image = $ima_name;
            }
        }
        $userRole = UserRolls::where('id',$request->roletype)->first('ranking');
        $update_data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_role' => $request->roletype,
            
            'admin_type' => $userRole->ranking == 1 ? '1' : '0',
        ];

        if($profile_image !=''){
            $update_data['photo'] = $profile_image;
        }

        if($request->password && $request->password !=''){

            $update_data['password'] = Hash::make($request->password);
            $update_data['kptoken'] = base64_encode_password($request->password);
        }

        // User::where('id',$user->id)->update($update_data);
        $user = DB::connection('mysqlDashboard')->table('users')->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->where('id',$user->id)->update($update_data);

        return redirect('businessinfo?block=user_types')->withSuccess('User updated');
    }

    public function delete(Request $request){

        // $user = User::find($request->id);
        $user = DB::connection('mysqlDashboard')->table('users')->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->where('id',$request->id)->first();
        
        if(!$user){
            return redirect('businessinfo?block=user_types')->withError('User not found');
        }

        // User::where('id',$user->id)->delete();
        $user = DB::connection('mysqlDashboard')->table('users')->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->where('id',$user->id)->delete();

        return redirect('businessinfo?block=user_types')->withSuccess('User deleted');
    }
}
