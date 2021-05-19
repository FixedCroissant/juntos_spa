@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area/Edit User</h4>
                        <p class="card-category">
                            Below you are able to edit a particular user.


                        </p>

                    </div>
                    <div class="card">
                        <!--Start Nav tabs-->
                        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                            <li class="#" role="presentation">
                                <a
                                    class="nav-link active"
                                    id="ex1-tab-1"
                                    data-mdb-toggle="tab"
                                    href={{route('admin.backend.index')}}
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
                                    class="nav-link"
                                    id="ex1-tab-3"
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
                            Below is your selected user:
                            <div class="col-xs-12 col-lg-5 col-sm-12">
                                {!!   Form::model($users, ['route' => ['admin.users.update', $users->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                <div class="form-group">
                                    <label for="stateAbbreviation">Account Created:</label>
                                    {!! $users->created_at->format('m/d/y') !!}
                                </div>
                                <div class="form-group">
                                    <label for="userName">Name</label>
                                    <br/>
                                    {!! Form::text('name',null,['class'=>'form-control','id'=>'userName']) !!}

                                </div>
                                <div class="form-group">
                                    <label for="emailAddress">E-Mail Address</label>
                                    {!! Form::text('email',null,['class'=>'form-control','id'=>'emailAddress','maxlength'=>'100']) !!}
                                </div>
                                <div class="form-group">
                                    <a href="{{route('profile.edit')}}" class="btn btn-sm btn-primary">Password Reset for User</a>
                                </div>

                                <div class="form-group">
                                    <label for="currentRoles">Associated Roles:</label>
                                    <br/>

                                    <!--Get all Roles-->

                                    @if(count($roles)>0)
                                        <table class="table table-condesed">
                                                    @foreach($roles as $therole)
                                                                <tr>
                                                                    <td>
                                                                        {!! $therole->name !!}
                                                                    </td>
                                                                    <td>
                                                                        <div class="onoffswitch">
                                                                        <input type="checkbox" value{{$therole->id}} name="assignees_roles[{{$therole->id}}]" {{in_array($therole->id,$userRoles->toArray()) ? 'checked="checked"':" "}}  class="toggleBtn onoffswitch-checkbox" id="role-{{$therole->id}}">
                                                                        <label for="role--{{$therole->id}}" class="onoffswitch-label">
                                                                            <div class="onoffswitch-inner"></div>
                                                                            <div class="onoffswitch-switch"></div>
                                                                        </label>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                    @endforeach
                                        </table>

                                        @else
                                        <p>
                                            No Roles to set.
                                        </p>
                                        @endif
                                </div>


                                </div>

                                {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}

                                <a href="{{route('admin.backend.index')}}" class="btn btn-secondary">Cancel</a>

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
