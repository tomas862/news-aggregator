@extends('layouts.app')

@section('content')
    @if ($feeds_count)
        <div class="col-md-4">
            @if ($categories)
                <ul class="list-group">
                    @foreach($categories as $key => $name)
                        <button id="{{ $key }}" class="list-group-item category-list">
                            {{ $name }}
                        </button>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-8">
            <table class="table table-hover table-bordered table-striped table-default table-condensed table-responsive">
                <thead>
                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($feeds as $feed)
                    <tr>
                        <td>
                            <a >
                                {{ $feed->getTitle() }}
                            </a>
                        </td>
                        <td>
                            <a href="{{$feed->getLink()}}" class="btn btn-default" target="_blank">
                                Visit page <i class="glyphicon glyphicon-arrow-right"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{ $feeds->links() }}
        </div>
        @else
            <div class="alert alert-info">
                There are currently no feeds.
            </div>
    @endif
@endsection



