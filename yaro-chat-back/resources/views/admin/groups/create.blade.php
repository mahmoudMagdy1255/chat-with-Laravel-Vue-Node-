@extends('admin.index')

@section('content')

		<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	{!! Form::open(['route' => 'groups.store' , 'files' => true]) !!}

            	<div class="form-group">
            		{!! Form::label('name', trans('admin.name') ) !!}
            		{!! Form::text('name', old('name') , ['class' => 'form-control'] ) !!}
            	</div>

            	<div class="form-group">
            		{!! Form::label('image', trans('admin.image') ) !!}
            		{!! Form::file('image', ['class' => 'form-control'] ) !!}
            	</div>
            	
            	{!! Form::submit( trans('admin.add') , ['class' => 'btn btn-primary']) !!}
            	{!! Form::close() !!}
            </div>
        </div>
@endsection