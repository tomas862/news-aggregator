<div class="col-md-8 feed-content">
    <table class="table table-hover table-bordered table-striped table-default table-condensed table-responsive">
        <thead>
        <tr>
            <th>News aggregator</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($feeds as $feed)
            <tr>
                <td>
                    <p>
                        {{ $feed->getTitle() }}
                    </p>
                </td>
                <td>
                    <a href="{{$feed->getLink()}}" class="btn btn-default" target="_blank">
                        Visit page
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $feeds->links() }}
    </div>
</div>