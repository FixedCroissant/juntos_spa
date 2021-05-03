s@extends('layouts.app', ['activePage' => 'adminIndex', 'titlePage' => __('')])
@section('content')
    <!--Breadcrumbs-->
    {{--    <nav aria-label="breadcrumb" role="navigation">--}}
    {{--        <ol class="breadcrumb">--}}
    {{--            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>--}}
    {{--            <li class="breadcrumb-item active" aria-current="page">Library</li>--}}
    {{--        </ol>--}}
    {{--        <a href="{{route('home')}}">Home</a>--}}
    {{--    </nav>--}}
    <!--End Breadcrumbs-->
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admin Area / State Management</h4>
                        <p class="card-category">
                            States that are set up are seen below.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col s10">
{{--                            @include('includes.partials.admin-tabs')--}}
                            <div class="box-body">
                                {!! Form::open(array('route'=>'admin.states.store')) !!}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="row">--}}
{{--                                        {!! Form::label('state_abbreviation', 'State Abbreviation:')  !!}--}}
{{--                                        {!! Form::text('state_abbreviation',Request::old('state_abbreviation'),array('class'=>'col-lg-6','maxlength'=>'2')) !!}--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            {!! Form::label('state_name', 'State Name:')  !!}--}}
{{--                                            {!! Form::text('state_name',Request::old('state_name'),array('class'=>'col-lg-6','maxlength'=>'150')) !!}--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            {!! Form::submit('Save State',array('class'=>'btn btn-primary')) !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                <div class="row">
                                    <div class="col-4">.col-4</div>
                                    <div class="col-4">.col-4</div>
                                    <div class="col-4">.col-4</div>
                                </div>

                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create State</button>
                                </form>


                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

