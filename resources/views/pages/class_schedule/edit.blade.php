@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Update a new Class</h4>
                        <p class="card-category">
                            Details for the current student's schedule is seen below:
                            <br/>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.edit',$student->id)}}">Student Edit</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('coaching.index')}}">Coaching List</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('schedule.show',[$schedule->id])}}">Schedule List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Class Schedule</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            &nbsp;
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr style="text-align: center">
                                            <th colspan="10">
                                                Update selected class for
                                                for the following
                                                Academic Year: {{$academicYearNotify->academic_year}}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Semester
                                            </th>
                                            <th>
                                                Period
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
                                        {!! Form::model($schedule, ['route' => ['schedule.update', $schedule->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                        <tr>
                                            <td>
                                                {!! Form::select('semester_number', ['1' => '1', '2' => '2'],null,['class'=>'form-control','placeholder' => 'Pick a semester...']); !!}
                                            </td>
                                            <td>
                                                {!! Form::select('period_id', ['1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'],null,['class'=>'form-control','placeholder' => 'Pick a period...']); !!}
                                            </td>
                                            <td>
                                                {!! Form::select('schedule_type', ['AB' => 'AB', 'Block' => 'Block'],null,['class'=>'form-control','placeholder' => 'Pick a schedule type...']); !!}
                                            </td>
                                            <td>
                                                {!! Form::select('grade', ['8' => '8', '9' => '9','10'=>'10','11'=>'11','12'=>'12'],null,['class'=>'form-control','placeholder' => 'Pick a grade...']); !!}
                                            </td>
                                            <td>
                                                {!! Form::text('class_name',null,['class'=>'form-control','maxlength'=>'100']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('teacher_name',null,['class'=>'form-control','maxlength'=>'150']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('room_number',null,['class'=>'form-control','maxlength'=>'150']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('notes_lunch_period',null,['class'=>'form-control','maxlength'=>'150']) !!}
                                            </td>
                                            <td>
                                                <input type="checkbox" name="monday" class="switch-input" value="1" {{ $schedule->monday ? 'checked="checked"' : '' }}/>Monday
                                                <br/>
                                                <input type="checkbox" name="tuesday" class="switch-input" value="1" {{ $schedule->tuesday ? 'checked="checked"' : '' }}/>Tuesday
                                                <br/>
                                                <input type="checkbox" name="wednesday" class="switch-input" value="1" {{ $schedule->wednesday ? 'checked="checked"' : '' }}/> Wednesday
                                                <br/>
                                                <input type="checkbox" name="thursday" class="switch-input" value="1" {{ $schedule->thursday ? 'checked="checked"' : '' }}/> Thursday
                                                <br/>
                                                <input type="checkbox" name="friday" class="switch-input" value="1" {{ $schedule->friday ? 'checked="checked"' : '' }}/> Friday
                                            </td>
                                            <td>
                                                {!! Form::number('academic_grade',$schedule->academic_grade,null,['class'=>'form-control']); !!}
                                            </td>
                                            <td>
                                                {!! Form::submit('Update Class',['class'=>'btn btn-sm btn-primary']) !!}
                                            </td>
                                        </tr>
                                        {!! Form::close() !!}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
