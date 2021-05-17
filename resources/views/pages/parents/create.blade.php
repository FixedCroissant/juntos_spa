@extends('layouts.app', ['activePage' => 'studentList', 'titlePage' => __('Parent Create')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create Parent/Guardian</h4>
                        <p class="card-category">
                            Creating for:
                            <h4>{{$student->student_first_name}} {{$student->student_last_name}}</h4>
                            Please create a new parent in the system. <br/>
                            In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                            <br/>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.edit',[$student->id])}}">Student Edit</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Parent</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Parent/Guardian Contact Information</b>
                                {!! Form::open(array('route'=>'parents.store')) !!}
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">

                                        {!! Form::hidden('student_id',$student->id) !!}
                                        <div class="col-md-3">
                                            <label for="firstName" class="col-form-label">First Name </label><span class="required">*</span>
                                            {!! Form::text('parent_first_name',null,['class'=>'form-control','id'=>'firstName']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            <label for="lastName" class="col-form-label">Last Name</label><span class="required">*</span>
                                            {!! Form::text('parent_last_name',null,['class'=>'form-control','id'=>'lastName']) !!}
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
                                <!--New Fields-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="phoneNumber" class="col-form-label">Phone Number</label><span class="required">*</span>
                                        {!! Form::text('phone_number',null,['class'=>'form-control','id'=>'phoneNumber']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="emailaddress" class="col-form-label">E-Mail Address</label>
                                        {!! Form::text('emailaddress',null,['class'=>'form-control','id'=>'emailaddress']) !!}
                                    </div>
                                </div>
                                <!--End New Fields-->
                                {!! Form::submit('Create New Parent',array('class'=>'btn btn-sm btn-primary')) !!}


                                {!! Form::close() !!}

                            </div>
                            <div class="col-md-1">
                                <!-- Content -->
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
