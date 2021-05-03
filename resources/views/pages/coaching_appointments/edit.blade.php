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
                                        <select name="student_id" class="form-control   ">
                                            @foreach($students as $myStudents)
                                                <option value="{{ $myStudents->id }}">{{ $myStudents->student_full_name}}</option>
                                            @endforeach
                                            {{$appointment->student_id}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="coachingAppointmentDate" class="col-form-label">Appointment Date:</label><span class="required">*</span>
                                        {!! Form::text('appointment_date',null,['class'=>'form-control','id'=>'coachingAppointmentDate']) !!}
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
    @push('js')
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <script>
            $('#coachingAppointmentDate').datepicker({
                showOtherMonths: true
            });
            $('#eventEndDate').datepicker({
                showOtherMonths: true
            });
            // $('#appointmentDuration').timepicker({ modal: true, mode: 'ampm',step: 15});

        </script>
    @endpush

@endpush
