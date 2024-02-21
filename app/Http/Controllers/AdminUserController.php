<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\UserExam;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function home()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        if(auth()->user()->role == 1)
        {
            $totalUser = User::where('role', 2)->count();
            $totalExam = Exam::count();
            return view('admin.dashboard', compact('totalUser', 'totalExam'));
        }
        else if(auth()->user()->role == 2)
        {
            $exams=Exam::with('category')->where('status', 1)->get();
            return view('user.dashboard',compact('exams'));
        }
    }

    public function applyExam($id)
    {
        try {
            $userId = Auth::id();
            $checkUser = UserExam::where('user_id', $userId)
                ->where('exam_id', $id)
                ->get()
                ->first();

            if ($checkUser) {
                $arr = array('status' => 'false', 'message' => 'Already applied, see your exam section');
            } else {
                $exam_user = new UserExam();
                $exam_user->user_id = $userId;
                $exam_user->exam_id = $id;
                $exam_user->save();

                $arr = array('status' => 'true', 'message' => 'Applied successfully', 'reload' => url('/dashboard'));
            }
            return redirect($arr['reload'])->with($arr);
        } catch (Exception $e) {
            $arr = array('status' => 'false', 'message' => 'An error occurred');
        }
    }
}
