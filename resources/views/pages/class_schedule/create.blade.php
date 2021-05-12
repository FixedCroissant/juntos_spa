@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create new Class Schedule</h4>
                        <p class="card-category">
                            Create a new class for
                            <span style="font-weight:bold;">{{$student->student_first_name}}  {{$student->student_last_name}} </span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.edit',$student->id)}}">Student Edit</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('schedule.show',$student->id)}}">Student Schedule</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Class</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th colspan="10">
                                                    Add New Class for
                                                    for the following
                                                    Academic Year: {{$acad_year->academic_year}}

                                                    Required fields are marked with a  <span class="required">"*"</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Semester <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Period <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Schedule Type <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Grade <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Class <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Teacher <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Room <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Notes
                                                </th>
                                                <th>
                                                    Days
                                                </th>
                                                <th>
                                                    Final Grade <span class="required">*</span>
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {!! Form::open(array('route'=>'schedule.store')) !!}
                                            <tr>
                                                <td>
                                                    {!! Form::select('semester_number', ['1' => '1', '2' => '2'],null,['class'=>'form-control','placeholder' => 'Pick a semester...']); !!}
                                                </td>
                                                <td>
                                                    {!! Form::select('period_id', ['1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'],null,['class'=>'form-control','placeholder' => 'Pick a period...']); !!}
                                                </td>
                                                <td>
                                                    {!! Form::select('schedule_type', ['AB' => 'AB', 'Block' => 'Block'],null,['class'=>'form-control','placeholder' => 'Pick a schedule...']); !!}
                                                </td>
                                                <td>
                                                    {!! Form::select('grade', ['8' => '8', '9' => '9','10'=>'10','11'=>'11','12'=>'12'],null,['class'=>'form-control','placeholder' => 'Pick a grade...']); !!}
                                                </td>
                                                <td>
                                                    {!! Form::text('class_name',old('class_name'),null,['class'=>'form-control','maxlength'=>'100']) !!}
                                                </td>
                                                <td>
                                                    {!! Form::text('teacher_name',old('teacher_name'),null,['class'=>'form-control','maxlength'=>'150']) !!}
                                                </td>
                                                <td>
                                                    {!! Form::text('room_number',old('room_number'),null,['class'=>'form-control','maxlength'=>'150']) !!}
                                                </td>
                                                <td>
                                                    {!! Form::text('notes_lunch_period',old('notes_lunch_period'),null,['class'=>'form-control','maxlength'=>'150']) !!}

                                                </td>
                                                <td>
                                                    <input type="checkbox" name="monday" class="switch-input" value="1" />Monday
                                                    <br/>
                                                    <input type="checkbox" name="tuesday" class="switch-input" value="1" />Tuesday
                                                    <br/>
                                                    <input type="checkbox" name="wednesday" class="switch-input" value="1" /> Wednesday
                                                    <br/>
                                                    <input type="checkbox" name="thursday" class="switch-input" value="1" /> Thursday
                                                    <br/>
                                                    <input type="checkbox" name="friday" class="switch-input" value="1" /> Friday
                                                </td>
                                                <td>
                                                    {!! Form::number('academic_grade',old('academic_grade'),null,['class'=>'form-control','maxlength'=>'150','min'=>'1','max'=>'100','step'=>'1']) !!}
                                                </td>
                                                <td>
                                                    {!! Form::hidden('student_id',$student->id) !!}
                                                    {!! Form::hidden('acad_id',$acad_year->id) !!}
                                                    {!! Form::submit('Create New Class',['class'=>'btn btn-sm btn-primary']) !!}
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
