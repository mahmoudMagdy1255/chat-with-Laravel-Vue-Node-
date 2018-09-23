@extends('admin.index')

@section('content')

		<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	{!! Form::open(['route' => ['users.update' , $user->id] , 'files' => true , 'method' => 'PUT']) !!}

            	<div class="form-group">
            		{!! Form::label('name', trans('admin.name') ) !!}
            		{!! Form::text('name', $user->name , ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('email', trans('admin.email') ) !!}
            		{!! Form::email('email', $user->email , ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('image', trans('admin.image') ) !!}
            		{!! Form::file('image', ['class' => 'form-control'] ) !!}
            	</div>
            	
                  <img src="{{ Storage::url( $user->image ) }}" alt="Logo" style="width: 50px; height: 50px">
              

            	<div class="form-group">
            		{!! Form::label('password', trans('admin.password') ) !!}
            		{!! Form::password('password', ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('confirm_password', trans('admin.confirm_password') ) !!}
            		{!! Form::password('confirm_password', ['class' => 'form-control'] ) !!}
            	</div>
            	{!! Form::submit( trans('admin.save') , ['class' => 'btn btn-primary']) !!}
            	{!! Form::close() !!}
            </div>
        </div>
@endsection