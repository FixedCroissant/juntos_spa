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
                                <div class="col-md-5">
                                    <a href="{{route('admin.register')}}" class="btn btn-sm btn-primary">Create a New Account</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 offset-2">
                                    Please select a user:
                                </div>
                            </div>


                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-2">
                                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">User
                                        </th>
                                        <th class="th-sm">Email Address
                                        </th>
                                        <th class="th-sm">Role
                                        </th>
                                        <th class="th-sm">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $myuser)
                                        <tr>
                                            <td>
                                                {{$myuser->name}}
                                            </td>
                                            <td>
                                                {{$myuser->email}}
                                            </td>
                                            <td>
                                                <ul>
                                                @foreach($myuser->roles as $myUser)
                                                        <li>{{$myUser->name}}</li>
                                                @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                {!! link_to_route('admin.users.edit','Edit',$myuser->id) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--End Table-->
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
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>

