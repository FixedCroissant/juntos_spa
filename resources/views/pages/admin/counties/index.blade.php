@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area/County Management</h4>
                        <p class="card-category">
                            Counties that can be set up can be seen below.
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
                        </ul>
                        <!-- Tabs navs -->
                        <div class="card-body">
                            Please select a county:
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-2">
                                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">State Name
                                        </th>
                                        <th class="th-sm">County Name
                                        </th>
                                        <th class="th-sm">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($counties as $mycounty)
                                        <tr>
                                            <td>
                                                {{$mycounty->state->state_name}}
                                            </td>
                                            <td>
                                                {{$mycounty->county_name}}
                                            </td>
                                            <td>
                                               {!! link_to_route('admin.counties.edit','Edit',$mycounty->id) !!}
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

