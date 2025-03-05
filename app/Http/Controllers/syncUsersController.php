<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Hash;

class syncUsersController extends Controller
{
    public function insertPermission($permission_parent_id,$permission){

        $permission_id = DB::connection('mysqlDashboard')->table('permissions')->insertGetId(
            array(
                'website'   =>   $_SERVER['SERVER_NAME'],
                'permission_name'   =>   $permission->permission_name,
                'permission_slug'   =>   $permission->permission_slug,
                'parent_id'   =>   $permission_parent_id,
                'display_order'   =>   $permission->display_order,
                'created_at'   =>   $permission->created_at,
                'updated_at'   =>   $permission->updated_at
            )
        );
        $permissions = DB::connection('mysql')->table('permissions')->where('parent_id',$permission->id)->get();
        if(count($permissions)>0){
            foreach($permissions as $permission){
                $this->insertPermission($permission_id,$permission);
            }
        }
    }
    public function sync()
    {
        echo '<pre>';
        $server_name = $_SERVER['SERVER_NAME'];
        $server_name = substr($server_name,0,3);
        $userRolls = DB::connection('mysqlDashboard')->table('user_rolls')->where('website',$_SERVER['SERVER_NAME'])->get();
        if(!(count($userRolls)>0)){
            $userRolls = DB::connection('mysql')->table('user_rolls')->get();
            // print_r($userRolls);die();
            if(count($userRolls)){
                $permissions = DB::connection('mysql')->table('permissions')->whereNull('parent_id')->get();
                foreach($permissions as $permission){
                    $this->insertPermission('',$permission);
                }
                foreach($userRolls as $userRoll){
                    $rol_id = DB::connection('mysqlDashboard')->table('user_rolls')->insertGetId(
                        array(
                            'website'   =>   $_SERVER['SERVER_NAME'],
                            'name'   =>   $userRoll->name,
                            'ranking'   =>   $userRoll->ranking,
                            'created_at'   =>   $userRoll->created_at,
                            'updated_at'   =>   $userRoll->updated_at
                        )
                   );
                   
                    $users = DB::connection('mysql')->table('users')->where('user_role',$userRoll->id)->get();
                   if(count($users)>0){
                        foreach($users as $user){
                            
                            $email = $user->email;
                            $email = explode('@',$email);
                            $email = $email[0].'.'.$server_name.'@'.$email[1];
                            $newData = DB::connection('mysqlDashboard')->table('users')->insert(
                                array(
                                    'website'   =>   $_SERVER['SERVER_NAME'],
                                    'user_role'   =>   $rol_id, 
                                    'email'   =>   $email,
                                    'password'   =>   $user->password,
                                    'name'   =>   $user->name,
                                    'photo'   =>   $user->photo,
                                    'email_verified_at'   =>   $user->email_verified_at,
                                    'remember_token'   =>   $user->remember_token,
                                    'kptoken'   =>   $user->kptoken,
                                    'admin_type'   =>   $user->admin_type,
                                    'created_at'   =>   $user->created_at,
                                    'updated_at'   =>   $user->updated_at
                                )
                           );
                        }
                   }else{
                        echo "User not found";
                    }

                   $users_role_permissions = DB::connection('mysql')->table('role_permissions')->where('role_id',$userRoll->id)->get();
                    if(count($users_role_permissions)>0){
                        foreach($users_role_permissions as $users_role_permission){

                            $users_permission = DB::connection('mysql')->table('permissions')->where('id',$users_role_permission->permission_id)->first();
                            if($users_permission){
                                $D_permision = DB::connection('mysqlDashboard')->table('permissions')->where('website',$_SERVER['SERVER_NAME'])->where('permission_slug',$users_permission->permission_slug)->first();
                                if($D_permision){
                                    $newData = DB::connection('mysqlDashboard')->table('role_permissions')->insert(
                                        array(
                                            'website'   =>   $_SERVER['SERVER_NAME'],
                                            'role_id'   =>   $rol_id,
                                            'permission_id'   =>   $D_permision->id,
                                            'created_at'   =>   $users_role_permission->created_at,
                                            'updated_at'   =>   $users_role_permission->updated_at
                                        )
                                    );
                                }
                            }
                        }
                    }else{
                        // echo "User Permissions not found";
                    }
                }
            }else{
                echo "User Rolls not found";
            }
        }else{
            echo "User Rolls already exist";
        }
    }

}
