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
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <h5>Report Options</h5>

                            <ul>
                                <li><a href="{{route('reporting.show','students')}}">Get Students</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{route('reporting.show','volunteers')}}">Get Volunteers</a></li>
                            </ul>
                            @roles(['Admin'])
                            <ul>
                                <li><a href="{{route('reporting.show','post_survey_incomplete')}}">[ADMIN] Get Report of Post Survey Incomplete</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{route('reporting.events.allattendance.download')}}">[ADMIN] Get All Events (With Students,Parents & Other Guests)</a></li>
                            </ul>
                            @endroles

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
