@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Volunteer - Add to Event</h4>
                        <p class="card-category">
                            Please select an event for the following volunteers to attend:
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('volunteer.index')}}">Volunteer List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Volunteer Add to Attendance</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    Selected volunteers:
                                    <ul>
                                        @foreach($selectedVolunteers as $mySelectedVolunteers)
                                        <li>
                                            {{$mySelectedVolunteers->volunteer_first_name}} {{$mySelectedVolunteers->volunteer_last_name}}
                                        </li>
                                          @endforeach
                                    </ul>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                    {!!   Form::open(['route' => ['volunteer.completeAttendance'],'class'=>'form-horizontal','method'=>'POST']) !!}
                                    {!! Form::select('eventOptions', $eventOptions, null, ['class'=>'form-control','placeholder' => 'Pick an event...']); !!}
                                    {!! Form::hidden('volunteers',$selectedVolunteers) !!}
                                    {!! Form::submit('Add Volunteer to Event Attendance',array('class'=>'btn btn-sm btn-primary')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!--End Table-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
