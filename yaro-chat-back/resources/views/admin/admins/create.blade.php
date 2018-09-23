@extends('admin.index')

@section('content')

		<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	{!! Form::open(['route' => 'admins.store' , 'files' => true]) !!}

            	<div class="form-group">
            		{!! Form::label('name', trans('admin.name') ) !!}
            		{!! Form::text('name', old('name') , ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('email', trans('admin.email') ) !!}
            		{!! Form::email('email', old('email') , ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('image', trans('admin.image') ) !!}
            		{!! Form::file('image', ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('password', trans('admin.password') ) !!}
            		{!! Form::password('password', ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('confirm_password', trans('admin.confirm_password') ) !!}
            		{!! Form::password('confirm_password', ['class' => 'form-control'] ) !!}
            	</div>
            	{!! Form::submit( trans('admin.add') , ['class' => 'btn btn-primary']) !!}
            	{!! Form::close() !!}
            </div>
        </div>
@endsection