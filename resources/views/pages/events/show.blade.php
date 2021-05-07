@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Event Attendance</h4>
                        <p class="card-category">
                            Below are the list of attendees for the selected event and details of the event itself.
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">

                            <div class="row">
                                <div class="col-md-5 offset-1">
                                    <h4>Event Information</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Event Name</td>
                                            <td>{{$event->event_name}}</td>
                                        </tr>
                                        <tr>
                                        <td>Event Date Start</td>
                                        <td>{{$event->event_start_date->format('m/d/y')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Event Date End</td>
                                            <td>{{$event->event_end_date->format('m/d/y')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Hours</td>
                                            <td>{{$event->contact_hours}}</td>
                                        </tr>
                                        <tr>
                                            <td>Event Site Association</td>
                                            <td>Coming Soon</td>
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>{{$event->event_type}}</td>
                                        </tr>
                                        <tr>
                                            <td>City:</td>
                                            <td>{{$event->event_city}}</td>
                                        </tr>
                                        <tr>
                                            <td>State:</td>
                                            <td>{{$event->event_state}}</td>
                                        </tr>
                                        <tr>
                                            <td>Event Notes:</td>
                                            <td>{{$event->event_notes}}</td>
                                        </tr>
                                    </table>
                                    {!! link_to_route('event.index','Go Back') !!}
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col-md-5 offset-1">
                                    <h4>Student Attendance</h4>
                                    <table class="table">
                                        @foreach($event->attendance as $myStudentEventAttendance)
                                        <tr>
                                            <td>
                                                    {{$myStudentEventAttendance->student_first_name}} {{$myStudentEventAttendance->student_last_name}}
                                            </td>
                                            <td>
                                                Remove Attendance
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>
                                                Total Students:
                                            </td>
                                            <td>
                                                {{count($event->attendance)}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4>Parent Attendance</h4>
                                    <table class="table">
                                        @foreach($event->parentAttendance as $myParentsEventAttendance)
                                            <tr>
                                                <td>
                                                    {{$myParentsEventAttendance->student_first_name}} {{$myStudentEventAttendance->student_last_name}}
                                                </td>
                                                <td>
                                                    Remove Attendance
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>
                                                Total Parents:
                                            </td>
                                            <td>
                                                {{count($event->parentAttendance)}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-5 offset-1">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
