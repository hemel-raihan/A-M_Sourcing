@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-8 bottommargin">
                    <div class="row col-mb-50">
                        <div class="body-position-2" style="margin-top: 20px;">
                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="fancy-title title-border">
                                    <h3>Search Result..</h3>
                                </div>

                                <div class="row posts-md col-mb-30">
                                    @foreach ($search_news as $post)
                                    <div class="entry col-sm-6 col-xl-4">
                                        <div class="grid-inner">
                                            {{-- <div class="entry-image">
                                                <a href="#"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                            </div> --}}
                                            <div class="entry-title title-xs nott">
                                                <h3><a href="{{route('page',$post->slug)}}">{{$post->title}}</a></h3>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-calendar3"></i> {{$post->created_at->diffForHumans()}}</li>
                                                    {{-- <li></i>@foreach ($post->categories as $category)
                                                        <a href="{{route('categories.all',$category->parent->slug)}}">
                                                        {{$category->parent->name}} </a>
                                                        @endforeach
                                                    </li> --}}
                                                </ul>
                                            </div>
                                            <div class="entry-content">
                                                <p>{!!Str::limit($post->body, 100)!!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- @include('frontend_theme.news_portal.front_layout.vertical.sidebar') --}}
            </div>
        </div>
    </div>
</section><!-- #content end -->


@endsection()

@section('scripts')

@endsection
