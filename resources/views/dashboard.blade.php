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
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1" style="margin-bottom: 400px;">
                                {!! html_entity_decode($frontpagetext->front_page_text) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
