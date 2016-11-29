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
                            <th class="col-md-2">Id</th>
                            <th class="col-md-6">Link</th>
                            <th class="col-md-6">Status</th>
                            <th class="col-md-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach($feeds as $feed)
                                    <tr>
                                       <td class="col-md-2">{{ $feed->id }}</td>
                                       <td class="col-md-6">{{ $feed->link }}</td>
                                       <td class="col-md-2">
                                           @if ($feed->active)
                                               <p class="bg-success text-center">
                                                   Commited
                                               </p>
                                               @else
                                               <p class="bg-info text-center">
                                                   Not commited
                                               </p>
                                           @endif
                                       </td>
                                       <td class="col-md-2">
                                           <a class="btn btn-danger" href="{{ url('/removeFeed/'.$feed->id) }}">
                                               <i class="glyphicon glyphicon-remove"></i>&nbsp;Remove
                                           </a>
                                       </td>
                                    </tr>
                                @endforeach
                                {{ $feeds->links() }}
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
