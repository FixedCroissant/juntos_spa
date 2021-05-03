<div class="container">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 offset-1">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="danger-padding">
                            {!! $error !!}
                        </li>
                    @endforeach
                    </ul>
                </div>
            @elseif (Session::get('flash_success'))
                <div class="alert alert-success">
                    @if(is_array(json_decode(Session::get('flash_success'),true)))
                        {!! implode('', Session::get('flash_success')->all(':message<br/>')) !!}
                    @else
                        {!! Session::get('flash_success') !!}
                    @endif
                </div>
            @elseif (Session::get('flash_warning'))
                <div class="alert alert-warning">
                    @if(is_array(json_decode(Session::get('flash_warning'),true)))
                        {!! implode('', Session::get('flash_warning')->all(':message<br/>')) !!}
                    @else
                        {!! Session::get('flash_warning') !!}
                    @endif
                </div>
            @elseif (Session::get('flash_info'))
                <div class="alert alert-info">
                    @if(is_array(json_decode(Session::get('flash_info'),true)))
                        {!! implode('', Session::get('flash_info')->all(':message<br/>')) !!}
                    @else
                        {!! Session::get('flash_info') !!}
                    @endif
                </div>
            @elseif (Session::get('flash_danger'))
                <div class="alert alert-danger">
                    @if(is_array(json_decode(Session::get('flash_danger'),true)))
                        {!! implode('', Session::get('flash_danger')->all(':message<br/>')) !!}
                    @else
                        {!! Session::get('flash_danger') !!}
                    @endif
                </div>
            @elseif (Session::get('flash_message'))
                <div class="alert alert-info">
                    @if(is_array(json_decode(Session::get('flash_message'),true)))
                        {!! implode('', Session::get('flash_message')->all(':message<br/>')) !!}
                    @else
                        {!! Session::get('flash_message') !!}
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
