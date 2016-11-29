@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if (Session::has('success_message'))
                    <div class="alert alert-success">
                        {{ Session::get('success_message') }}
                    </div>
                @endif

                <div class="pull-right">
                    <a class="btn btn-default" href="{{ url('/addFeed') }}">
                        <i class="glyphicon glyphicon-plus"></i>&nbsp;Add feed
                    </a>
                </div>
                <div class="clearfix">
                    &nbsp;
                </div>
                <div class="clearfix">
                    &nbsp;
                </div>
                @if ($is_feed)
                    <table class="table table-hover">
                        <thead>
                        <tr>Feeds</tr>
                        <tr>
                            <td>Id</td>
                            <td>Link</td>
                            <td>Category</td>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-info">
                            There are currently no feeds.
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection
