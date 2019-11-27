<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivateAccountEmail;
use App\Mail\ForgotPasswordEmail;

class AuthController extends Controller
{	
	protected $seeder = 'MotilixSeeder';

	public function register(Request $request) 
	{
		$this->validate($request, User::$rules);
	    $request['password']=Hash::make($request['password']);
	    $user = User::create($request->toArray());

	    return response($user, 200);
	}

	public function activate(Request $request) 
	{	
	    $user = User::where('email', $request->email)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	        	if(empty($user->email_verified_at)){
	        		$user->email_verified_at = date('Y-m-d H:i:s');
	        		$user->save();
	        	}
	        	$response = 'Email has been verified';
	            return response(['msg' => $response], 200);
	        } else {
	            $response = "Password missmatch";
	            return response(['error' => $response], 422);
	        }
	    } else {
	        $response = 'User does not exist';
	        return response(['error' => $response], 422);
	    }
	}

	public function login(Request $request) 
	{	
	    $user = User::where('email', $request->email)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	        	if(empty($user->email_verified_at)){
	        		$response = "Email unverified";
	            	return response(['error' => $response]);
	        	}
	            $token = $user->createToken($this->seeder)->accessToken;
	            $response = ['token' => $token];
	            return response($response, 200);
	        } else {
	            $response = "Password missmatch";
	            return response(['error' => $response]);
	        }
	    } else {
	        $response = 'User does not exist';
	        return response(['error' => $response]);
	    }
	}

	public function logout (Request $request) {
	    $token = $request->user()->token();
	    $token->revoke();

	    $response = 'You have been succesfully logged out!';
	    return response(['msg' => $response], 200);
	}

	public function unauthorized(){
		return response(['error'=>'Not authorized'], 401);
	}

	public function resetpassword(Request $request){
		$user = User::where('email', $request->email)->first();
	    if ($user) {
	    	if($request->new_password == $request->confirm_password){
		        $user->password=Hash::make($request['new_password']);
		        $user->save();
		        $response = 'Password changed';
	        	return response(['msg' => $response], 200);
		    } else {
		    	$response = 'Passwords do not match';
	        	return response(['error' => $response], 422);
		    }
	    } else {
	        $response = 'User does not exist';
	        return response(['error' => $response], 422);
	    }
	}

	public function changepassword(Request $request){
		$user = User::where('email', $request->email)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	        	if($request->new_password == $request->confirm_password){
			        $user->password=Hash::make($request['new_password']);
			        $user->save();
			        $response = 'Password changed';
	        		return response(['msg' => $response], 200);
			    } else {
			    	$response = 'Passwords do not match';
		        	return response(['error' => $response], 422);
			    }
	        } else {
	            $response = "Wrong username or password";
	            return response(['error' => $response], 401);
	        }
	    } else {
	        $response = 'User does not exist';
	        return response(['error' => $response], 401);
	    }
	}

	public function viewprofile(Request $request){
		$user = User::with('role')->find(auth('api')->user()->id);
	    return response($user, 200);
	}

	public function updateprofile(Request $request){
		$user = User::find($request->id);
		if(!empty($user)){
			$email_exists = User::where('email', $request->email)->where('id', '!=', $user->id)->first();
			if(empty($email_exists)){
				$user->firstname = $request->firstname;
				$user->surname = $request->surname;
				$user->phone_number = $request->phone_number;
				$user->email = $request->email;
				$user->save();
				$response = 'Profile updated';
	        	return response(['msg' => $response], 200);
	        } else {
	        	$response = 'Email exists';
	        	return response(['error' => $response], 209);
	        }
		}
		return response(['error' => 'Details could not be updated'], 500);
	}

	public function activateaccountemail(Request $request){
		$user = User::find($request->id);
		if ($user) {
			Mail::send(new ActivateAccountEmail($user));
			return response(['msg'=> 'Mail sent'], 200);
		} else {
			$response = 'User does not exist';
	        return response(['error' => $response], 401);
	    }
	}


	public function forgotpasswordemail(Request $request){
		$user = User::where('email', $request->email)->first();
	    if ($user) {
			//Change Old Password
			$new_password = str_random(8);
			$user->password = Hash::make($new_password);
			$user->save();
			//Send new_password to email
			$user->password = $new_password;
			Mail::send(new ForgotPasswordEmail($user));
			return response(['msg'=> 'Password was reset and sent to your email!'], 200);
	    } else {
	        $response = 'User does not exist';
	        return response(['error' => $response], 401);
	    }
	}

	public function activateaccountcode(Request $request){
		$user = User::find($request->id);
		if ($user) {
			$seedstr='motilix';
			$code = strtoupper(substr(md5($user->id.$user->email.$seedstr), 0, 4));
			return response(['code'=> $code], 200);
		} else {
			$response = 'User does not exist';
	        return response(['error' => $response], 401);
	    }
	}

	public function verifyaccountcode(Request $request){
		$user = User::find($request->id);
		if ($user) {
			$seedstr='motilix';
			$code = strtoupper(substr(md5($user->id.$user->email.$seedstr), 0, 4));
			if($code == $request->code){
				if(empty($user->email_verified_at)){
	        		$user->email_verified_at = date('Y-m-d H:i:s');
	        		$user->save();
	        	}
				return response(['msg'=> 'Account verified'], 200);
			}else{
				$response = 'Account not verified';
	        	return response(['error' => $response], 401);
			}
		} else {
			$response = 'User does not exist';
	        return response(['error' => $response], 401);
	    }
	}
}
