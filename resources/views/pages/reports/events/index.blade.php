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
                                    <table>
                                        <tr>
                                            <td>
                                                Filters:
                                            </td>
                                        </tr>
                                        <tr>
                                            {!! Form::open(['route' => 'reporting.events.admin.download', 'method' => 'get']) !!}
                                            <td>
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
                                            <td style="width:200px;">
                                                &nbsp;
                                            </td>
                                            <td>
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
