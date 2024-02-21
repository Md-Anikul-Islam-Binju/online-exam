@extends('user.app')
@section('user_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            @foreach($exams as $data)
                    @if(strtotime(date('Y-m-d')) > strtotime($data->exam_date))
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">{{$data->title}}</div>
                            <div style="padding: 0px 1rem;">Exam Duration: {{$data->exam_duration}}min</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">Exam Is Over</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">{{$data->title}}</div>
                            <div style="padding: 0px 1rem;">Exam Duration: {{$data->exam_duration}}min</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                @php
                                        $userId = Auth::id();
                                        $userExam = DB::table('user_exams')
                                         ->where('user_id', $userId)
                                        ->where('exam_id', $data->id)
                                        ->first();
                                @endphp
                                @if ($userExam)
                                    <a class="small text-white stretched-link">View Details</a>
                                @else
                                    <a class="small text-white stretched-link" href="{{route('apply.exam',$data->id)}}">Apply Exam</a>
                                @endif

                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
