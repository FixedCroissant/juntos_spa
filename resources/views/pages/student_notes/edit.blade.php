@extends('layouts.app', ['activePage' => 'studentList', 'titlePage' => __('Students')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit Student Note</h4>
                        <p class="card-category">
                            Please edit a note in the system.
                            <span class="required">"*"</span>
                        </p>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Student Note Information</b>
                                {!!   Form::model($studentNote, ['route' => ['studentnotes.update', $studentNote->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                <div class="row">
                                    &nbsp;
                                </div>
                                <div class="row">
                                    &nbsp;<div class="col-md-6">
                                        Note Created at: {{$studentNote->created_at->format('m/d/y')}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 col-lg-11 col-xl-11">
                                        <label for="studentNoteText" class="col-form-label">Note Text</label><span class="required">*</span>
                                        {!! Form::text('student_note_text',null,['class'=>'form-control','id'=>'studentNoteText']) !!}
                                    </div>
                                </div>
                                {!! Form::submit('Update Note',array('class'=>'btn btn-sm btn-primary')) !!}
                                <br/>
                                <br/>
                                <a href="{{route('students.edit',[$studentNote->student_id])}}">Go Back to Student</a>

                                {!! Form::close() !!}
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
