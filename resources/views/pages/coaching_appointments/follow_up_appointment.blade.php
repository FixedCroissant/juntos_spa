@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Coaching Appointments / Add Follow-Up Appointment</h4>
                        <p class="card-category">
                            &nbsp;
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('coaching.show',$student->id)}}">Coaching List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Coaching - Provide Follow Up</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <p>
                                    Follow Up Appointment for :
                                    <b>{{$student->student_first_name}} {{$student->student_last_name}}</b>

                                    <br/><br/>

                                    Please provide a follow up appointment to your original coaching appointment. <br/>
                                    In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                                </p>


                                {!! Form::open(['route' => ['coaching.create.follow_up_complete', $appointment->id]]) !!}
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="col-form-label">Appointment Follow Up Date:</label><span class="required">*</span>
                                        {!! Form::text('appointment_follow_up_date', null, ['id'=>'appointment_follow_up_date','class'=>'form-control']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="col-form-label">Appointment Follow Up Method of Contact</label><span class="required">*</span>
                                        {!! Form::select('appointment_follow_up_method_of_contact', ['phone'=>'Phone Call','Face-To-Face'=>'Face to Face'], null, ['class'=>'form-control','id'=>'methodOfContact','placeholder' => 'Select Contact Method...']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="col-form-label">Appointment Duration for Follow Up </label><span class="required">*</span>
                                        {!! Form::select('appointment_follow_up_duration',['0'=>'0 Minutes','15'=>'15 Minutes','30'=>'30 Minutes','45'=>'45 Minutes','60'=>'1 Hour'],null,['class'=>'form-control','id'=>'appointmentDuration']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="follow_up_notes" class="col-form-label">Follow Up Notes:</label><span class="required">*</span>
                                        {!! Form::text('follow_up_notes', null, ['id'=>'follow_up_notes','class'=>'form-control']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Outcomes:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="actionsMade" class="col-form-label">Actions Made:</label><span class="required">*</span>
                                        {!! Form::text('actions_made', null, ['id'=>'actionsMade','class'=>'form-control']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="results" class="col-form-label">Overall Results:</label><span class="required">*</span>
                                        {!! Form::text('results', null, ['id'=>'results','class'=>'form-control']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        {!! Form::submit('Save Follow Up Appointment',array('class'=>'btn btn-sm btn-primary')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        &nbsp;
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
@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
        $('#appointment_follow_up_date').datepicker({
            showOtherMonths: true
        });
    </script>
@endpush
