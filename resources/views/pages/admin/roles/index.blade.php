@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area</h4>
                        <p class="card-category">
                            Below are some of the options available to you as an administrator.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col s10">

                            <div class="box-body">
                                <div id="app">
                                   Roles Index
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
