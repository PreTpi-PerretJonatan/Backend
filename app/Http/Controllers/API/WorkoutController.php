<?php 

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends BaseController{
    public function index(){
        $workouts = Workout::all();
        return $this->sendResponse($workouts->toArray(), 'Workouts retrieved successfully.');
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'approximate_duration' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $workout = Workout::create($input);
        return $this->sendResponse($workout->toArray(), 'Workout created successfully.');
    }

    public function show($id){
        $workout = Workout::find($id);

        if (is_null($workout)) {
            return $this->sendError('Workout not found.');
        }

        return $this->sendResponse($workout->toArray(), 'Workout retrieved successfully.');

    }

    public function update(Request $request, Workout $workout){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'approximate_duration' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $workout->name = $input['name'];
        $workout->approximate_duration = $input['approximate_duration'];
        $workout->save();

        return $this->sendResponse($workout->toArray(), 'Workout updated successfully.');
    }

    public function destroy(Workout $workout){
        $workout->delete();
        return $this->sendResponse($workout->toArray(), 'Workout deleted successfully.');
    }
}