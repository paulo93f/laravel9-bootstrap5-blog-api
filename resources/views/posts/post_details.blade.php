@extends('layouts.app')


@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1 text-uppercase ">{{ $post['title'] }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted by {{ $post['user']['name'] }}</div>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-12">
                        <img class="img-fluid rounded"
                            src="https://picsum.photos/id/{{ $post['id'] }}/900/600?random={{ $post['id'] }}"
                            alt="..." />
                    </figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{{ $post['body'] }}</p>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment with nested comments-->
                            <div class="d-flex mb-4">
                                <!-- Parent comment-->
                                <div class="flex-shrink-0"><img class="rounded-circle"
                                        src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold text-uppercase mb-2">Author Details</div>
                                    <hr>
                                    @forelse($post['user'] as $index => $data)
                                        @if (!is_array($data))
                                            <p><span class='text-capitalize fw-bold'>{{ $index }}:</span>
                                                {{ $data }}</p>
                                        @else
                                            <p><span class='text-capitalize fw-bold mb'>{{ $index }}</span></p>
                                            @foreach ($data as $index2 => $data2)
                                                @if (!is_array($data2))
                                                    <p><span class='text-capitalize fw-bold'>{{ $index2 }}:</span>
                                                        {{ $data2 }}</p>
                                                @else
                                                    <p><span class='text-capitalize fw-bold'>{{ $index2 }}</span></p>
                                                    @foreach ($data2 as $index3 => $data3)
                                                        <p><span
                                                                class='text-capitalize fw-bold'>{{ $index3 }}:</span>
                                                            {{ $data3 }}</p>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @empty
                                        <p>No user data found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

@endsection
