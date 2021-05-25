@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Students - Add to Event</h4>
                        <p class="card-category">
                            Please select an event for the following students to attend:
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    Selected students:
                                    <ul>
                                        @foreach($selectedStudents as $mySelectedStudents)
                                        <li>
                                            {{$mySelectedStudents->student_first_name}} {{$mySelectedStudents->student_last_name}}
                                        </li>
                                          @endforeach
                                    </ul>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    {!!   Form::open(['route' => ['students.completeAttendance'],'class'=>'form-horizontal','method'=>'POST']) !!}
                                    <select name="eventOptions" class="form-control">
                                    <option value="">Please select an event ...</option>
                                    @foreach($eventOptions as $myEventOptions)
                                    <option value="{{$myEventOptions->id}}">{{$myEventOptions->eventTimes}} -- {{$myEventOptions->event_name}}</option>
                                    @endforeach
                                    </select>
                                    {!! Form::hidden('students',$selectedStudents) !!}
                                    {!! Form::hidden('type','student') !!}
                                    {!! Form::submit('Add Student to Event Attendance',array('class'=>'btn btn-sm btn-primary')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1 ">
                                    <a href="{{route('students.index')}}">Go back.</a>
                                </div>
                            </div>




                            <!--End Table-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
