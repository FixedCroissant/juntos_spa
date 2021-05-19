@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Alumni </h4>
                        <p class="card-category">
                            Below are the list of students that have graduated and you can provide information on their current progress
                            after school. <br/>

                            Provide an update on what they have been up to after the Juntos program. <br/>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('alumni.index')}}">Alumni/Graduated List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Alumni Note</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    {!!   Form::model($alumni, ['route' => ['alumni.update', $alumni->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Student Selected for Note:
                                            <h4> {{$student->student_first_name}} {{$student->student_last_name}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="alumniNotes" class="col-form-label">Notes</label><span class="required">*</span>
                                            {!! Form::textarea('alumni_notes',null,['class'=>'form-control','id'=>'alumniNotes','rows' => 15, 'cols' => 50]) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 125px">
                                        <div class="col-md-12">
                                            {!! Form::submit('Update Alumni Note',array('class'=>'btn btn-sm btn-primary')) !!}
                                        </div>
                                    </div>

                                    {!! Form::close() !!}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
