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
            {{ Form::open(['action' => 'Admin\FeedController@addFeedAction', 'class' => 'form-horizontal']) }}
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('feed_url', 'Enter feed url') }}
                        {{ Form::text('feed_url', ($feed_link) ? $feed_link : null, ['class' => 'form-control']) }}
                    </div>
                        <div class="form-group">
                            @if ($categories)
                                <div class="col-lg-6">
                                    {{ Form::label('categories', 'Categories') }}
                                    {{ Form::select('categories[]', $categories, null, ['id' => 'categories', 'multiple' => true, 'class' => 'form-control']) }}
                                </div>
                            @endif
                            @if ($selected_categories)
                                <div class="col-lg-6">
                                    {{ Form::label('current_categories', 'Current categories') }}
                                    {{ Form::select('current_categories[]', $selected_categories, null, ['id' => 'current_categories', 'multiple' => true, 'class' => 'form-control', 'disabled' => true]) }}
                                </div>
                            @endif
                        </div>

                    @if ($id_feed)
                        {{Form::text('id_feed', $id_feed, ['class' => 'hidden'])}}
                    @endif

                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-left">
                    <a href="{{ url('/feeds') }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-remove"></i>&nbsp;Cancel
                    </a>
                </div>
                <div class="pull-right">
                    {{ Form::submit('Submit and stay', ['class' => 'btn btn-default', 'name' => 'submit_and_stay_feed']) }}
                    {{ Form::submit('Submit', ['class' => 'btn btn-default', 'name' => 'submit_feed']) }}
                </div>
                <div class="clearfix">
                    &nbsp;
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection