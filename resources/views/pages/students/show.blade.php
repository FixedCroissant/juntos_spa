@extends('layouts.app', ['activePage' => 'studentList', 'titlePage' => __('Students')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Student List</h4>
                        <p class="card-category">
                            Below are the list of students in the system.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            Get Details of Student.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
