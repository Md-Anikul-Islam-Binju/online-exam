<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $exam = Exam::with('category')->latest()->get();
        return view('admin.exam.index',compact('categories','exam'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255|unique:exams',
                'category_id' => 'required',
                'exam_date' => 'required',
                'exam_duration' => 'required',

            ]);

            // Create a new exam instance
            $exam = new Exam();
            $exam->category_id = $validatedData['category_id'];
            $exam->title = $validatedData['title'];
            $exam->exam_date = $validatedData['exam_date'];
            $exam->exam_duration = $validatedData['exam_duration'];

            // Save the exam
            $exam->save();

            // Pass the exam to the view
            return redirect()->route('exam')->with('success', 'Exam created successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return view('error', ['message' => 'Error storing exam: ' . $e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'category_id' => 'required',
                'exam_date' => 'required',
                'exam_duration' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $exam = Exam::findOrFail($id);
            $exam->title = $request->input('title');
            $exam->category_id = $request->input('category_id');
            $exam->exam_date = $request->input('exam_date');
            $exam->exam_duration = $request->input('exam_duration');
            $exam->status = $request->input('status');
            $exam->save();

            return redirect()->route('exam')->with('success', 'Exam updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $exam = Exam::findOrFail($id);
            $exam->delete();

            return redirect()->route('exam')->with('success', 'Exam deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('exam')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
