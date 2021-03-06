@extends('layouts.app')

@section('content')
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Artikel erstellen</h5>

                <a href="{{ route('items') }}" class="float-right">Zurück zu Artikel</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'store-items', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                {!! csrf_field() !!}

                <div class="form-group has-feedback row {{ $errors->has('item_name') ? ' has-error ' : '' }}">
                    {!! Form::label('item_name', 'Artikelname', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('item_name', NULL, array('id' => 'item_name', 'class' => 'form-control', 'placeholder' => 'Artikelname', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="item_name">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('item_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('item_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback row {{ $errors->has('item_price') ? ' has-error ' : '' }}">
                    {!! Form::label('item_price', 'Artikelpreis (Punkte)', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::number('item_price', NULL, array('id' => 'item_price', 'class' => 'form-control', 'placeholder' => 'Artikelpreis', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="item_price">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('item_price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('item_price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {!! Form::button('Artikel erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
