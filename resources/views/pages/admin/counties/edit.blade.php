@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area/County Management</h4>
                        <p class="card-category">
                            Below are some of the options available to you as an administrator.
                        </p>

                    </div>
                    <div class="card">
                        <!--Start Nav tabs-->
                        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link"
                                    id="ex1-tab-1"
                                    data-mdb-toggle="tab"
                                    href="#ex1-tabs-1"
                                    role="tab"
                                    aria-controls="ex1-tabs-1"
                                    aria-selected="false"
                                >USERS</a
                                >
                            </li>
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link"
                                    id="ex1-tab-2"
                                    data-mdb-toggle="tab"
                                    href="#ex1-tabs-2"
                                    role="tab"
                                    aria-controls="ex1-tabs-2"
                                    aria-selected="false"
                                >ROLES</a
                                >
                            </li>
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link"
                                    id="ex1-tab-3"
                                    href="{{route('admin.states.index')}}"
                                    role="tab"
                                    aria-controls="ex1-tabs-3"
                                    aria-selected="true"
                                >STATES</a
                                >
                            </li>
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link active"
                                    id="ex1-tab-3"
                                    data-mdb-toggle="tab"
                                    href={{route('admin.counties.index')}}
                                        role="tab"
                                    aria-controls="ex1-tabs-4"
                                    aria-selected="false"
                                >COUNTIES</a
                                >
                            </li>
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link"
                                    id="ex1-tab-3"
                                    data-mdb-toggle="tab"
                                    href={{route('admin.sites.index')}}
                                        role="tab"
                                    aria-controls="ex1-tabs-5"
                                    aria-selected="false"
                                >SITES</a
                                >
                            </li>
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link"
                                    id="ex1-tab-3"
                                    data-mdb-toggle="tab"
                                    href={{route('admin.settings.index')}}
                                        role="tab"
                                    aria-controls="ex1-tabs-5"
                                    aria-selected="false"
                                >SETTINGS</a
                                >
                            </li>

                        </ul>
                        <!-- Tabs navs -->
                        <div class="card-body">
                            Below is your selected state:
                            <div class="col-xs-12 col-lg-5 col-sm-12">

                                            {!!   Form::model($county, ['route' => ['admin.counties.update', $county->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                            <div class="form-group">
                                                <label for="stateAbbreviation">Affiliated State</label>
                                                 <br/>
                                                {!! $county->State->state_name !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="countyName">County Name</label>
                                                {!! Form::text('county_name',null,['class'=>'form-control','id'=>'countyName']) !!}
                                            </div>

                                            {!! Form::submit('Update County',['class'=>'btn btn-primary']) !!}

                                            <a href="{{route('admin.counties.index')}}" class="btn btn-secondary">Cancel</a>

                                            {!! Form::close() !!}
                            </div>
                            </div>
                    </div>
                    <!--Tabs Content-->

                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>--}}

