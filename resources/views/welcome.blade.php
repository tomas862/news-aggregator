@extends('layouts.app')

@section('content')
    @if ($feeds_count)
        <div class="col-md-4">
            @if ($categories)
                <ul class="list-group">
                    @foreach($categories as $key => $name)
                        <button id="{{ $key }}" class="list-group-item category-list" data-loading-text="Loading...">
                            {{ $name }}
                        </button>
                    @endforeach
                </ul>
            @endif
        </div>
            <div class="feeds-container">
                @include('includes.frontFeeds')
            </div>
        @include('includes.modal')
        @else
            <div class="alert alert-info">
                There are currently no feeds.
            </div>
    @endif
@endsection



