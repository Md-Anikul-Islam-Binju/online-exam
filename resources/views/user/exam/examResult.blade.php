@extends('user.app')
@section('user_content')
    <style>
        .modal_label_style label {
            font-weight: 600;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Exam Result</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h2>Student information</h2>
                                <table class="table">
                                    <tr>
                                        <td>Name : </td>
                                        <td>{{ $student_info->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : </td>
                                        <td>{{ $student_info->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : </td>
                                        <td>{{ $student_info->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Exam name : </td>
                                        <td>{{ $exam_info->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Exam date : </td>
                                        <td>{{ $exam_info->exam_date}}</td>
                                    </tr>
                                </table>
                                <h2>Result info</h2>
                                <table class="table">
                                    <tr>
                                        <td>Correct ans : </td>
                                        <td>{{ $result_info->correct_ans}}</td>
                                    </tr>
                                    <tr>
                                        <td>Wrong ans : </td>
                                        <td>{{ $result_info->wrong_ans}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total : </td>
                                        <td>{{ $result_info->correct_ans+$result_info->wrong_ans}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




