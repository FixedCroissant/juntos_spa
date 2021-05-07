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
                                           Below are all the assignments that currently exist in the system.
                                       </p>
                                   </div>
                               </div>

                               <div style="margin-top:50px;" class="row">
                                    <table class="table table-condesed">
                                        <thead>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Site Access
                                        </th>
                                        </thead>
                                        @foreach($users as $myUsers)
                                        <tr>
                                            <td>
                                                {{$myUsers->name}}
                                            </td>
                                            <td>
                                                {{$myUsers->email}}
                                            </td>
                                            <td>
                                                <ul>
                                                @foreach($myUsers->studentAccess as $studentAccess)
                                                    <li>
                                                        {{$studentAccess->site_name}} |

                                                        {!!  Form::open(array('route' => array('admin.settings.coordinator.removeaccess',$myUsers->id,$studentAccess->id),'style'=>'display:inline-block', 'method' => 'delete','style'=>'display:inline','onsubmit' => "return confirm('Are you sure you want to remove access?')",))  !!}
                                                        <button type="submit"  class="button-link btn btn-sm">Remove Access</button>
                                                        {!! Form::close()  !!}

                                                    </li>
                                                @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                               </div>
                            </div>
                            <a class='btn btn-primary' href="{{route('admin.settings.coordinator.assign')}}">Go Back</a>
                        </div>
                    </div>
                    <!--Tabs Content-->

                </div>
            </div>
        </div>
    </div>
@endsection
