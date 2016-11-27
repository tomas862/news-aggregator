@extends('layouts.app')
@section('content')
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add feed
            </div>
            {{ Form::open(['action' => 'Feed\AddFeedController@addFeedCategoryAction', 'class' => 'form-horizontal']) }}
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('feed_url', 'Enter feed url') }}
                        {{ Form::text('feed_url', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('category', 'Category') }}
                        {{ Form::text('category', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-left">
                    <a href="{{ url('/home') }}" class="btn btn-default">
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