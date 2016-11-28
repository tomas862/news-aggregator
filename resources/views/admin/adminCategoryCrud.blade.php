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
                    <a class="btn btn-default" href="{{ url('/addCategory') }}">
                        <i class="glyphicon glyphicon-plus"></i>&nbsp;Add category
                    </a>
                </div>
                <div class="clearfix">
                    &nbsp;
                </div>
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
            </div>
        </div>
    </div>
@endsection
