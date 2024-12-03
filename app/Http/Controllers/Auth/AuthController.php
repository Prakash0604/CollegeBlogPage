<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function loginStore(UserRequest $request){
        try{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                if(Auth::user()->role =='Admin'){
                    return redirect()->route('admin.dashboard')->with(['message'=>'Welcome '.auth()->user()->full_name]);
                }elseif(Auth::user()->role == 'Student'){
                    echo "Hello Student";
                }else{
                    echo "Hello Teacher";
                }

            }else{
                return back()->with(['error'=>'Invalid Login Crediantials']);
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with(['error'=>'Something went wrong']);
        }
    }

    public function register(){
        return view('admin.auth.register');
    }

    public function registerStore(UserRequest $userRequest){
        DB::beginTransaction();
        try{
            $data=$userRequest->validated();
            $data['role']='Admin';
            User::create($data);
            DB::commit();
            return back()->with(['message'=>'User Create Successfully']);
        }catch(\Exception $e){
            DB::rollBack();
            Log::error(['message'.$e->getMessage()]);
            return back()->with(['error'=>'Something went wrong !']);
        }
    }

    public function registerAuthPassword(Request $request){
        try{
            // dd($request->all());
            $password=$request->password;
            if($password !='Admin@123'){
                return response()->json(['success'=>false,'status'=>301]);
            }
            return response()->json(['success'=>true,'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage(),'status'=>500]);
        }
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
