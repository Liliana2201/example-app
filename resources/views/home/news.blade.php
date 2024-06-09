@extends('layouts.layout')

@section('title', 'Новости')

@section('content')

<div class="content-side col-12">
    <div class="blog-posts-outer default-blog-section no-padd-bottom no-padd-top style-two">
        @foreach($news as $new)
        <!--Default Blog Post / Style One-->
        <article class="default-post-style blog-post style-one left-aligned">
            <div class="row clearfix">
                <div class="col-md-2 col-sm-12 col-xs-12 image-column">
                    <figure class="blog-image"><img style="width: 100%;" src="{{ $new->getImage() }}" alt=""></figure>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12 content-column padd-top-10">
                    <div class="default-content-box wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="default-post-title">
                            <h2 style="margin: 0 0 0 0;">{{$new->title_news}}</h2>
                        </div>
                        <div class="content-box">
                            <div class="default-post-info">
                                <h5 style="color: #7f7e7c9c;">Дата публикации: {{$new->getPostDate() }}</h5>

                            </div>
                            <div class="text margin-bott-30">
                                {{$new->description}}
                            </div>
                            @if($new->tags->count())

                            <h5 style="color: #89be5c;">Теги:
                                {{ $new->tags->pluck('name_tag')->implode(', ') }}
                            </h5>
                            @endif
                        </div>

                    </div>
                </div>
        </article>

        <hr>

        @endforeach
        {{ $news->links() }}
    </div>
</div>



@endsection