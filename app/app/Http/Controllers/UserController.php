<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
// use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use App\Models\BlogUser;


class UserController extends Controller
{
    function allUsers()
    {
        return BlogUser::all();
    } 
    function singleUser($id)
    {
        return BlogUser::find($id);
    }
    // function registration( Request $req)
    // {

    //     // Mail::send(['html'=>'mail'], ['name', 'Test'], function($message){
    //     //     $message->to('satyajit.senapati@nettantra.net', 'To Test')->subject
    //     //        ('Laravel Basic Testing Mail');
    //     //     $message->from('sender@example.com','Test Sender');
    //     //  });

    //     // Mail::to('satyajit.senapati@nettantra.net')->send(new TestEmail());

    //     // Mail::to('test@example.com')->send(new TestEmail());

    // // $validator = validator::make($req->all(),[

    // //         'name'=>'required', 
    // //         'email'=>'required|unique:blog_users|email',
    // //         'password'=>'required',
    // //         'role'=>'required',
            
    // //         ]);

    //         $req->validate(

    //             [
    //                 'first_name'=>'required', 
    //                 'last_name'=>'required', 
    //                 'user_name'=>'required', 
    //                 'email'=>'required|unique:blog_users|email',
    //                 'password'=>'required',
                    
    //             ]
                
    //             );
                        
    //         $user=new BlogUser;
    //         $user->first_name=$req->first_name;
    //         $user->last_name=$req->last_name;
    //         $user->user_name=$req->user_name;
    //         $user->email=$req->email;
    //         $user->password=bcrypt($req->password);
    //         if ($req->role == "admin") {
    //             $user->role = "admin";
    //           } else {
    //             $user->role = "user";
    //           }
    //         $user->image=$req->image;
    //         $result=$user->save();
            
           
            
    //         $token = $user->createToken('Token Name')->accessToken;

    //         return response()->json([
    //             'token' => $token,
    //             'user_id'=>$user->id,
    //             'role'=>$user->role
    //         ]);
            

    

    // }

    function registration( Request $req)
{
        $req->validate([
        'first_name' => 'required', 
        'last_name' => 'required', 
        'user_name' => 'required', 
        'email' => 'required|unique:blog_users|email',
        'password' => 'required|min:6'
    ]);
    
    $user = new BlogUser;
    $user->first_name = $req->first_name;
    $user->last_name = $req->last_name;
    $user->user_name = $req->user_name;
    $user->email = $req->email;
    $user->password = bcrypt($req->password);
    if ($req->role == "admin") {
        $user->role = "admin";
    } else {
        $user->role = "user";
    }
    $user->image = $req->image;
    $result = $user->save();

    $token = $user->createToken('Token Name')->accessToken;

    return response()->json([
        'token' => $token,
        'user_id' => $user->id,
        'role' => $user->role,
        'user_name' => $user->user_name
    ]);
}


    public function makeAdmin($id) {
        $user = BlogUser::find($id);
        $user->role = 'admin';
        $result=$user->save();
  
      
        if ($result)
        {
            return ["User assigned as adminstrator successful"];
        }
        else{
            return ["Failed to make user as admin"];

        }

    }
    public function terminateAdmin($id) {
        $user = BlogUser::find($id);
        $user->role = 'user';
        $result=$user->save();
  
      
        if ($result)
        {
            return ["User terminated from adminstrator successfull"];
        }
        else{
            return ["Failed to termiate"];

        }

    }
    
    function login(Request $request)
{
        $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $user = BlogUser::where('email', $request->email , 'role', $request->role)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    } else if ($user->role == 'admin' || $user->role == 'user') {
        $user_id = $user->id;
        $role = $user->role;
        $token = $user->createToken('Token Name')->accessToken;

        return response()->json([
            'token' => $token,
            'user_id' => $user_id,
            'role' => $role,
            'user_name' => $user->user_name

        ]);
    } else {
        return response()->json(['error' => 'You are not an authorized user'], 401);
    }
}


    function updateUser(Request $req , $id)
    {    

            $user=BlogUser::find($id);
            $user->name=$req->name;
            $user->email=$req->email;
            $user->password=$req->password;
            $result=$user->save();
  
      
        if ($result)
        {
            return ["Data updated successfully"];
        }
        else{
            return ["Data updated failed"];

        }
    }
    
    function deleteUser($id)
    {
        $user=BlogUser::find($id);
        $result=$user->delete();
        
        if ($result)
        {
            
            return [" User Deleted successfully"];
        }
        else{
            return [" User Not Deleted"];
            
        }
    }
}
