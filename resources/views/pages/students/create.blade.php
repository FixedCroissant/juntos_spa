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
                                    <div class="col-md-3">
                                        <label for="age" class="col-form-label">Age</label>
                                        {!! Form::selectRange('age', 1, 25,null,['class'=>'form-control','id'=>'age']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="academic_year" class="col-form-label">Academic Year</label>
                                        <br/>
                                        You will be able to set an academic year upon the creation of a new student record.
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
                                        <label for="phone_number" class="col-form-label">Phone Number</label>
                                        {!! Form::text('phone_number',null,['class'=>'form-control','id'=>'phone_number','maxlength'=>'11']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="county" class="col-form-label">County</label>
                                        {!! Form::text('county',null,['class'=>'form-control','id'=>'county','maxlength'=>'60']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="school_name" class="col-form-label">School Name</label>
                                        {!! Form::text('school_name',null,['class'=>'form-control','id'=>'school_name','maxlength'=>'60']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="site" name="site_id" class="col-form-label">Site Association</label><span class="required">*</span>
                                        <select class="form-control" name="site_id">
                                        <option value="" class="form-control">Please select a site:</option>
                                            @foreach($siteOption as $siteOptionsAvailable)
                                                <option value="{{$siteOptionsAvailable->id}}">{{$siteOptionsAvailable->site_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ethnicity" class="col-form-label">Ethnicity</label>
                                        {!! Form::select('ethnicity', ['White'=>"White",'Black or African American'=>"Black or African American",'American Indian'=>'American Indian','Asian'=>'Asian','Native Hawaiian or Other Pacific Islander'=>'Native Hawaiian or Other Pacific Islander'], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="pre_survey_completed" class="col-form-label">Pre Survey Complete?</label>
                                        {!! Form::select('pre_survey_completed', ['Y'=>"Yes",'N'=>"No"], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="post_survey_completed" class="col-form-label">Post Survey Complete?</label>
                                        {!! Form::select('post_survey_completed', ["Y"=>"Yes","N"=>"No"], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
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
