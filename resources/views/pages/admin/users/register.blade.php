@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
<div class="container" style="height: auto;">
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
                            <div class="row">
                                <div class="col-md-9 offset-1">
                                    <h4>Create New User</h4>
                                    &nbsp;Below you are able to create a new user in the Juntos database. <br/>
                                    <br/>
                                    After creating a user, please supply the appropriate role.
                                    <br/>
                                    Please provide a password that is a minimum of 8 characters.
                                    <br/>
                                    By default, the application will apply a Guest role.
                                </div>
                            </div>


                            <form class="form" method="POST" action="{{ route('admin.complete-registration') }}">
                                @csrf
                                <p class="card-description text-center"></p>
                                <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="form-group">
                                        <label for="name">Name:</label><span class="required">*</span>
                                        <input type="text" name="name" class="form-control" placeholder="johncstudent@ncsu.edu" value="{{ old('name') }}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email Address:</label><span class="required">*</span>
                                        <input type="email" name="email" class="form-control" placeholder="wolf@ncsu.edu" value="{{ old('email') }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('unityid') ? ' has-danger' : '' }} mt-3">
                                    <div class="form-group">
                                        <label for="unityid" class="col-form-label">UnityID:</label><span class="required">*</span>
                                        <input type="unityid" name="unityid" class="form-control" placeholder="juntos123" value="{{ old('unityid') }}" required>
                                    </div>
                                    @if ($errors->has('unityid'))
                                        <div id="email-error" class="error text-danger pl-3" for="unityid" style="display: block;">
                                            <strong>{{ $errors->first('unityid') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">Password:</label><span class="required">*</span>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password ..." required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                                    <div class="form-group">
                                        <label for="password_confirmation">Password (Confirm)</label><span class="required">*</span>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password..." required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>

                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary btn-link btn-sm">Create New Account</button>

                            |

                            <a class= "btn btn-primary btn-link btn-sm" href="{!! route('admin.backend.index') !!}">Go Back</a>
                        </div>
                    </div>
                    </form>


                </div>
            </div>
            <!--Tabs Content-->

        </div>
    </div>
</div>
</div>
@endsection
