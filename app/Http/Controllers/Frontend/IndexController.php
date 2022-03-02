<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class IndexController extends Controller
{
    //
    public function index(){
        return view('frontend.index');
    }

    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));

    }

    public function UserProfileStore(Request $request){
        $storeData = User::find(Auth::user()->id);
        $storeData->name = $request->name;
        $storeData->email = $request->email;


        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$storeData->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $storeData['profile_photo_path'] = $filename;
        }
        $storeData->save();
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('dashboard')->with($notification);

    }

    public function ChangePassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));

    }

    
    public function UserPasswordUpdate(Request $request){
        $validateData = $request->validate([
           'oldpassword'=> 'required',
           'password'=> 'required|confirmed',
        ]); 
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
$user = User::find(Auth::id());
$user->password = Hash::make($request->password);
  $user->save();
  Auth::logout();
  return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }

    }//end method
}