@extends('layouts.app')
@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ $getPage->getImage() }}')">
        <div class="container">
            <h1 class="page-title">{{ $getPage->title }}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('blog') }}">Blog</a></li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="entry-container max-col-2" data-layout="fitRows">
                        @foreach($getBlog as $value)
                            <div class="entry-item col-sm-6">
                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="{{ url('blog/'.$value->slug) }}">
                                            <img style="height: 285px;" src="{{ $value->getImage() }}" alt="{{ $value->title }}">
                                        </a>
                                    </figure>

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">{{ date('M d, Y', strtotime($value->created_at)) }}</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">{{ $value->getCommentCount() }} Comments</a>
                                        </div>

                                        <h2 class="entry-title">
                                            <a href="{{ url('blog/'.$value->slug) }}">{{ $value->title }}</a>
                                        </h2>

                                        @if(!empty($value->getCategory))
                                            <div class="entry-cats">
                                                in <a href="{{ url('blog/category/'.$value->getCategory->slug) }}">{{ $value->getCategory->name }}</a>
                                            </div>
                                        @endif

                                        <div class="entry-content">
                                            <p>{{ $value->short_description }}</p>
                                            <a href="{{ url('blog/'.$value->slug) }}" class="read-more">Continue Reading</a>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    <div style="padding: 10px; float: right;">
                        {!! $getBlog->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>

                </div>

                <aside class="col-lg-3">
                    @include('blog._sidebar');
                </aside>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')

@endsection
