@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ url('/addFeed') }}">
                            <i class="glyphicon glyphicon-plus"></i>&nbsp;Add feed
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <i class="glyphicon glyphicon-list-alt"></i>&nbsp;Create categories
                        </a>
                    </li>
                </ul>
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
