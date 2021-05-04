@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area/State Management</h4>
                        <p class="card-category">

                        </p>
                    </div>
                    <div class="card">
                        <!--Start Nav tabs-->
                        <ul class="nav nav-tabs mb-4" id="ex1" role="tablist">
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link"
                                    id="ex1-tab-1"
                                    data-mdb-toggle="tab"
                                    href="{{route('admin.backend.index')}}"
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
                                    href="{{route('admin.backend.index')}}"
                                    role="tab"
                                    aria-controls="ex1-tabs-2"
                                    aria-selected="false"
                                >ROLES</a
                                >
                            </li>
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link active"
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
                                    class="nav-link"
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
                                    id="ex1-tab-4"
                                    data-mdb-toggle="tab"
                                    href={{route('admin.sites.index')}}
                                        role="tab"
                                    aria-controls="ex1-tabs-5"
                                    aria-selected="false"
                                >SETTINGS</a
                                >
                            </li>
                        </ul>
                        <!-- Tabs navs -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6 offset-2">
                                    Please create a new state to be used.
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-2">
                                {!! Form::open(array('route'=>'admin.states.store')) !!}
                                <div class="form-group">
                                    <div class="row">
                                        {!! Form::label('state_abbreviation', 'State Abbreviation:')!!}
                                        {!! Form::text('state_abbreviation',Request::old('state_abbreviation'),array('class'=>'col-lg-6','maxlength'=>'2')) !!}
                                    </div>
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        {!! Form::label('state_name', 'State Name:')  !!}
                                        {!! Form::text('state_name',Request::old('state_name'),array('class'=>'col-lg-6','maxlength'=>'150')) !!}
                                    </div>
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="row">
                                        {!! Form::submit('Create State',array('class'=>'btn btn-primary')) !!}
                                    </div>
                                </div>
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
