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
                                    <li class="breadcrumb-item active" aria-current="page">Volunteer Reporting</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <h5>Volunteer Report</h5>
                            <div class="col-md-12">
                                <table>
                                    <tr>
                                        <td>
                                            Filters:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="counties">Specific County</label>
                                            {!! Form::open(['route' => 'reporting.volunteers.download', 'method' => 'get']) !!}
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
                                            <label for="site">Specific Site</label>
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
                            <table>
                                <tr>
                                    <td width="25px;">
                                        <img src="{{asset('/images/excel-icon.png')}}" width="20" height="20"/>
                                    </td>
                                    <td>
                                        <a href="{{route('reporting.volunteers.download')}}">Volunteer List Export - Excel</a>
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
