<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\userRolls;
use App\Models\ImageGalleryCategory;
use App\Models\rolePermissions;
use App\Models\permissions;
use DB;

class UsersRollsController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'permissions';
        $this->data['all_categories'] = ImageGalleryCategory::all(); 
        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['controller_name'] = 'User Role';
        $this->data['font_family'] = get_font_family();
    }

    public function addview()
    {
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        return view('admin.userrolls.add',$this->data);
    }  

    public function create(Request $request)
    {  
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $request->validate([
            'name' => 'required',
        ]);
        // $rank = userRolls::orderBy('ranking','DESC')->first();
        //'ranking' => $rank->ranking ? $rank->ranking+1:1
        // userRolls::create([
        DB::connection('mysqlDashboard')->table('user_rolls')->insert([
            'website' => preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']),
            'name' => $request->name,
            'ranking' => $request->ranking
        ]);
        checkSendNotification('Business info updated','New user role created','settings_business_notifications','settings_business_notification_email');
        return  redirect('businessinfo?block=permissions'); 
    }

    public function editview(Request $request){
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }

        // $user = userRolls::find($request->id);
        $user =  DB::connection('mysqlDashboard')->table('user_rolls')->where('id',$request->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->first();
        if(!($user->ranking > getUserRollRank())){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        
        if(!$user){
            return redirect('businessinfo?block=permissions')->withError('User type not found');
        }
       
        $this->data['role'] = $user;
        return view('admin.userrolls.edit',$this->data);

    }

    public function update(Request $request){
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        // $user = userRolls::find($request->id);
        $user =  DB::connection('mysqlDashboard')->table('user_rolls')->where('id',$request->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->first();
        if(!($user->ranking > getUserRollRank())){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        
        if(!$user){
            return redirect('businessinfo?block=permissions')->withError('User type not found');
        }
        $update_data = [
            'name' => $request->name,
            'ranking' => $request->ranking
        ];

        
        DB::connection('mysqlDashboard')->table('user_rolls')->where('id',$user->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->update($update_data);
        // userRolls::where('id',$user->id)->update($update_data);

        return redirect('businessinfo?block=permissions')->withSuccess('User type updated');
    }

    public function delete(Request $request){
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        // $user = userRolls::find($request->id);
        $user =  DB::connection('mysqlDashboard')->table('user_rolls')->where('id',$request->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->first();
        if(!($user->ranking > getUserRollRank())){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        
        if(!$user){
            return redirect('businessinfo?block=permissions')->withError('User type not found');
        }

        DB::connection('mysqlDashboard')->table('user_rolls')->where('id',$user->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->delete();
        // userRolls::where('id',$user->id)->delete();

        return redirect('businessinfo?block=permissions')->withSuccess('User type deleted');
    }

    public function editpermissionview(Request $request){
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['catID'] = $request->id;
        // $userRoll = userRolls::find($request->id);
        $userRoll =  DB::connection('mysqlDashboard')->table('user_rolls')->where('id',$request->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->first();
        if(!($userRoll->ranking > getUserRollRank())){
            return  redirect('dashboard')->withError('Access Denied'); 
        }

        // $permissions_ids = rolePermissions::select('permission_id')->where('role_id',$request->id)->get()->toArray();
        // $permissions = permissions::whereIn('id',$permissions_ids)->get();
        
        $permissions_ids = DB::connection('mysqlDashboard')->table('role_permissions')->select('permission_id')->where('role_id',$request->id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get()->toArray();
        $permissions_ids = json_decode(json_encode($permissions_ids),true);
        $permissions = DB::connection('mysqlDashboard')->table('permissions')
        ->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))
        ->whereIn('id',$permissions_ids)->get();
       
        $this->data['granted_permissions'] = $permissions;
        return view('admin.userrolls.permissions',$this->data); 
    }

    public function updatepermissions(Request $request){
        return redirect('editpermissions/'.$request->id)->withSuccess('Permission updated');
    }

    public function change_permission(Request $request){
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $role_id = $request->role_id;
		$permission_id = $request->permission_id;
		if ($request->status == true) {
			// $permission = rolePermissions::where('role_id',$role_id)->where('permission_id',$permission_id)->first();
            $permission = DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id',$role_id)->where('permission_id',$permission_id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->first();

            if (empty($permission)) {
				// rolePermissions::create([
				// 	'website' => $_SERVER['SERVER_NAME'],
				// 	'role_id' => $role_id,
				// 	'permission_id' => $permission_id,
				// ]);
				DB::connection('mysqlDashboard')->table('role_permissions')->insert([
					'website' => preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']),
					'role_id' => $role_id,
					'permission_id' => $permission_id,
				]);
			}
		}else{
			// rolePermissions::where('role_id',$role_id)->where('permission_id',$permission_id)->delete();
            DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id',$role_id)->where('permission_id',$permission_id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->delete();
		}
    }

    public function toggle_all_permissions(Request $request){
        if(!check_auth_permission(['permissions'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
		$role_id = $request->role_id;
		
		// rolePermissions::where('role_id',$role_id)->delete();
        DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id',$role_id)->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->delete();
		if ($request->status == true) {

			// $permissions = permissions::whereNotNull('parent_id')->get();
            $permissions = DB::connection('mysqlDashboard')->table('permissions')->whereNotNull('parent_id')->where('website',preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get();
			foreach ($permissions as $permission) {
				// rolePermissions::create([
				// 	'role_id' => $role_id,
				// 	'permission_id' => $permission->id,
				// ]);
                $permissions = DB::connection('mysqlDashboard')->table('role_permissions')->insert([
					'website' => preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']),
					'role_id' => $role_id,
					'permission_id' => $permission->id,
                ]);
			}
		}
	}
}
