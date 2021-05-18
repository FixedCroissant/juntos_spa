@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Dashboard</h4>
                        <p class="card-category">
                            &nbsp;
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Main Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            @if(Auth::check() && (Auth::user()->hasRole('Admin')|| Auth::user()->hasRole('Coordinator')))
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1" style="margin-bottom: 400px;">
                                    {!! html_entity_decode($frontpagetext->front_page_text) !!}
                                </div>
                            @endif
                            @roles(['Guest'])
                                <div class="col-xs-8 col-sm-8 col-lg-8 offset-1" style="margin-top: 45px; margin-bottom: 400px;">
                                    <p style="text-align:left; font-size:large;">
                                        Please contact the Juntos department about adjusting your account.
                                        <br/>
                                        <br/>
                                        Use the Logout Button to the left in order to log out from the application.
                                        <br/>
                                        <br/>
                                    </p>
                                </div>
                            @endroles
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
