@extends('admin.index')

@section('content')

		<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	{!! Form::open(['route' => ['users.update' , $group->id] , 'files' => true , 'method' => 'PUT']) !!}

            	<div class="form-group">
            		{!! Form::label('name', trans('admin.name') ) !!}
            		{!! Form::text('name', $group->name , ['class' => 'form-control'] ) !!}
            	</div>


            	<div class="form-group">
            		{!! Form::label('image', trans('admin.image') ) !!}
            		{!! Form::file('image', ['class' => 'form-control'] ) !!}
            	</div>
            	
                  <img src="{{ Storage::url( $group->image ) }}" alt="Logo" style="width: 50px; height: 50px">
              
            	{!! Form::submit( trans('admin.save') , ['class' => 'btn btn-primary']) !!}
            	{!! Form::close() !!}
            </div>
        </div>
@endsection