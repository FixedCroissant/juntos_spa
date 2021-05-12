@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create new Class Schedule for </h4>
                        <p class="card-category">
                            <h5>{{$student->student_first_name}} {{$student->student_last_name}}</h5>

                            Details for the current student's schedule is seen below:
                            <br/>
                            Feel free to add new classes to the year as needed.
                            <br/>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.edit',$student->id)}}">Student Edit</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('coaching.index')}}">Coaching List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Class Schedule</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 offset-3">
                                <p>If you need to add new schedules for different years,
                                please go to <a href="{{route('students.edit',[$student->id])}}">here</a> to add a new Academic Year for the selected student.
                                </p>
                            </div>
                        </div>
                        @foreach($schedule as $scheduleOptions)
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr style="text-align: center">
                                            <th colspan="11" class="table-dark">
                                                @if($scheduleOptions->current=="Y")
                                                 <h4>Current Academic Year</h4>
                                                @endif
                                                {{$scheduleOptions->academic_year}}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Semester
                                            </th>
                                            <th>
                                                Period #
                                            </th>
                                            <th>
                                                Schedule Type
                                            </th>
                                            <th>
                                                Grade
                                            </th>
                                            <th>
                                                Class
                                            </th>
                                            <th>
                                                Teacher
                                            </th>
                                            <th>
                                                Room
                                            </th>
                                            <th>
                                                Notes
                                            </th>
                                            <th>
                                                Days
                                            </th>
                                            <th>
                                                Final Grade
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($scheduleOptions->schedule as $theScheduleOption)
                                                @if($theScheduleOption->acad_id == $scheduleOptions->id)
                                                <tr>
                                                <td>
                                                    {!! $theScheduleOption->semester_number !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->period_id !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->schedule_type !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->grade !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->class_name !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->teacher_name !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->room_number !!}
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->notes_lunch_period !!}
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="monday" class="switch-input" value="1" {{ $theScheduleOption->monday ? 'checked="checked"' : '' }}/>Monday
                                                    <br/>
                                                    <input type="checkbox" name="tuesday" class="switch-input" value="1" {{ $theScheduleOption->tuesday ? 'checked="checked"' : '' }}/>Tuesday
                                                    <br/>
                                                    <input type="checkbox" name="wednesday" class="switch-input" value="1" {{ $theScheduleOption->wednesday ? 'checked="checked"' : '' }}/> Wednesday
                                                    <br/>
                                                    <input type="checkbox" name="thursday" class="switch-input" value="1" {{ $theScheduleOption->thursday ? 'checked="checked"' : '' }}/> Thursday
                                                    <br/>
                                                    <input type="checkbox" name="friday" class="switch-input" value="1" {{ $theScheduleOption->friday ? 'checked="checked"' : '' }}/> Friday
                                                </td>
                                                <td>
                                                    {!! $theScheduleOption->academic_grade !!}
                                                </td>
                                                <td>
                                                    <a href="{{route('schedule.edit',$theScheduleOption->id)}}" class="btn btn-sm btn-primary">EDIT CLASS</a>
                                                </td>
                                            </tr>
                                                @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="9">
                                                &nbsp;
                                            </td>
                                            <td colspan="2">
                                                <a href="{{route('schedule.create',['acad_year'=>$scheduleOptions->id,'student'=>$theScheduleOption->student_id])}}">Add New Class for {{$scheduleOptions->academic_year}}</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
