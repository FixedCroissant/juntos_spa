@extends('layouts.app', ['activePage' => 'coachingList', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Coaching Appointments</h4>
                        <p class="card-category">
                            &nbsp;
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Coaching All Student List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <p>
                                    <br/>
                                    Please see below for the success coaching appointments created in the system.
                                    <br/><br/>
                                    Once student is selected for success coaching, they must be success coached for that entire academic year unless they drop out of programming.
                                    <br/>
                                    <br/>
                                    Students in Success Coaching must be met with 1 time per month throughout academic school year. <br/>
                                    <br/>
                                </p>
                                <a class="btn btn-primary" style="margin-bottom: 75px;" href="{{route('coaching.create')}}">Create Success Coaching Appointment</a>


                            @foreach($appointments as $myAppointments)
                                <table class="table">
                                    <h4>{{$myAppointments->student_full_name}}</h4>
                                    <thead>
                                       <th class="th-sm">Class Schedules
                                       </th>
                                       <th class="th-sm">Success Coaching Schedules
                                       </th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                          <a href="{{route('schedule.show',[$myAppointments->id])}}">See Student Schedules</a>
                                        </td>
                                        <td>
                                          <a href="{{route('coaching.seestudentallappointments',['studentID'=>$myAppointments->id])}}">See Coaching Appointments</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach



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
