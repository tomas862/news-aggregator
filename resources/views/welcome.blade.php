@extends('layouts.app')

@section('content')
    @if ($feeds)
        <table class="table table-hover table-bordered table-striped table-default table-condensed table-responsive">
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feeds as $feed)
                    <td>
                        <a href="{{$feed->getLink()}}">
                            {{ $feed->getTitle() }}
                        </a>
                    </td>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-info">
                There are currently no feeds.
            </div>
    @endif
@endsection



