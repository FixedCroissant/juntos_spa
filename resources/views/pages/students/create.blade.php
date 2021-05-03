@extends('layouts.app', ['activePage' => 'studentList', 'titlePage' => __('Students')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create Student</h4>
                        <p class="card-category">
                            Please create a new student in the system. In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                        </p>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Student Contact Information</b>
                                {!! Form::open(array('route'=>'students.store')) !!}
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="firstName" class="col-form-label">First Name </label><span class="required">*</span>
                                            {!! Form::text('student_first_name',null,['class'=>'form-control','id'=>'firstName']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            <label for="lastName" class="col-form-label">Last Name</label><span class="required">*</span>
                                            {!! Form::text('student_last_name',null,['class'=>'form-control','id'=>'lastName']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="address" class="col-form-label">Address</label><span class="required">*</span>
                                            {!! Form::text('address_line_1',null,['class'=>'form-control','id'=>'address']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            <label for="city" class="col-form-label">City</label><span class="required">*</span>
                                            {!! Form::text('city',null,['class'=>'form-control','id'=>'city']) !!}
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="state" class="col-form-label">State</label><span class="required">*</span>
                                        {!! Form::select('state', $stateOptions, null, ['class'=>'form-control','placeholder' => 'Pick a state...']); !!}
                                    </div>

                                    <div class="col-md-3">
                                        <label for="zip" class="col-form-label">Zip</label>
                                        {!! Form::text('zip',null,['class'=>'form-control','id'=>'zip']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="studentID" class="col-form-label">StudentID</label><span class="required">*</span>
                                        {!! Form::text('student_id', null, ['class'=>'form-control','maxlength'=>'11']); !!}
                                    </div>
                                </div>

                                <!--New Fields-->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="grade" class="col-form-label">Grade</label><span class="required">*</span>
                                        {!! Form::select('grade', $gradeOptions, null, ['class'=>'form-control','placeholder' => 'Pick a grade...']); !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="active_student" class="col-form-label">Active in Juntos?</label><span class="required">*</span>
                                        {!! Form::select('active_student', ['Y'=>"Yes",'N'=>"No"], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dob" class="col-form-label">Date of Birth</label>
                                        {!! Form::text('dob', null, ['class'=>'form-control','id'=>'dob']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="emailaddress" class="col-form-label">E-Mail Address</label>
                                        {!! Form::text('email_address',null,['class'=>'form-control','id'=>'emailaddress']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phonenumber" class="col-form-label">Phone Number</label>
                                        {!! Form::text('phonenumber',null,['class'=>'form-control','id'=>'phonenumber','maxlength'=>'11']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                     &nbsp;
                                   </div>
                                </div>
                                <!--End New Fields-->



                                {!! Form::submit('Create New Student',array('class'=>'btn btn-sm btn-primary')) !!}


                                {!! Form::close() !!}

                            </div>
                            <div class="col-md-1">
                                <!-- Content -->
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                <b>Parent Information</b>
                                <p>
                                    Please add student information first. You will have the opportunity
                                    to add a new parent record afterwards.
                                </p>
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
        $('#dob').datepicker({
            showOtherMonths: true
        });

    </script>
@endpush
