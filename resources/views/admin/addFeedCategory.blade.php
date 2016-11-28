@extends('layouts.app')
@section('content')
    <div class="col-lg-6 col-lg-offset-3">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}
                </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                Add feed
            </div>
            {{ Form::open(['action' => 'Admin\CategoryController@addFeedCategoryAction', 'class' => 'form-horizontal']) }}
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('category', 'Category name') }}
                        {{ Form::text('category',  ($category_name) ? $category_name : null, ['class' => 'form-control']) }}
                    </div>
                    @if ($id_category)
                        {{Form::text('id_category', Route::current()->getParameter('id'), ['class' => 'hidden'])}}
                    @endif
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-left">
                    <a href="{{ url('/categories') }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-remove"></i>&nbsp;Cancel
                    </a>
                </div>
                <div class="pull-right">
                    {{ Form::submit('Submit and stay', ['class' => 'btn btn-default', 'name' => 'submit_and_stay_category']) }}
                    {{ Form::submit('Submit', ['class' => 'btn btn-default', 'name' => 'submit_category']) }}
                </div>
                <div class="clearfix">
                    &nbsp;
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection