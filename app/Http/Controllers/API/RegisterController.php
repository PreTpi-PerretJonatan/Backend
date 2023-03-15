<?php 

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Validator;

class RegisterController extends BaseController
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
            'secure_string' => 'required',
            'policies' => 'nullable'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $dbuser = User::where('password', $request['secure_string'])->first();
        if($dbuser) $this->sendError('Already exists.', ['error'=>'This user already exsits']);

        $input = $request->all();
        $input['password'] = hash('sha256', $request['secure_string']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('FitFocus')->plainTextToken;
        $success['name'] =  $user->name;

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
            $success['token'] =  $user->createToken('FitFocus')->plainTextToken;
            $success['username'] =  $user->username;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}