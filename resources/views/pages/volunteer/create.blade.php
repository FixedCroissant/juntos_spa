@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create Volunteer</h4>
                        <p class="card-category">
                            Please create a new volunteer in the system. In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('volunteer.index')}}">Volunteer List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create New Volunteer</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Volunteer Contact Information</b>
                                {!! Form::open(array('route'=>'volunteer.store')) !!}
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="firstName" class="col-form-label">First Name </label><span class="required">*</span>
                                            {!! Form::text('volunteer_first_name',null,['class'=>'form-control','id'=>'firstName']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            <label for="lastName" class="col-form-label">Last Name</label><span class="required">*</span>
                                            {!! Form::text('volunteer_last_name',null,['class'=>'form-control','id'=>'lastName']) !!}
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
                                    <div class="col-md-6">
                                        <label for="county" class="col-form-label">County</label>
                                        {!! Form::text('county',null,['class'=>'form-control','id'=>'county','maxlength'=>'60']) !!}
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
                                     &nbsp;
                                   </div>
                                </div>
                                <!--End New Fields-->

                                {!! Form::submit('Create New Volunteer',array('class'=>'btn btn-sm btn-primary')) !!}


                                {!! Form::close() !!}

                            </div>
                            <div class="col-md-1">
                                <!-- Content -->
                                &nbsp;
                            </div>
                            <div class="col-md-5">

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
