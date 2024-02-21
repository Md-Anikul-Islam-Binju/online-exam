<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamQue;
use App\Models\ExamResult;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserExamController extends Controller
{
    public function startExam()
    {
        $examInformation = UserExam::where('user_id', auth()->user()->id)->where('status', 1)->with('exam','user')->get();
        return view('user.exam.examList', compact('examInformation'));
    }

    public function startExamWithQuestion($exam_id)
    {
        $questions = ExamQue::where('exam_id', $exam_id)->get();
        $exam = Exam::where('id', $exam_id)->first();
        return view('user.exam.examQue', compact('questions', 'exam'));
    }

    public function submitExam(Request $request)
    {
        try {
            $correct_ans = 0;
            $wrong_ans = 0;
            $data = $request->all();
            $result = [];
            for ($i = 1; $i <= $request->index; $i++) {
                if (isset($data['question' . $i])) {
                    $q = ExamQue::where('id', $data['question' . $i])->first();
                    if ($q->ans == $data['ans' . $i]) {
                        $result[$data['question' . $i]] = 'YES';
                        $correct_ans++;
                    } else {
                        $result[$data['question' . $i]] = 'NO';
                        $wrong_ans++;
                    }
                }
            }
            $std_info = UserExam::where('user_id', auth()->user()->id)->where('exam_id', $request->exam_id)->first();
            $std_info->exam_join_status = 1;
            $std_info->update();

            $res = new ExamResult();
            $res->exam_id = $request->exam_id;
            $res->user_id = auth()->user()->id;
            $res->correct_ans = $correct_ans;
            $res->wrong_ans = $wrong_ans;
            $res->result_json = json_encode($result);
            $res->save();
            return redirect(url('/start-exam'));
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json(['error' => 'An error occurred. Please try again.']);
        }
    }

    public function examResult($exam_id)
    {
        $data['result_info'] = ExamResult::where('exam_id',$exam_id)->where('user_id',auth()->user()->id)->get()->first();
        $data['student_info'] = User::where('id',auth()->user()->id)->get()->first();
        $data['exam_info']=Exam::where('id',$exam_id)->get()->first();
        return view('user.exam.examResult',$data);
    }
}
