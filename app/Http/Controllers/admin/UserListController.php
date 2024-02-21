<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function userList()
    {
        $users = User::where('role',2)->latest()->get();
        return view('admin.user.index',compact('users'));
    }

    public function destroy($id)
    {
        try {
            $users = User::findOrFail($id);
            $users->delete();

            return redirect()->route('user.list')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.list')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function userExamResultList()
    {
        $usersResult = ExamResult::with(['user','exam'])->latest()->get();
        return view('admin.user.result',compact('usersResult'));
    }


    public function userExamResultDestroy($id)
    {
        try {
            $users = ExamResult::findOrFail($id);
            $users->delete();

            return redirect()->route('user.exam.result.list')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.exam.result.list')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
