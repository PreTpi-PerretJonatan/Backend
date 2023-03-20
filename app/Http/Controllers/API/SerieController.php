<?php 

namespace App\Http\Controllers\API;

use App\Models\Serie;
use Hamcrest\Text\IsEqualIgnoringWhiteSpace;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Workout;
use Validator;
use Illuminate\Support\Facades\Auth;

class SerieController extends BaseController{

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'sets_number' => 'required',
            'time_between_sets' => 'required',
            'time_after_sets' => 'required',
            'exercise_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $serie = Serie::create($input);
        return $this->sendResponse($serie->toArray(), 'Serie created successfully.');
    }

    public function showall(){
        $series = Serie::all();

        if (is_null($series)) {
            return $this->sendError('No serie found.');
        }

        return $this->sendResponse($series->toArray(), 'Workout retrieved successfully.');
    }
}