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

class ExerciseController extends BaseController{

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'repetitions' => 'required',
            'path_to_cover_image' => 'required',
            'path_to_video' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $exercise = Exercise::create($input);
        return $this->sendResponse($exercise->toArray(), 'Exercise created successfully.');
    }

    public function showall(){
        $exercises = Exercise::all();

        if (is_null($exercises)) {
            return $this->sendError('No serie found.');
        }

        return $this->sendResponse($exercises->toArray(), 'Exercises retrieved successfully.');
    }
}