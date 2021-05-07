@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create Event</h4>
                        <p class="card-category">
                            Please create a new event in the system. In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                        </p>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Event Information</b>
                                {!! Form::open(array('route'=>'event.store')) !!}
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="eventName" class="col-form-label">Event Name </label><span class="required">*</span>
                                            {!! Form::text('event_name',null,['class'=>'form-control','id'=>'eventName']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="event_type" class="col-form-label">Event Type</label><span class="required">*</span>
                                            {!! Form::select('event_type', ['4H Club'=>'4H Club','Field Trip'=>'Field Trip','Family Night'=>'Family Night','Civic Engagement'=>'Civic Engagement','Other'=>'Other'], null, ['class'=>'form-control','placeholder' => 'Select Type...']); !!}
                                        </div>
                                    </div>
                                   <div class="row">
                                       <div class="col-md-6">
                                           <label for="city" class="col-form-label">City</label><span class="required">*</span>
                                           {!! Form::text('event_city', null, ['class'=>'form-control']); !!}
                                       </div>
                                   </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="state" class="col-form-label">State</label><span class="required">*</span>
                                        {!! Form::select('event_state', $stateOptions, null, ['class'=>'form-control','placeholder' => 'Pick a state...']); !!}
                                    </div>

                                    <div class="col-md-5">
                                        <label for="zip" class="col-form-label">Zip</label>
                                        {!! Form::text('event_zip',null,['class'=>'form-control','id'=>'zip']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="eventNotes" class="col-form-label">Event Notes</label>
                                        {!! Form::text('event_notes',null,['class'=>'form-control','id'=>'eventNotes']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="eventDate" class="col-form-label">Event Date Begin</label>
                                        {!! Form::text('event_start_date',null,['class'=>'form-control','id'=>'eventStartDate']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="eventDate" class="col-form-label">Event Date End</label>
                                        {!! Form::text('event_end_date',null,['class'=>'form-control','id'=>'eventEndDate']) !!}
                                    </div>
                                </div>

                                {!! Form::submit('Create New Event',array('class'=>'btn btn-sm btn-primary')) !!}


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
        $('#eventStartDate').datepicker({
            showOtherMonths: true
        });
        $('#eventEndDate').datepicker({
            showOtherMonths: true
        });

    </script>
@endpush
