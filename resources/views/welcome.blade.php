@extends('layouts.app')

@section('content')
    @if ($feeds)
        <table class="table table-hover table-bordered table-striped table-default table-condensed table-responsive">
            <thead>

            </thead>
            <tbody>

            </tbody>
        </table>
        @else
            <div class="alert alert-info">
                There are currently no feeds.
            </div>
    @endif
@endsection



