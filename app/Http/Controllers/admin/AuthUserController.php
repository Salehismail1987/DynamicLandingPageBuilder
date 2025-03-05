<?php
namespace App\Http\Controllers\admin;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class AuthUserController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            return redirect('dashboard');
        }
        $databaseName = DB::connection()->getDatabaseName();
        $tableName = (new User())->getTable();


        if(isset($_GET['username']) && isset($_GET['password'])){
            $credentials = ['email'=>$_GET['username'], 'password'=>$_GET['password']];
            if (Auth::attempt($credentials)) {
                return redirect('dashboard');
            }
        }
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // dd(bcrypt($request->password));
        $credentials = $request->only('email', 'password');
        // dd(preg_replace('/^www\./', '', request()->getHost()));
        $credentials['website'] = preg_replace('/^www\./', '', request()->getHost());
        // http://127.0.0.1:8000/forms?block=custom_forms_responses_list
      
        if (Auth::attempt($credentials)) {
            $intendedUrl = Session::pull('intended_url', 'dashboard');
            $token = strtok($intendedUrl, '?');
            $modifiedintendedUrl= $token !== false ? ltrim($token, '/') : '';
 
            $routeExists = collect(Route::getRoutes())->contains(function ($route) use ($modifiedintendedUrl) {
                return $route->uri() === $modifiedintendedUrl;
            });
            if ($routeExists) {
              
                return redirect($intendedUrl);
            } else {
                return redirect('dashboard');
            }
        }
        return redirect("login")->withError('Your email or password is incorrect.');
    }

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard");
    }

    public function create(array $data)
    { 
        return DB::connection('mysqlDashboard')->table('users')->insert([
            'website' => $_SERVER['SERVER_NAME'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    }    
    
    
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}