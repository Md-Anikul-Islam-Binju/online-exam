@extends('admin.app')
@section('admin_content')
    <style>
        .modal_label_style label {
            font-weight: 600;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Exam Question</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New</button>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Question Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Exam Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($question as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data['question']}}</td>
                            <td>{{$data['ans']}}</td>
                            <td>{{$data['status']==1?"Active":"Inactive"}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data['id']}}">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data['id']}}">Delete</button>
                            </td>
                        </tr>


                        {{-- Edit Question Modal --}}
                        <div class="modal fade" id="editModal{{$data['id']}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$data['id']}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data['id']}}">Edit Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal_label_style">
                                        <form action="{{ route('exam.que.update', ['id' => $data['id']]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-12">
                                                <label for="edit-question" class="col-form-label">Enter Question:</label>
                                                <input type="text" name="question" class="form-control" id="edit-question" value="{{$data['question']}}">
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="edit-option1" class="col-form-label">Enter Option 1:</label>
                                                    @php
                                                        $options = json_decode($data['options'], true);
                                                    @endphp
                                                    <input type="text" name="option_1" class="form-control" id="edit-option1" value="{{ $options['option1'] }}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="edit-option2" class="col-form-label">Enter Option 2:</label>
                                                    <input type="text" name="option_2" class="form-control" id="edit-option2" value="{{ $options['option2'] }}">
                                                </div>

                                                <div class="col-6">
                                                    <label for="edit-option2" class="col-form-label">Enter Option 3:</label>
                                                    <input type="text" name="option_3" class="form-control" id="edit-option2" value="{{ $options['option3'] }}">
                                                </div>

                                                <div class="col-6">
                                                    <label for="edit-option2" class="col-form-label">Enter Option 4:</label>
                                                    <input type="text" name="option_4" class="form-control" id="edit-option2" value="{{ $options['option4'] }}">
                                                </div>

                                                <div class="col-6">
                                                    <label for="edit-option2" class="col-form-label">Enter Option 5:</label>
                                                    <input type="text" name="option_5" class="form-control" id="edit-option2" value="{{ $options['option5'] }}">
                                                </div>

                                                <div class="col-6">
                                                    <label for="edit-option2" class="col-form-label">Enter Option 6:</label>
                                                    <input type="text" name="option_6" class="form-control" id="edit-option2" value="{{ $options['option6'] }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-ans" class="col-form-label">Answer:</label>
                                                <select class="form-control" name="ans" id="edit-ans">
                                                    <option value="">Select correct option</option>
                                                    @php
                                                        $options = json_decode($data['options'], true);
                                                    @endphp
                                                    <option value="option_1" {{ $data['ans'] === $options['option1'] ? 'selected' : '' }}>Option 1</option>
                                                    <option value="option_2" {{ $data['ans'] === $options['option2'] ? 'selected' : '' }}>Option 2</option>
                                                    <option value="option_3" {{ $data['ans'] === $options['option3'] ? 'selected' : '' }}>Option 3</option>
                                                    <option value="option_4" {{ $data['ans'] === $options['option4'] ? 'selected' : '' }}>Option 4</option>
                                                    <option value="option_5" {{ $data['ans'] === $options['option5'] ? 'selected' : '' }}>Option 5</option>
                                                    <option value="option_6" {{ $data['ans'] === $options['option6'] ? 'selected' : '' }}>Option 6</option>
                                                </select>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{$data['id']}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data['id']}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$data['id']}}">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this question?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('exam.que.delete', ['id' => $data['id']]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{--Add New Question Modal--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exam Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal_label_style">
                    <form action="{{route('exam.que.store')}}" method="post">
                        @csrf
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Enter Question:</label>
                            <input type="hidden" name="exam_id" value="{{ Request::segment(3)}}">
                            <input type="text" name="question" class="form-control" id="recipient-name">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Enter Option 1:</label>
                                <input type="text" name="option_1" class="form-control" id="recipient-name">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Enter Option 2:</label>
                                <input type="text" name="option_2" class="form-control" id="recipient-name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Enter Option 3:</label>
                                <input type="text" name="option_3" class="form-control" id="recipient-name">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Enter Option 4:</label>
                                <input type="text" name="option_4" class="form-control" id="recipient-name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Enter Option 5:</label>
                                <input type="text" name="option_5" class="form-control" id="recipient-name">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Enter Option 6:</label>
                                <input type="text" name="option_6" class="form-control" id="recipient-name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-status" class="col-form-label">Answer:</label>
                            <select class="form-control" name="ans" id="edit-status">
                                <option value="">Select correct option</option>
                                <option value="option_1">option 1</option>
                                <option value="option_2">option 2</option>
                                <option value="option_3">option 3</option>
                                <option value="option_4">option 4</option>
                                <option value="option_5">option 5</option>
                                <option value="option_6">option 6</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



