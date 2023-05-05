<?php 

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Str;
use Validator;

class UserController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'secure_string' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $dbuser = User::where('password', hash('sha256', $request['secure_string']))->first();
        if($dbuser) return $this->sendError('Already exists.', ['error'=>'This user already exsits']);

        $input = $request->all();
        $input['username'] = $request['username'];
        $input['password'] = hash('sha256', $request['secure_string']);
        $token = Str::random(40);
        $input['api_token'] = $token;
        $input['policies'] = $request['policies'] == null ? "" : $request['policies'];
        $user = User::create($input);
        $success['token'] = $token;
        $success['username'] =  $user->username;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secure_string' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $input['password'] = hash('sha256', $request['secure_string']);

        $dbuser = User::where('password', $input['password'])->first();

        if($dbuser) {
            $user = Auth::loginUsingId($dbuser->id);
            $token = Str::random(40);
            $success['token'] =  $token;
            $success['username'] =  $user->username;
            $user->update([
                'api_token' => $token,
                'updated_at' => now()
            ]);

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}