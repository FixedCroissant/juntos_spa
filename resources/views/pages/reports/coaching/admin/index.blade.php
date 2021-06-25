@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Reports</h4>
                        <p class="card-category">
                            Below are the list of reports available.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('reporting.index')}}">Report List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Admin - Coaching Meets Reporting</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row report-adjustment">
                        <div class="card report-adjustment-card">
                            <h5>Admin - Success Coach Meeting Report</h5>
                            <div class="col-md-11 offset-1">
                                <table>
                                    <tr>
                                        <td>
                                            Filters:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="counties">Specific County for Student:</label>
                                            {!! Form::open(['route' => 'reporting.coaching.admin.download', 'method' => 'get']) !!}
                                            <select multiple="multiple" name="counties[]" id="counties">
                                                <option value="" selected>Please select county ...</option>
                                                @foreach($countyStudentInput as $myCountyStudentInput)
                                                    <option value="{!! $myCountyStudentInput->county !!}">{!! $myCountyStudentInput->county !!}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:250px;">
                                            &nbsp;
                                        </td>
                                        <td>
                                            <label for="site">Specific Site for Student:</label>
                                            <br/>
                                            <select name="site[]" id="site" multiple>
                                                <option value="" selected>Please select site ...</option>
                                                <br/>
                                                @foreach($sites as $mySites)
                                                    <option value="{!! $mySites->id !!}">{!! $mySites->site_name !!}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {!! Form::submit('Generate Excel Document with Filters',['class'=>'btn btn-sm']) !!}
                                        </td>
                                    </tr>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
