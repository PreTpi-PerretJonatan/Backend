<?php 

namespace App\Http\Controllers\API;

use App\Models\Exercise;
use App\Models\Serie;
use Hamcrest\Text\IsEqualIgnoringWhiteSpace;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Workout;
use Validator;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends BaseController{

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'approximate_duration' => 'required',
            'cover_image_url' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $workout = Workout::create($input);
        return $this->sendResponse($workout->toArray(), 'Workout created successfully.');
    }

    public function showall(){
        $workouts = Workout::all();

        if (is_null($workouts)) {
            return $this->sendError('No workouts found.');
        }

        foreach($workouts as $workout){
            $series = $workout->series;
            foreach($series as $serie){
                $exercise = $serie->exercise;
                $serie->exercise = $exercise->toArray();
            }
            $workout->series = $series->toArray();
        }

        return $this->sendResponse($workouts->toArray(), 'Workouts retrieved successfully.');
    }
}