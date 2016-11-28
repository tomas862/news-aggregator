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
                <div class="clearfix">
                    &nbsp;
                </div>
                @if ($is_category)
                        <table class="table table-hover table-bordered table-striped table-default table-condensed table-responsive">
                            <thead>
                            <tr>Categories</tr>
                            <tr>
                                <th class="col-md-2">Id</th>
                                <th class="col-md-8">Name</th>
                                <th class="col-md-2"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="col-md-2">{{ $category->id }}</td>
                                        <td class="col-md-2">{{ $category->name }}</td>
                                        <td class="col-md-2">
                                            <a class="btn btn-default" href="{{ url('/addFeed/'.$category->id) }}">
                                                <i class="glyphicon glyphicon-edit"></i>&nbsp;Edit
                                            </a>
                                            <a class="btn btn-danger">
                                                <i class="glyphicon glyphicon-remove"></i>&nbsp;Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            There are currently no categories.
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection
