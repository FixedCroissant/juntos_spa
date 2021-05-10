@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Parents/Guardians - Add to Event</h4>
                        <p class="card-category">
                            Please select an event for the following students to attend:
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    Selected parents/guardians:
                                    <ul>
                                        @foreach($selectedParents as $mySelectedParents)
                                        <li>
                                            {{$mySelectedParents->parent_first_name}} {{$mySelectedParents->parent_last_name}}
                                        </li>
                                          @endforeach
                                    </ul>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    {!!   Form::open(['route' => ['parents.completeAttendance'],'class'=>'form-horizontal','method'=>'POST']) !!}
                                    {!! Form::select('eventOptions', $eventOptions, null, ['class'=>'form-control','placeholder' => 'Pick an event...']); !!}
                                    {!! Form::hidden('parents',$selectedParents) !!}
                                    {!! Form::submit('Add Parent to Event Attendance',array('class'=>'btn btn-sm btn-primary')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1 ">
                                    <a href="{{route('parents.index')}}">Go back.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
