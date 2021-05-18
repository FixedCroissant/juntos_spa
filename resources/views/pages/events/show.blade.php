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
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('event.index')}}">Event List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Event Details</li>
                                </ol>
                            </nav>
                        </div>
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
                                            <td>{{$eventSite->site_name}}</td>
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
                                                    <a href="{{route('students.removeAttendance',[$event->id,$myStudentEventAttendance->id])}}" class="btn btn-sm btn-primary">Remove Attendance</a>
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
                                                    {{$myParentsEventAttendance->parent_first_name}} {{$myParentsEventAttendance->parent_last_name}}
                                                </td>
                                                <td>
                                                    <a href="{{route('parents.removeAttendance',[$event->id,$myParentsEventAttendance->id])}}" class="btn btn-sm btn-primary">Remove Attendance</a>
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
                                    <h4>Volunteer Attendance</h4>
                                    <table class="table">
                                        @foreach($event->volunteerAttendance as $myVolunteerEventAttendance)
                                            <tr>
                                                <td>
                                                    {{$myVolunteerEventAttendance->volunteer_first_name}} {{$myVolunteerEventAttendance->volunteer_last_name}}
                                                </td>
                                                <td>
                                                    <a href="{{route('volunteer.removeAttendance',[$event->id,$myVolunteerEventAttendance->id])}}" class="btn btn-sm btn-primary">Remove Attendance</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>
                                                Total Volunteers:
                                            </td>
                                            <td>
                                                {{count($event->volunteerAttendance)}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4>Sibling/Family Member Attendance</h4>
                                    <table class="table">
                                        @foreach($siblingandguests as $eventSiblingAndGuestNumber)
                                            <tr>
                                                <td>
                                                    {!! Form::open(['route' => ['sibling.attendance.complete', $eventSiblingAndGuestNumber->event_id],'method'=>'post']) !!}
                                                    Total Siblings:
                                                    {!! Form::selectRange('sibling_number',0,50,$eventSiblingAndGuestNumber->sibling_number) !!}
                                                    <br/>
                                                    <br/>
                                                    {!! Form::submit('Update Sibling',array('class'=>'btn btn-sm btn-primary')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    Total Additional Family Members:
                                                    {!! Form::open(['route' => ['other_guest.attendance.complete', $eventSiblingAndGuestNumber->event_id],'method'=>'post']) !!}
                                                    {!! Form::selectRange('other_guests_number',0,50,$eventSiblingAndGuestNumber->other_guests_number) !!}
                                                    <br/>
                                                    <br/>
                                                    {!! Form::submit('Update Guests',array('class'=>'btn btn-sm btn-primary')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Total Siblings or Family Members:
                                                </td>
                                                <td>
                                                    {{$eventSiblingAndGuestNumber->totalOtherGuest}}
                                                </td>
                                            </tr>
                                        @endforeach
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
