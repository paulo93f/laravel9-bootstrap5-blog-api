@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($data as $post)
            <div class="card mt-2">
                <p>{{$post->body}}</p>
                <button type="button" class="btn btn-link">Continue reading...</button>
            </div>
            @endforeach

        </div>

        <div class="col-md-8 mt-4">
            <div class="text-center">
                {!! $data->appends(request()->query())->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection