@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create New Student Note</h4>
                        <p class="card-category">
                            Please create a note in the system for:
                            <h4>{{$student->student_first_name}} {{$student->student_last_name}}</h4>
                        In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.edit',$student->id)}}">Student Edit</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create New Student Note</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Student Note Information</b>
                                <form action="{{route('studentnotes.store')}}" method="post">
                                    {{ csrf_field() }}

                                <div class="row">
                                    &nbsp;
                                </div>
                                <div class="row">
                                    &nbsp;<div class="col-md-6">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 col-lg-11 col-xl-11">
                                        <input type="hidden" name="student_id" value="{{$student->id}}"/>
                                        <label for="studentNoteText" class="col-form-label">Note Text:</label><span class="required">*</span>
                                        <input type="text" name="student_note_text" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 col-lg-11 col-xl-11">
                                         &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 sol-md-8 col-lg-11 col-xl-11">
                                        <input type="submit"  class="btn btn-primary btn-sm" value="Create Note">
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-1">
                                <!-- Content -->
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                &nbsp;
                            </div>
                        </div>

                    </div><!--END CARD-->
                </div>
            </div>
        </div>
    </div>
@endsection
