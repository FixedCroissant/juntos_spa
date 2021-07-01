@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Reports</h4>
                        <p class="card-category">
                            Below are the list of reports available.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('reporting.index')}}">Report List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Event Reporting</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row report-adjustment">
                        <div class="card report-adjustment-card">
                            <h5>Event Report</h5>
                            <div class="row">
                                <div class="col-md-11 offset-1">
                                    <p>
                                        Please at a minimum provide a start date and a end date range to provide an accurate result. The date range will provide events past the start date but will cut off at the end date of your choice. <br/>
                                        <br/>
                                        For example: <br/>
                                        Picking a start date of 04/01/2019 and a end date of 05/31/2019, will provide all events between that specified range. <br/>
                                        <br/>
                                        Note: <br/>
                                        You will be provided with two sheets, one that provides you with a list of Events based on the conditions you specify below and a second Microsoft Excel sheet
                                        that provides you with the running attendance. <br/>
                                        Both sheets that are downloaded will be determined based on the criteria you provide below.
                                        <br/>
                                        <br/>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11 offset-1">
                                    <table>
                                        <tr>
                                            <td>
                                                Filters:
                                            </td>
                                        </tr>
                                        <tr>
                                            {!! Form::open(['route' => 'reporting.events.download', 'method' => 'get']) !!}
                                            <td style="padding-right:25px;">
                                                <label for="site">Specific Site</label>
                                                <br/>
                                                <select name="site[]" id="site" multiple>
                                                    <option value="" selected>Please select site ...</option>
                                                    <br/>
                                                    @foreach($sites as $mySites)
                                                        <option value="{!! $mySites->id !!}">{!! $mySites->site_name !!}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td >
                                                <label for="counties">Specific Event Type</label>
                                               <br/>
                                                <select multiple="multiple" name="event_type[]" id="event_type">
                                                    <option value="" selected>Please select event type option ...</option>
                                                    <option value="4H Club">4H Club</option>
                                                    <option value="Field Trip">Field Trip</option>
                                                    <option value="Family Night">Family Night</option>
                                                    <option value="Civic Engagement">Civic Engagement</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </td>
                                            <td style="padding-left:175px;">
                                                <label for="start_date">Start Event Date:</label><span class="required">*</span>
                                                <br/>
                                                <input type="date" name="start_date">
                                            </td>
                                            <td style="padding-left:200px;">
                                                <label for="end_date">End Event Date:</label><span class="required">*</span>
                                                <br/>
                                                <input type="date" name="end_date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                {!! Form::submit('Generate Excel Document with Filters',['class'=>'btn btn-sm']) !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
