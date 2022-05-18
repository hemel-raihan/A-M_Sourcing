@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')
@isset($custom_page)
@include('frontend_theme.corporate.front_layout.vertical.banner',['custom_page'=>$custom_page])
@endisset
@isset($servicc)
@include('frontend_theme.corporate.front_layout.vertical.banner',['servicc'=>$servicc])
@endisset
@isset($productt)
@include('frontend_theme.corporate.front_layout.vertical.banner',['productt'=>$productt])
@endisset
@isset($pricecategory)
@include('frontend_theme.corporate.front_layout.vertical.banner',['pricecategory'=>$pricecategory])
@endisset
@isset($blog)
@include('frontend_theme.corporate.front_layout.vertical.banner',['blog'=>$blog])
@endisset


                    @php
                    $page = \App\Models\Pagebuilder\Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
                    @endphp



                                @if ($page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-12">
                                @elseif(!$page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-9">
                                @elseif($page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-9">
                                @elseif(!$page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-6">
                                @endif

                                <div class="single-post mb-0" >

                                <div class="entry clearfix">


                                @isset($custom_page)
                                <div class="container-sm">
                                    {{-- <div class="entry-title">
                                        <h2>{{$custom_page->title}}</h2>
                                    </div> --}}
                                    </br>
                                    <div class="body_content">
                                        {!!$custom_page->body!!}
                                    </div>


                                    @if ($custom_page->files)

                                    <a class="button button-3d button-large" target="blank" href="{{ asset('uploads/pagefile/'.$custom_page->files) }}">
                                        <img src="{{ asset('frontend/images/pdf.png') }}" alt="001-converted (1)_compressed (1).pdf" class="file-icon" />
                                        Click here to View in new tab
                                    </a>

                                    @endif


                                    @if(!$custom_page->gallaryimage == null)

                                    <div class="masonry-thumbs grid-container grid-5" data-big="1" data-lightbox="gallery">
                                        @php
                                            $galaryimage = explode("|", $custom_page->gallaryimage);
                                        @endphp
                                        @foreach ($galaryimage as $key => $images)
                                        <a class="grid-item" href="{{asset('uploads/pagegallary_image/'.$images)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/pagegallary_image/'.$images)}}" alt="Gallery Thumb 1"></a>
                                        @endforeach
                                    </div>
                                    @endif

                                </div>
                                @endisset



                                @isset($blogposts)
                                <div class="container-sm">
                                    {{-- <div class="entry-title">
                                        <h2>{{$blog->name}}</h2>
                                    </div> --}}
                                    </br>
                                    <div id="posts" class="post-grid row grid-container gutter-40">
                                        @foreach ($blogposts as $post)
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner">
                                                <div class="entry-image">
                                                    <a href="{{route('blog.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Standard Post with Image"></a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="{{route('blog.details',$post->slug)}}">{{$post->title}}</a></h2>
                                                </div>
                                                <div class="entry-content">
                                                    <p>{!!Str::limit($post->desc, 70)!!}</p>
                                                    <a href="{{route('blog.details',$post->slug)}}" class="more-link">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endisset


                                @isset($prices)
                                </br>
                                </br>
                                <div class="container-sm">
                                    <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="true" data-autoplay="10000" data-items-xs="1" data-items-sm="1" data-items-md="3" data-items-xl="4">
                                        @foreach ($prices as $pricepost)
                                        <div class="portfolio-item">
                                            <div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-start">
                                                <div class="pricing-title">
                                                    {{-- <span class="text-danger">Most Popular</span> --}}
                                                    <h3>{{$pricepost->title}}</h3>
                                                </div>
                                                <div class="pricing-price">
                                                    <span class="price-unit">৳</span>{{$pricepost->price}}<span class="price-tenure">{{$pricepost->duration}}</span>
                                                </div>
                                                <div class="pricing-features">
                                                    {!!$pricepost->body!!}
                                                </div>
                                                <div class="pricing-action">
                                                    <a href="#" class="btn btn-danger btn-lg">Get Started</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endisset


                                @isset($servicc)
                                <div class="container-sm">
                                    <p>{!!$servicc->body!!}</p>
                                </div>
                                @endisset


                                @isset($productt)
                                <div class="container-sm">
                                    <div class="single-post mb-0">

                                        <!-- Single Post
                                        ============================================= -->
                                        <div class="entry clearfix">

                                            <!-- Entry Title
                                            ============================================= -->
                                            <div class="entry-title">
                                                <h2>{{$productt->title}}</h2>
                                            </div><!-- .entry-title end -->

                                            <!-- Entry Meta
                                            ============================================= -->
                                            <div class="entry-meta">
                                                <ul>
                                                    <li style="font-size: 30px; font-weight: bold; color: black;"> Price: {{$productt->unit_price}}৳</li>
                                                    <li><i class="icon-folder-open"></i>
                                                        @foreach ($productt->productcategories as $category)
                                                        <a href="#">{{$category->name}}</a>
                                                        @endforeach  </li>
                                                </ul>
                                            </div><!-- .entry-meta end -->

                                            <!-- Entry Content
                                            ============================================= -->
                                            <div class="entry-content mt-0">

                                                <!-- Entry Image
                                                ============================================= -->
                                                <div class="entry-image alignleft">
                                                    <a href="#"><img src="{{asset('uploads/productphoto/'.$productt->image)}}" alt="Blog Single"></a>
                                                </div><!-- .entry-image end -->

                                                <p>{!!$productt->desc!!}</p>

                                                <!-- Post Single - Content End -->

                                                <div class="clear"></div>

                                                <!-- Post Single - Share
                                                ============================================= -->
                                                <div class="si-share border-0 d-flex justify-content-between align-items-center">
                                                    <span>Share this Post:</span>
                                                    <div>
                                                        <a href="#" class="social-icon si-borderless si-facebook">
                                                            <i class="icon-facebook"></i>
                                                            <i class="icon-facebook"></i>
                                                        </a>
                                                        <a href="#" class="social-icon si-borderless si-twitter">
                                                            <i class="icon-twitter"></i>
                                                            <i class="icon-twitter"></i>
                                                        </a>
                                                        <a href="#" class="social-icon si-borderless si-pinterest">
                                                            <i class="icon-pinterest"></i>
                                                            <i class="icon-pinterest"></i>
                                                        </a>
                                                        <a href="#" class="social-icon si-borderless si-gplus">
                                                            <i class="icon-gplus"></i>
                                                            <i class="icon-gplus"></i>
                                                        </a>
                                                        <a href="#" class="social-icon si-borderless si-rss">
                                                            <i class="icon-rss"></i>
                                                            <i class="icon-rss"></i>
                                                        </a>
                                                        <a href="#" class="social-icon si-borderless si-email3">
                                                            <i class="icon-email3"></i>
                                                            <i class="icon-email3"></i>
                                                        </a>
                                                    </div>
                                                </div><!-- Post Single - Share End -->

                                            </div>
                                        </div><!-- .entry end -->

                                        @if ($productt->files)

                                        <a target="blank" href="{{ asset('uploads/productfiles/'.$productt->files) }}">
                                            <img src="{{ asset('frontend/images/pdf.png') }}" alt="001-converted (1)_compressed (1).pdf" class="file-icon" />
                                            Click here to View in new tab
                                        </a>
                                    </br>
                                        <div class="row justify-content-center">
                                            <iframe src="{{ asset('uploads/files/'.$blog->files) }}" width="50%" height="800">
                                                    This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('uploads/productfiles/'.$productt->files) }}">Download PDF</a>
                                            </iframe>
                                        </div>
                                        @endif



                                        @if(!$productt->gallaryimage == null)

                                        <div class="masonry-thumbs grid-container grid-5" data-big="1" data-lightbox="gallery">
                                            @php
                                                $galaryimage = explode("|", $productt->gallaryimage);
                                            @endphp
                                            @foreach ($galaryimage as $key => $images)
                                            <a class="grid-item" href="{{asset('uploads/productgallary_image/'.$images)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/productgallary_image/'.$images)}}" alt="Gallery Thumb 1"></a>
                                            @endforeach
                                        </div>
                                        @endif


                                    </div>
                                </div>
                                @endisset



                            </div>
                        </div>
                    </div>


@endsection

@section('scripts')

@endsection
