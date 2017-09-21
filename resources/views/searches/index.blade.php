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
            <small id="urlHelp" class="form-text text-muted">Type url what you want know more about</small>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>
@endsection