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
                                    href={{route('admin.sites.index')}}
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
                                       <p>
                                           From this page you are able to assign coordinators to a particular site. These sites are based on the counties you have created earlier.
                                           <br/>
                                           Please first select the state, the the county, then select the "sites" that each coordinator should have access.
                                           <br/>
                                           Remember, this has an impact on the events, volunteers in the system. Only coordinators assigned to these areas will be able to access these specific areas.
                                           <br/>
                                           <br/>

                                           Assignment Area:
                                           {!! $assignmentArea !!}
                                           <br/>
                                           Current list of assignments can be found on the following page:
                                           ToDo -- Add Link
                                       </p>
                                   </div>
                               </div>
                                <div class="row">
                                   <div class="col-md-4">
                                            <h4>Step 1 - State</h4>
                                       {!! Form::open(['route' => 'admin.settings.coordinator.assign','method'=>'get']) !!}
                                       {!! Form::select('state_picked', $states, null, ['class'=>'form-control','placeholder' => 'Pick a state...']); !!}
                                       {!! Form::submit('Select State',['class'=>'btn btn-sm']) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="col-md-4">
                                            <h4>Step 2 - County</h4>
                                       {!! Form::open(['route' => 'admin.settings.coordinator.assign','method'=>'get']) !!}

                                       <select name='county_picked' class="form-control">
                                               @foreach($countyOptions as $theCountiesInState)
                                                   <option class="form-control" value="{!! $theCountiesInState->id !!}">{!! $theCountiesInState->county_name !!}</option>
                                               @endforeach
                                           </select>
                                       {!! Form::submit('Select County',['class'=>'btn btn-sm']) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="col-md-4">
                                            <h4>Step 3 - Site</h4>
                                       {!! Form::open(['route' => 'admin.settings.coordinator.assign','method'=>'get']) !!}

                                       <select name='site_picked' class="form-control">
                                           @foreach($siteOptions as $theSiteInCounty)
                                               <option class="form-control" value="{!! $theSiteInCounty->id !!}">{!! $theSiteInCounty->site_name !!}</option>
                                           @endforeach
                                       </select>
                                       {!! Form::submit('Select Site',['class'=>'btn btn-sm']) !!}
                                       {!! Form::close() !!}
                                   </div>
                               </div>
                               <div style="margin-top:50px;" class="row">
                                   <div class="col-md-6">
                                       <h4>Site Name:</h4>

                                       Assigning

                                       @if($assignmentDetails==NULL)
                                        No Site found, please narrow down search to progress.
                                       @else
                                           {!! $assignmentDetails->site_name !!}
                                       @endif
                                   </div>
                                   <div class="col-md-6">
                                        <h4>Step 4 - User List</h4>

                                       Assign the following user to the above site:
                                       <br/>
                                       <br/>
                                    @if($assignmentDetails==NULL)
                                           Narrow Down Site Please.
                                    @else
                                           {!! Form::open(['route' => 'admin.settings.coordinator.assign.confirm','method'=>'post']) !!}
                                           <div>
                                               @foreach($userList as $theUserList)
                                                   {!! Form::checkbox('assignmentUser', $theUserList->id); !!} {!! $theUserList->name !!}
                                               @endforeach
                                               {!! Form::hidden('assignmentSite',$assignmentDetails->id) !!}
                                           </div>
                                           {!! Form::submit('Assign Site to User',['class'=>'btn btn-sm']) !!}
                                           {!! Form::close() !!}
                                   @endif
                                   </div>


                               </div>
                            </div>
                        </div>
                    </div>
                    <!--Tabs Content-->

                </div>
            </div>
        </div>
    </div>
@endsection
