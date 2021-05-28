@extends('layouts.app', ['activePage' => 'coachingList', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Coaching Appointments / Edit Appointment</h4>
                        <p class="card-category">
                            &nbsp;
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('coaching.index')}}">Coaching All Student List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Initial Coaching Appointment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <p>
                                    Please edit your exiting coaching appointment in the system. <br/>
                                    In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                                </p>
                                {!!   Form::model($appointment, ['route' => ['coaching.update', $appointment->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                <div class="row">
                                    &nbsp;
                                </div>
                                <div class="row">
                                    {!! Form::hidden('user_id', $user_id); !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Edit Initial Coaching Appointment</h4>
                                        <label for="studentName" class="col-form-label">Select Student:</label><span class="required">*</span>
                                        <br/>
                                        <select name="student_id" class="form-control" id="student_id">
                                            @foreach($students as $myStudents)
                                                <option value="{{ $myStudents->id }}">{{ $myStudents->student_full_name}}</option>
                                            @endforeach
                                            {{$appointment->student_id}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="studentAcademicYear" class="col-form-label">Select Academic Year:</label><span class="required">*</span>
                                        <br/>
                                        <select name="acad_year_id" id="acad_year_id" class="form-control">
                                            <option selected value="{{$appointment->acad_year_id}}">{{$appointment->acadYear->academic_year}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" id="pullAcademicYear" class="btn-primary btn">Pull Academic Year for Student</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="startGPA" class="col-form-label">Starting GPA:</label>
                                        {!! Form::text('start_gpa',null,['class'=>'form-control','id'=>'startGPA','maxlength'=>'4','placeholder'=>'2.75']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endGPA" class="col-form-label">Ending GPA:</label>
                                        {!! Form::text('end_gpa',null,['class'=>'form-control','id'=>'endGPA','maxlength'=>'4','placeholder'=>'3.0']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="coachingAppointmentDate" class="col-form-label">Appointment Date:</label><span class="required">*</span>
                                        <input type="text" name="appointment_date" id="coachingAppointmentDate" class="form-control" value="{{$appointment->appointment_date->format('m/d/Y')}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="appointmentDuration" class="col-form-label">Appointment Duration:</label><span class="required">*</span>
                                        <br/>
                                        {!! Form::select('appointment_duration',['0'=>'0 Minutes','15'=>'15 Minutes','30'=>'30 Minutes','45'=>'45 Minutes','60'=>'1 Hour'],null,['class'=>'form-control','id'=>'appointmentDuration']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="methodOfContact" class="col-form-label">Method of Contact:</label><span class="required">*</span>
                                        {!! Form::select('method_of_contact', ['phone'=>'Phone Call','Face-To-Face'=>'Face to Face'], null, ['class'=>'form-control','id'=>'methodOfContact','placeholder' => 'Select Contact Method...']); !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="educationalGoals" class="col-form-label">Educational Goals</label>
                                        {!! Form::text('EducationalGoals', null, ['id'=>'educationalGoals','class'=>'form-control']); !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="appointmentNotes" class="col-form-label">Appointment Notes:</label>
                                        {!! Form::text('appointmentNotes', null, ['id'=>'appointmentNotes','class'=>'form-control']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="actionsNeeded" class="col-form-label">Actions Needed:</label>
                                        {!! Form::text('actions_needed', null, ['id'=>'actionsNeeded','class'=>'form-control']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                       &nbsp;
                                    </div>
                                </div>
                                {!! Form::submit('Update Coaching Appointment',array('class'=>'btn btn-sm btn-primary')) !!}

                                <br/>
                                <br/>
                                <a href="{{route('coaching.seestudentallappointments',['studentID'=>$appointment->student_id])}}">Go back</a>

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
@push('js')
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <script>
            $('#coachingAppointmentDate').datepicker({
                showOtherMonths: true,
                format: 'mm/dd/yyyy',
                footer:true
            });
            $('#eventEndDate').datepicker({
                showOtherMonths: true
            });


            $(function() {
                let selectedStudent =$("#student_id :selected").val();

                $( "#student_id" ).on( "change", function() {

                    selectedStudent = $(this).val();

                    var $select = $('#acad_year_id');
                    $select.find('option').remove();
                    defaultItem = '<option value=\'\'>Please pull academic year...</option>';
                    $select.append(defaultItem);

                });

                $( "#pullAcademicYear" ).on( "click", function() {
                    let _token   = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: "../pull_acad_year",
                        type: "POST",
                        data: {
                            student_id: selectedStudent,
                            _token: _token
                        },
                        success: function (response) {

                            var $select = $('#acad_year_id');
                            $select.find('option').remove();
                            var listitems = '';
                            $.each(response.academic_year,function(index, value){
                                listitems += '<option value=' + value.id + '>' + value.academic_year + value.current+ '</option>';
                            });
                            $select.append(listitems);
                        },
                    });
                });
            });
        </script>
        </script>
@endpush
