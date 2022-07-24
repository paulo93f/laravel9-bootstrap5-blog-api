@extends('layouts.app')

@section('content')
<style>
    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        pointer-events: auto;
        content: "";
        background-color: rgba(0, 0, 0, 0);
    }
</style>
<div class="container">
    <div class="row ">

        @foreach($data as $post)

        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mt-4">
            <div class="card">
                <img class="card-img" src="https://picsum.photos/id/{{$post['id']}}/900/600?random={{$post['id']}}" alt="Bologna">
                <div class="card-img-overlay">
                    <a href="#" class="btn btn-light btn-sm">Post #{{$post['id']}}</a>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$post['title']}}</h4>
                    <small class="text-muted cat">
                        <i class="far fa-clock text-info"></i> Writed by
                        <i class="fas fa-users text-info"></i> {{$post['user']['name']}}
                    </small>
                    <p class="card-text">{{$post['body']}}</p>
                    <a href="/posts/{{$post['id']}}" class="stretched-link"></a>
                </div>
                <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                    <!-- <div class="views">Oct 20, 12:45PM
                    </div>
                    <div class="stats">
                        <i class="far fa-eye"></i> 1347
                        <i class="far fa-comment"></i> 12
                    </div> -->

                </div>
            </div>
        </div>
        @endforeach



        <div class="col-md-12 mt-4">
            <div class="text-center">
                {!! $data->appends(request()->query())->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection