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
            <div class="feeds-container">
                @include('frontFeeds')
            </div>
        @else
            <div class="alert alert-info">
                There are currently no feeds.
            </div>
    @endif
@endsection



