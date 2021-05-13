@extends('layouts.app', ['activePage' => 'coachingList', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Coaching Appointments for {{$appointments->first()->student->student_first_name}}
                            {{$appointments->first()->student->student_last_name}}</h4>
                        <p class="card-category">
                            Below are the current appointments for your selected student.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('coaching.index')}}">Coaching All Student List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Coaching Student Appointment List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <p>
                                    Please see below for the success coaching appointments.
                                </p>


                            @foreach($appointments as $myAppointments)
                                <table class="table">
                                    <thead>
                                    <th class="th-sm">Appointment Created
                                    </th>
                                    <th class="th-sm">Appointment Date
                                       </th>
                                       <th class="th-sm">Follow Up Date
                                       </th>
                                        <th class="th-sm">Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$myAppointments->created_at->format("m/d/y")}}</td>
                                        <td>{{$myAppointments->appointment_date->format('m/d/y')}}</td>
                                        <td>
                                            @if(!$myAppointments->appointment_follow_up_date)
                                                No follow up appointment,  <a href="{{route('coaching.create.follow_up',[$myAppointments->id])}}">create one</a> ?
                                            @else
                                                {{$myAppointments->appointment_follow_up_date->format('m/d/y')}}
                                                <a href="{{route('coaching.edit.follow_up',[$myAppointments->id])}}">Edit/Review Follow Up Appointment</a>
                                            @endif
                                        </td>
                                        <td><a href="{{route('coaching.edit',[$myAppointments->id])}}">Edit Initial Appointment</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach


                                <br/>
                                <br/>
                                <a href="{{route('coaching.index')}}">Go back to list</a>

                                <!--End Table-->
                            </div><!--End Card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        //Page reload on back button.
        function readyFn( $ ) {
            window.onbeforeunload = function(e) {
              };
        }
        //Use above function.
        $( document ).ready( readyFn );

        $(document).ready(function (){
                var table = $('#dtBasicExample').DataTable({
                    'columnDefs': [
                        {
                            'targets': 0,
                            'checkboxes': {
                                'selectRow': false
                            }
                        }
                    ],
                    'select': {
                        'style': 'multi'
                    },
                    'order': [[1, 'asc']]
                });
            });
    </script>
@endpush
