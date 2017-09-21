@extends('layouts.layout')

@section('content')

    <div class="container">
        <form method="post" action="/">
            {{ csrf_field() }}
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Search Url</label>
                <input type="text" name="url" class="form-control" id="url" aria-describedby="urlHelp" placeholder="Url">
                <input type="hidden" name="searcher_ip" id="searcher_ip">
                <input type="hidden" name="country" id="country">
                <small id="urlHelp" class="form-text text-muted">Type url what you want know more about</small>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Url</th>
                <th>Logo</th>
                <th>Ip</th>
                <th>Country</th>
                <th>Searcher IP</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($searches as $search)
                <tr>
                    <td>{{ $search->siteInfo->url }}</td>
                    <td>
                        @if ($search->siteInfo->logo)
                            <img src="{{ $search->siteInfo->logo }}" height="20" width="20">
                        @endif
                    </td>
                    <td>{{ $search->siteInfo->ip }}</td>
                    <td>{{ $search->country }}</td>
                    <td>{{ $search->searcher_ip }}</td>
                </tr>
            @endforeach
            {{ $searches->links() }}
            </tbody>

        </table>
    </div>
@endsection

@section('footerscripts')
    <script>
        $.get("https://ipinfo.io", function(response) {
            $('#searcher_ip').val(response.ip)
            $('#country').val(response.country);
        }, "jsonp")
    </script>
@endsection