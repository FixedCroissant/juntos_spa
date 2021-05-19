@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area</h4>
                        <p class="card-category">
                            Below are the options available to you as an administrator.
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
                                    href="{{route('admin.backend.rolesindex')}}"
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
                                    class="nav-link active"
                                    id="ex1-tab-3"
                                    data-mdb-toggle="tab"
                                    href={{route('admin.settings.index')}}
                                        role="tab"
                                    aria-controls="ex1-tabs-6"
                                    aria-selected="false"
                                >SETTINGS</a
                                >
                            </li>
                        </ul>
                        <!-- Tabs navs -->
                        <div class="card-body">

                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-2">
                               <div class="row">
                                   <div class="col-md-12">
                                      From here, you are able to change the front page text as needed and adjust the amount of days before
                                       a coordinator is notified of a appointment being late.
                                   </div>
                               </div>
                                {!!   Form::model($settings, ['route' => ['admin.settings.main.update', $settings->id],'class'=>'form-horizontal','method'=>'POST']) !!}
                                <div class="row">
                                   <div class="col-md-12">
                                    &nbsp;
                                   </div>
                               </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="front_page_text">Front Page Text:</label>
                                        {!! Form::textarea('front_page_text',null,['class'=>'form-control','id'=>'front_page_text','rows' => 2, 'cols' => 40]) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="coordinator_follow_up_meeting_past_due">Number of Days after initial coaching appointment to be alerted:</label>
                                        {!! Form::selectRange('coordinator_follow_up_meeting_past_due', 1, 30,null,['class'=>'form-control']); !!}
                                    </div>
                                </div>
                                {!! Form::submit('Update Settings',array('class'=>'btn btn-sm btn-primary')) !!}

                                {!! Form::close() !!}
                        </div>
                    </div>
                    <!--Tabs Content-->

                </div>
            </div>
        </div>
    </div>
@endsection
