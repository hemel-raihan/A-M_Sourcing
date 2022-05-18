@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/bn_IN/sdk.js#xfbml=1&version=v13.0" nonce="i6CXGYAJ"></script>

@isset($service)
@include('frontend_theme.corporate.front_layout.vertical.banner',['servicc'=>$service])
@endisset

            @if ($page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
            <div class="postcontent col-lg-12">
            @elseif(!$page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
            <div class="postcontent col-lg-9">
            @elseif($page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
            <div class="postcontent col-lg-9">
            @elseif(!$page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
            <div class="postcontent col-lg-6">
            @endif

                        @isset($portfolio)

                        <section id="page-title">

                            <div class="container clearfix">
                                <h1>{{$portfolio->title}}</h1>
                            </div>

                        </section>
                    </br>
                        <div class="container-sm">
                            <div class="row">
                                <div class="col-lg-8 portfolio-single-image">
                                    <a href="#"><img src="{{asset('uploads/portfoliophoto/'.$portfolio->image)}}" alt="Image"></a>
                                </div><!-- .portfolio-single-image end -->

                                <!-- Portfolio Single Content
                                ============================================= -->
                                <div class="col-lg-4 portfolio-single-content">

                                    <!-- Portfolio Single - Description
                                    ============================================= -->
                                    <div class="fancy-title title-bottom-border">
                                        <h2>Project Info:</h2>


                                    </div>
                                    <ul class="portfolio-meta bottommargin">
                                        <li><span><i class="icon-user"></i>Client:</span> {{$portfolio->client_name}}</li>
                                        <li><span><i class="icon-link"></i>Service:</span> {{$portfolio->service}}</li>
                                        <li><span><i class="icon-calendar3"></i>Start Date:</span> {{ $portfolio->start_date }}</li>
                                        <li><span><i class="icon-calendar3"></i>End Date:</span>{{ $portfolio->submission_date }}</li>
                                    </ul>

                                    <!-- Portfolio Single - Description End -->

                                    <div class="line"></div>



                                </div><!-- .portfolio-single-content end -->

                            </div>
                            <p>{!!$portfolio->body!!}</p>

                            <div class="line"></div>

                            @if(!$portfolio->gallaryimage == null)

                                <div class="masonry-thumbs grid-container grid-5" data-big="1" data-lightbox="gallery">
                                    @php
                                        $galaryimage = explode("|", $portfolio->gallaryimage);
                                    @endphp
                                    @foreach ($galaryimage as $key => $images)
                                    <a class="grid-item" href="{{asset('uploads/portfoliogallary_image/'.$images)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/portfoliogallary_image/'.$images)}}" alt="Gallery Thumb 1"></a>
                                    @endforeach
                                </div>
                                @endif
                        </div>


					<div class="divider divider-center"><i class="icon-circle"></i></div>

                    {{-- @isset($portfoliocategoryposts)
                        <h4>Related Projects:</h4>
					    <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
                        @foreach ($portfoliocategoryposts as $portfoliocategorypost)
                        @if ($portfoliocategorypost->id != $portfolio->id)
                        <div class="oc-item">
                            <div class="portfolio-item">
                                <div class="portfolio-image">
                                    <a href="{{route('portfolio.details',$portfoliocategorypost->id)}}">
                                        <img src="{{asset('uploads/portfoliophoto/'.$portfoliocategorypost->image)}}" alt="Open Imagination">
                                    </a>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                            <a href="{{asset('uploads/portfoliophoto/'.$portfoliocategorypost->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                            <a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                    </div>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{route('portfolio.details',$portfoliocategorypost->id)}}">{{$portfoliocategorypost->title}}</a></h3>
                                    <span>@foreach ($portfoliocategorypost->portfoliocategories as $category)
                                        <a href="#">{{$category->name}}</a>
                                    @endforeach</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                      </div>
                    @endisset --}}
                @endisset


                @isset($service)

                <div class="container-sm">


                    {{-- <div class="col-lg-8 portfolio-single-image"> --}}
                        {{-- <a href="#"><img src="{{asset('uploads/servicephoto/'.$service->image)}}" alt="Image"></a> --}}
                    {{-- </div><!-- .portfolio-single-image end --> --}}

                    {{-- <div class="col-lg-4 portfolio-single-content"> --}}

                    <p>{!!$service->body!!}</p>


                    <div class="line"></div>


                     @isset($servicecategoryposts)
                     <h4>Related Projects:</h4>
                     <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
                     @foreach ($servicecategoryposts as $servicecategorypost)
                     @if ($servicecategorypost->id != $service->id)
                     <div class="oc-item">
                         <div class="portfolio-item">
                             <div class="portfolio-image">
                                 <a href="{{route('service.details',$servicecategorypost->slug)}}">
                                     <img src="{{asset('uploads/servicephoto/'.$servicecategorypost->image)}}" alt="Open Imagination">
                                 </a>
                                 {{-- <div class="bg-overlay">
                                     <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                         <a href="{{asset('uploads/servicephoto/'.$servicecategorypost->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                         <a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                                     </div>
                                     <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                 </div> --}}
                             </div>
                             <div class="portfolio-desc">
                                 <h3><a href="{{route('service.details',$servicecategorypost->slug)}}">{{$servicecategorypost->title}}</a></h3>
                                 <span>@foreach ($servicecategorypost->servicecategories as $category)
                                     <a href="#">{{$category->name}}</a>
                                 @endforeach</span>
                             </div>
                         </div>
                     </div>
                     @endif
                     @endforeach
                     </div><!-- .portfolio-carousel end -->
                     @endisset

                </div>
                @endisset


                    @isset($blog)

                        <div class="single-post mb-0">
                            <div class="container-sm">
                                <div class="entry clearfix">

                                    <div class="entry-title">
                                        <h2>{{$blog->title}}</h2>
                                    </div>

                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                            <li><a href="#"><i class="icon-user"></i> {{$blog->admin->name}}</a></li>
                                            <li><i class="icon-folder-open"></i>
                                                @foreach ($blog->categories as $category)
                                                <a href="#">{{$category->name}}</a>,
                                                @endforeach  </li>
                                            <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li>
                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="entry-content mt-0">

                                        <div class="entry-image alignleft">
                                            <a href="#"><img src="{{asset('uploads/postphoto/'.$blog->image)}}" alt="Blog Single"></a>
                                        </div>

                                        <p>{!!$blog->body!!}</p>



                                        <div class="clear"></div>

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

                                @if ($blog->files)
                                <a target="blank" href="{{ asset('uploads/files/'.$blog->files) }}">
                                    <img src="{{ asset('frontend/images/pdf.png') }}" alt="001-converted (1)_compressed (1).pdf" class="file-icon" />
                                    Click here to View in new tab
                                </a>
                                </br>
                                <div class="row justify-content-center">
                                    <iframe src="{{ asset('uploads/files/'.$blog->files) }}" width="50%" height="800">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('uploads/files/'.$blog->files) }}">Download PDF</a>
                                    </iframe>
                                </div>
                                @endif



                                @if(!$blog->gallaryimage == null)

                                <div class="masonry-thumbs grid-container grid-5" data-big="1" data-lightbox="gallery">
                                    @php
                                        $galaryimage = explode("|", $blog->gallaryimage);
                                    @endphp
                                    @foreach ($galaryimage as $key => $images)
                                    <a class="grid-item" href="{{asset('uploads/gallary_image/'.$images)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/gallary_image/'.$images)}}" alt="Gallery Thumb 1"></a>
                                    @endforeach
                                </div>
                                @endif

                                <div class="fb-comments" data-href="{{Request::url()}}" data-width="" data-numposts="10"></div>

                                <div class="line"></div>

                                <h4>Related Posts:</h4>

                                <div class="related-posts row posts-md col-mb-30">
                                    @isset($blogcategoryposts)
                                    @foreach ($blogcategoryposts as $blogcategorypost)
                                    @if ($blogcategorypost->id != $blog->id)
                                    <div class="entry col-12 col-md-4">
                                        <div class="grid-inner row align-items-center gutter-20">
                                            <div class="col-4">
                                                <div class="entry-image">
                                                    <a href="{{route('blog.details',$blogcategorypost->slug)}}"><img src="{{asset('uploads/postphoto/'.$blogcategorypost->image)}}" alt="Blog Single"></a>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="entry-title title-xs">
                                                    <h3><a href="{{route('blog.details',$blogcategorypost->slug)}}">{{$blogcategorypost->title}}</a></h3>
                                                </div>
                                                {{-- <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($blogcategorypost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                                        <li><a href="#"><i class="icon-comments"></i> 12</a></li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endisset

                                </div>
                            </br>
                            </div>

                        </div>
                    </div>
                    </br

            @endisset



                @isset($content)

                        <div class="single-post mb-0">
                        <div class="container-sm">
                            <div class="entry clearfix">

                                <div class="entry-title">
                                    <h2>{{$content->title}}</h2>
                                </div>

                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($content->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                        <li><a href="#"><i class="icon-user"></i> {{$content->admin->name}}</a></li>
                                        <li><i class="icon-folder-open"></i> @foreach ($content->contentcategories as $category)
                                            <a href="#">{{$category->name}}</a>,
                                            @endforeach </li>
                                        <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li>
                                        <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                    </ul>
                                </div>

                                <div class="entry-content mt-0">

                                    <div class="entry-image alignleft">
                                        <a href="#"><img src="{{asset('uploads/contentpostphoto/'.$content->image)}}" alt="Blog Single"></a>
                                    </div>

                                    <p>{!!$content->body!!}</p>



                                    <div class="clear"></div>

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
                                    </div>

                                </div>
                            </div>

                            @if ($content->files)

                            <a target="blank" href="{{ asset('uploads/contentfiles/'.$content->files) }}">
                                <img src="{{ asset('frontend/images/pdf.png') }}" alt="001-converted (1)_compressed (1).pdf" class="file-icon" />
                                Click here to View in new tab
                            </a>
                          </br>
                            <div class="row justify-content-center">
                                <iframe src="{{ asset('uploads/contentfiles/'.$content->files) }}" width="50%" height="800">
                                        This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('uploads/contentfiles/'.$content->files) }}">Download PDF</a>
                                </iframe>
                            </div>
                            @endif



                            @if(!$content->gallaryimage == null)

                            <div class="masonry-thumbs grid-container grid-5" data-big="1" data-lightbox="gallery">
                                @php
                                    $galaryimage = explode("|", $content->gallaryimage);
                                @endphp
                                @foreach ($galaryimage as $key => $images)
                                <a class="grid-item" href="{{asset('uploads/contentgallary_image/'.$images)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/contentgallary_image/'.$images)}}" alt="Gallery Thumb 1"></a>
                                @endforeach
                            </div>
                            @endif


                            <div class="line"></div>

                            <h4>Related Posts:</h4>

                            <div class="related-posts row posts-md col-mb-30">
                                @isset($contentcategoryposts)
                                @foreach ($contentcategoryposts as $contentcategorypost)
                                @if ($contentcategorypost->id != $content->id)
                                <div class="entry col-12 col-md-6">
                                    <div class="grid-inner row align-items-center gutter-20">
                                        <div class="col-4">
                                            <div class="entry-image">
                                                <a href="#"><img src="{{asset('uploads/contentpostphoto/'.$contentcategorypost->image)}}" alt="Blog Single"></a>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="entry-title title-xs">
                                                <h3><a href="{{route('general.details',$contentcategorypost->id)}}">{{$contentcategorypost->title}}</a></h3>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($contentcategorypost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                                    <li><a href="#"><i class="icon-comments"></i> 12</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endisset

                            </div>
                        </div>
                        </div>

                    @endisset



                    @isset($job)

                            <div class="single-post mb-0">

                                <div class="container-sm">

                                    <div class="entry-title">
                                        <h2>{{$job->title}}</h2>
                                    </div>

                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i>Deadline: {{ \Carbon\Carbon::parse($job->application_deadline)->isoFormat('Do MMM YYYY')}}</li>
                                            <li><a href="#">Status:  {{$job->employement_status}}</a></li>
                                            <li><a href="#">Vacancy:  {{$job->vacancy}}</a></li>
                                            <li><i class="icon-folder-open"></i> <a href="#">{{$job->jobcategory->name}}</a> </li>
                                        </ul>
                                    </div>

                                    <div class="entry-content mt-0">


                                        <p>{!!$job->body!!}</p>



                                        <div class="clear"></div>

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
                                        </div>

                                    </div>
                                </div>

                            </div>


                    @endisset

            </div>


@endsection

@section('scripts')

@endsection
