<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExamQue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ExamQueController extends Controller
{
    public function index($id)
    {
        $question = ExamQue::where('exam_id', $id)->get()->toArray();
        return view('admin.question.index',compact('question'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'option_1' => 'required',
                'option_2' => 'required',
                'option_3' => 'required',
                'option_4' => 'required',
                'option_5' => 'required',
                'option_6' => 'required',
                'ans' => 'required'
            ]);
            if($validator->fails()){
                $arr = array('status' => 'false', 'message' => $validator->errors()->all());
            } else {
                $que = new ExamQue();
                $que->exam_id = $request->exam_id;
                $que->question = $request->question;
                $ansOptions = ['option_1', 'option_2', 'option_3', 'option_4','option_5','option_6'];
                $ansKey = array_search($request->ans, $ansOptions);
                $que->ans = $request->{$ansOptions[$ansKey]};
                $que->options = json_encode([
                    'option1' => $request->option_1,
                    'option2' => $request->option_2,
                    'option3' => $request->option_3,
                    'option4' => $request->option_4,
                    'option5' => $request->option_5,
                    'option6' => $request->option_6,
                ]);
                $que->save();
                $arr = array(
                    'status' => 'true',
                    'message' => 'successfully added',
                    'reload' => route('exam.que.add', ['id' => $request->exam_id])
                );
            }
        } catch (Exception $e) {
            $arr = array('status' => 'false', 'message' => $e->getMessage());
        }
        if (empty($arr['reload'])) {
            return redirect()->route('exam.que.add', ['id' => $request->exam_id]);
        } else {
            return redirect($arr['reload'])->with($arr);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'option_1' => 'required',
                'option_2' => 'required',
                'option_3' => 'required',
                'option_4' => 'required',
                'option_5' => 'required',
                'option_6' => 'required',
                'ans' => 'required'
            ]);
            if ($validator->fails()) {
                $arr = array('status' => 'false', 'message' => $validator->errors()->all());
            } else {
                $que = ExamQue::findOrFail($id);
                $que->question = $request->question;
                $ansOptions = ['option_1', 'option_2', 'option_3', 'option_4', 'option_5', 'option_6'];
                $ansKey = array_search($request->ans, $ansOptions);
                $que->ans = $request->{$ansOptions[$ansKey]};
                $que->options = json_encode([
                    'option1' => $request->option_1,
                    'option2' => $request->option_2,
                    'option3' => $request->option_3,
                    'option4' => $request->option_4,
                    'option5' => $request->option_5,
                    'option6' => $request->option_6,
                ]);
                $que->save();
                $arr = array(
                    'status' => 'true',
                    'message' => 'Successfully updated',
                    'reload' => route('exam.que.add', ['id' => $que->exam_id])
                );
            }
        } catch (Exception $e) {
            $arr = array('status' => 'false', 'message' => $e->getMessage());
        }
        return redirect($arr['reload'])->with($arr);
    }

    public function destroy($id)
    {
        try {
            $question = ExamQue::find($id);
            if (!$question) {
                throw new Exception("Question not found.");
            }

            $question->delete();

            $arr = array(
                'status' => 'true',
                'message' => 'Question deleted successfully.',
                'reload' => route('exam.que.add', ['id' => $question->exam_id])
            );
        } catch (Exception $e) {
            $arr = array('status' => 'false', 'message' => $e->getMessage());
        }

        return Redirect::back()->with($arr);
    }
}
