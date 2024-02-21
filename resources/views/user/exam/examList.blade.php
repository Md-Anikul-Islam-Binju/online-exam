@extends('user.app')
@section('user_content')
    <style>
        .modal_label_style label {
            font-weight: 600;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Exam Start</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Start Exam Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Exam Title</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($examInformation as $key=>$data)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->exam->title}}</td>
                            <td>{{$data->exam->exam_date}}</td>
                            <td>
                                @if(strtotime($data->exam->exam_date) < strtotime(date('Y-m-d')))
                                    <span class="badge bg-danger">Date expired</span>
                                @elseif($data->	exam_join_status == 1)
                                    <span class="badge bg-success">Finished</span>
                                @else
                                    <span class="badge bg-warning">Running</span>
                                @endif
                            </td>
                            <td>
                                @if(strtotime($data->exam->exam_date) < strtotime(date('Y-m-d')))
                                    <p style="color: red">Exam Is Over</p>
                                @else
                                    @if($data->	exam_join_status == 1)
                                        <a href="{{route('exam.result',$data->exam_id)}}" class="btn btn-sm btn-success">View Result</a>
                                    @else
                                    <a href="{{route('start.exam.with.question',$data->exam_id)}}" class="btn btn-sm btn-primary">Start Exam</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



