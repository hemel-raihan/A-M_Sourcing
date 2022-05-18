@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')

                            {{-- <div class="single-post mb-0" style="width: 80%; margin-left:10%;"> --}}
                <div class="single-post mb-0" >
                    <div class="entry clearfix">
                        <div class="grid-filter-wrap">
                            <!-- Grid Filter
                            ============================================= -->
                            <ul class="grid-filter" data-container="#demo-gallery">

                                <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                                @foreach ($categories as $category)
                                <li><a href="#" data-filter=".{{$category->slug}}">{{$category->name}}</a></li>
                                @endforeach

                            </ul><!-- .grid-filter end -->
                        </div>

                        <div id="demo-gallery" class="masonry-thumbs grid-container grid-3" data-big="2" data-lightbox="gallery">
                            @foreach ($galleries as $gallery)
                            <a href="{{asset('uploads/gallery_photo/'.$gallery->image)}}" data-lightbox="gallery-item" class="grid-item {{$gallery->gallerycategory->slug}}"><img src="{{asset('uploads/gallery_photo/'.$gallery->image)}}" alt="Gallery Thumb 1"></a>
                            @endforeach
                        </div>
                    </div>
                </div>




@endsection()

@section('scripts')

@endsection
