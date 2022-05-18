@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection


@section('content')


        @if ($page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
        <div class="postcontent col-lg-12">
        @elseif(!$page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
        <div class="postcontent col-lg-9">
        @elseif($page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
        <div class="postcontent col-lg-9">
        @elseif(!$page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
        <div class="postcontent col-lg-6">
        @endif

        @foreach ($page->pagebuilders()->with('elements')->get() as $pagebuilder)
        @if ($pagebuilder->status == 1)
        <div class="{{($pagebuilder->container == 'container-sm') ? 'container-sm' : '' }} clearfix" style="background-color: {{$pagebuilder->background_color}};  background-image: url('{{asset('uploads/sectionpagephoto/'.$pagebuilder->background_img)}}');  border: {{$pagebuilder->border}} {{$pagebuilder->border_style}} {{$pagebuilder->border_color}};">

            @if ($pagebuilder->title_show == 1)
            <div style="padding-top:60px;" class="heading-block center">
                <h2 style="color: {{$pagebuilder->title_color}};">{{$pagebuilder->title}}</h2>
            </div>
            @endif


            <div class="row" style="margin-top: {{$pagebuilder->margin}};">
                @foreach ($pagebuilder->elements as $key => $element)
                @if ($pagebuilder->layout == 'One Column')
                <div class="col-md-12" style="margin-top: {{$element->margin_top}}; margin-bottom: {{$element->margin_bottom}};">
                @elseif ($pagebuilder->layout == 'Two Column')
                <div class="col-md-6" style="margin-top: {{$element->margin_top}}; margin-bottom: {{$element->margin_bottom}};">
                @elseif ($pagebuilder->layout == 'Three Column')
                <div class="col-md-4" style="border: 3px solid rgb(224, 224, 224); padding:10px; margin-top: 25px;">
                @elseif ($pagebuilder->layout == 'One/Two Column')
                <div class="col-md-{{ ($key%2 == 0) ? 4 : 8 }}">
                @elseif ($pagebuilder->layout == 'Two/One Column')
                <div class="col-md-{{ ($key%2 == 0) ? 8 : 4 }}">
                @elseif ($pagebuilder->layout == 'One/Two/One Column')
                <div class="col-md-{{ ($key%2 == 0) ? 3 : ((!$key%2 == 0) ? 6 : 3) }}">
                @endif

                {{-- <div class=""> --}}

                    {{-- <div class="row col-mb-50"> --}}
                        <div class="{{($element->container == 'container-sm') ? 'container-sm' : '' }}">

                        @if($element->module_type == 'Blog Post')
                        @php
                            $blogposts = App\Models\blog\Post::where([['status',1],['is_approved',1]])->latest()->take($element->post_qty)->get();
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif
                        @isset($blogposts)
                        <div class="row">
                        @foreach ($blogposts as $blogpost)
                        @if ($blogpost->status ==1)
                        @if ($blogpost->is_approved == 1)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                                <div class="grid-inner">
                                    @isset($blogpost->image)
                                    <div class="entry-image">
                                        <a href="{{route('blog.details',$blogpost->slug)}}" ><img src="{{asset('uploads/postphoto/'.$blogpost->image)}}" alt="Standard Post with Image"></a>
                                    </div>
                                    @endisset
                                    @isset($blogpost->youtube_link)
                                    <div class="entry-image">
                                    <p>&nbsp;<iframe frameborder="1"  height="400" src="{{$blogpost->youtube_link}}" width="720"></iframe></p>
                                    </div>
                                    @endisset
                                    <div class="entry-title">
                                        <h2><a href="{{route('blog.details',$blogpost->slug)}}">{{$blogpost->title}}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($blogpost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus.</p> --}}
                                        <p>{!!Str::limit($blogpost->desc, 70)!!}</p>
                                        <a href="{{route('blog.details',$blogpost->slug)}}" class="more-link">Read More</a>
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                        </div>
                        @endisset


                        @elseif ($element->module_type == 'Blog_Category_post')

                        @php
                            $category = App\Models\blog\category::with('posts')->find($element->category_id);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h4 style="color: {{$element->title_color}};">{{$element->title}}</h4>
                        </div>
                        @endif
                        @endif
                        @isset($category->posts)
                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-xl="{{($element->layout == 'One Column') ? 1 : (($element->layout == 'Two Column') ? 2 : (($element->layout == 'Three Column') ? 3 : 4)) }}">
                        @foreach ($category->posts as $post)
                        @if ($post->status == 1)
                        @if ($post->is_approved == 1)
                        <div class="portfolio-item">
                            <div class="portfolio-image" style="width: {{$element->portfolio_width}}%;">
                                <a href="portfolio-single.html">
                                    <img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Open Imagination">
                                </a>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                        <a href="{{asset('uploads/postphoto/'.$post->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                </div>
                            </div>
                            @if ($post->title_show != null)
                            <div class="portfolio-desc">
                                <h3><a href="#">{{$post->title}}</a></h3>
                            </div>
                            @endif
                        </div>
                        @endif
                        @endif
                        @endforeach
                        </div>
                        @endisset
                    </br>

                        @elseif($element->module_type == 'Blog Category')
                        @php
                            $blogcategories = App\Models\blog\category::all()->take($element->post_qty);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif
                        @isset($blogcategories)
                        <div class="row">
                        @foreach ($blogcategories as $blogcategory)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                                <div class="feature-box fbox-rounded fbox-effect">
                                    <div class="fbox-icon">
                                        <a href="{{route('blog.posts',$blogcategory->id)}}"><img src="{{asset('uploads/categoryphoto/'.$blogcategory->image)}}"></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>{{$blogcategory->name}}</h3>
                                        <p>{!!Str::limit($blogcategory->desc, 70)!!}</p>
                                    </div>
                                </div>
						</div>
                        @endforeach
                        </div>
                        @endisset


                        @elseif($element->module_type == 'Product Post')
                        @php
                            $productposts = App\Models\Product\Product::all()->take($element->post_qty);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif
                        @isset($productposts)
                        @php
                        $productcategories = \App\Models\Product\Productcategory::all();
                        @endphp
                        <div class="grid-filter-wrap">
                            <ul class="grid-filter" data-container="#portfolio">
                                <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                                @foreach ($productcategories as $category)
                                <li><a href="#" data-filter=".{{$category->id}}" >{{$category->name}}</a></li>
                                @endforeach
                            <div class="grid-shuffle rounded" data-container="#portfolio">
                                <i class="icon-random"></i>
                            </div>
                        </div>


                        <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">
                        @foreach ($productposts as $productpost)
                        @if ($productpost->status == 1)
                        @foreach ($productpost->productcategories as $category)
                        <article class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }} {{$category->id}}">
                            <div class="grid-inner">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img src="{{asset('uploads/productphoto/'.$productpost->image)}}" alt="Open Imagination">
                                    </a>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                            <a href="{{asset('uploads/productphoto/'.$productpost->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                    </div>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="portfolio-single.html">{{$productpost->title}}</a></h3>
                                    <span><a href="#">Media</a>, <a href="#">Icons</a></span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                        @endif
                        @endforeach
                        </div>
                        @endisset


                        @elseif ($element->module_type == 'Product_Category_post')

                        @php
                            $category = App\Models\Product\Productcategory::with('products')->find($element->product_category_id);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h4 style="color: {{$element->title_color}};">{{$element->title}}</h4>
                        </div>
                        @endif
                        @endif
                        @isset($category->products)
                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-xl="{{($element->layout == 'One Column') ? 1 : (($element->layout == 'Two Column') ? 2 : (($element->layout == 'Three Column') ? 3 : 4)) }}">
                        @foreach ($category->products as $post)
                        @if ($post->status == 1)

                        {{-- <div class="posts-sm row col-mb-30" id="post-list-sidebar" >
                            <div class="entry col-12"  >
                                <div class="grid-inner row g-0" >

                                    <div class="col-auto">
                                        <div class="entry-image">
                                            <a href="{{route('blog.details',$post->slug)}}"><img src="{{asset('uploads/productphoto/'.$post->image)}}" alt="Image"></a>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="entry-title">
                                            <h4><a href="{{route('blog.details',$post->slug)}}">{{$post->title}}</a></h4>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li>{{ \Carbon\Carbon::parse($post->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> --}}

                        <div class="portfolio-item">
                            <div class="portfolio-image" style="width: {{$element->portfolio_width}}%;">
                                <a href="portfolio-single.html">
                                    <img src="{{asset('uploads/productphoto/'.$post->image)}}" alt="Open Imagination">
                                </a>
                                <div class="bg-overlay">

                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                </div>
                            </div>
                            {{-- @if ($post->title_show != null) --}}
                            <div class="portfolio-desc" style="text-align: center;">
                                <h3><a href="#">{{$post->title}}</a></h3>
                                <p>{{$post->unit_price}}</p>

                            </div>
                            {{-- @endif --}}
                        </div>


                        @endif
                        @endforeach
                        </div>
                        @endisset
                    </br>


                        @elseif ($element->module_type == 'General Post')
                        @php
                            $generalposts = App\Models\general_content\Contentpost::all()->take($element->post_qty);
                        @endphp

                        @isset($generalposts)
                        <div class="row">
                        @foreach ($generalposts as $generalpost)
                        @if ($generalpost->status == 1)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                            {{-- <div class="entry col-sm-6 col-12"> --}}
                                <div class="grid-inner">
                                    @isset($blogpost->image)
                                    <div class="entry-image">
                                        <a href="#" data-lightbox="image"><img src="{{asset('uploads/contentpostphoto/'.$generalpost->image)}}" alt="Standard Post with Image"></a>
                                    </div>
                                    @endisset
                                    @isset($blogpost->youtube_link)
                                    <div class="entry-image">
                                    <p>&nbsp;<iframe frameborder="1"  height="400" src="{{$generalpost->youtube_link}}" width="720"></iframe></p>
                                    </div>
                                    @endisset
                                    <div class="entry-title">
                                        <h2><a href="{{route('general.details',$generalpost->id)}}">{{$generalpost->title}}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($generalpost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus.</p>
                                        <a href="{{route('general.details',$generalpost->id)}}" class="more-link">Read More</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                        @endif
                        @endforeach
                        </div>
                        @endisset

                        @elseif($element->module_type == 'General Category')
                        @php
                            $generalcategories = App\Models\general_content\Contentcategory::all()->take($element->post_qty);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif
                        @isset($generalcategories)
                        <div class="row">
                        @foreach ($generalcategories as $generalcategory)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

                                <div class="feature-box fbox-rounded fbox-effect">
                                    <div class="fbox-icon">
                                        <a href="{{route('general.posts',$generalcategory->id)}}"><img src="{{asset('uploads/contentcategoryphoto/'.$generalcategory->image)}}"></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>{{$generalcategory->name}}</h3>
                                        <p>{!!Str::limit($generalcategory->desc, 70)!!}</p>
                                    </div>
                                </div>
						</div>
                        @endforeach
                        </div>
                        @endisset

                        @elseif($element->module_type == 'Service Post')
                        @php
                            $serviceposts = App\Models\Service\Service::all()->take($element->post_qty);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif

                        @isset($serviceposts)
                            <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="true" data-autoplay="10000" data-items-xs="1" data-items-sm="1" data-items-md="3" data-items-xl="{{($element->layout == 'One Column') ? 1 : (($element->layout == 'Two Column') ? 2 : (($element->layout == 'Three Column') ? 3 : 4)) }}">
                                @foreach ($serviceposts as $servicepost)
                                @if ($servicepost->status == 1)
                                <div class="portfolio-item">
                                    <div class="portfolio-image" style="width: {{$element->portfolio_width}}%;">
                                        <a href="{{route('service.details',$servicepost->slug)}}">
                                            <img src="{{asset('uploads/servicephoto/'.$servicepost->image)}}" alt="Open Imagination">
                                        </a>
                                    </div>
                                    <div class="centered d-flex align-items-center justify-content-center"><a href="{{route('service.details',$servicepost->slug)}}" style="color: #000; font-size: 24px;">{{$servicepost->title}}</a></div>
                                    <div class="portfolio-desc">
                                        <p>{{$servicepost->excerpt}}</p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        @endisset


                        @elseif($element->module_type == 'Service Category')
                        @php
                            $servicecategories = App\Models\Service\Servicecategory::all()->take($element->post_qty);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif

                        @isset($servicecategories)
                        {{-- @foreach ($servicecategories as $servicecategory)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                            <div class="feature-box fbox-center fbox-light fbox-effect border-bottom-0">
                                <div class="fbox-icon">
                                    <a href="{{route('service.posts',$servicecategory->id)}}"><img src="{{asset('uploads/servicecategory_photo/'.$servicecategory->image)}}" ></a>
                                </div>
                                <div class="fbox-content">
                                    <h3>{{$servicecategory->name}}<span class="subtitle">{!!$servicecategory->desc!!}</span></h3>
                                </div>

                            </div>
                        </div>
                        @endforeach --}}

                        <style>
                            .single-category {
                            box-shadow: 0px 0px 5px #0000001a;
                            border-radius: 8px;
                            text-align: center;
                            padding: 40px 30px;
                            margin-bottom: 40px;
                            transform: translateY(0px);
                            transition: .3s;
                            }
                            .single-category:hover {
                                transform: translateY(-10px)
                            }
                        </style>

                        <div class="row">
                            @foreach ($servicecategories as $key => $servicecategory)
                            @if ($servicecategory->status == 1)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="single-category">
                                    @if (!empty($servicecategory->image))
                                        <div class="img-wrapper">
                                            <img style="width: 100px; height: auto;" src="{{asset('uploads/servicecategory_photo/'.$servicecategory->image)}}" alt="">
                                        </div>
                                    @endif
                                    <div class="text">
                                        <h4>{{$servicecategory->name}}</h4>
                                        <p>
                                              {{$servicecategory->desc}}
                                        </p>
                                        <a href="{{route('service.posts',$servicecategory->id)}}" class="readmore">View Service</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endisset




                        @elseif($element->module_type == 'Price-Table Post')
                        @php
                            $priceposts = App\Models\Pricing_Table\Price::latest()->take($element->post_qty)->get();
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif

                        @isset($priceposts)
                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="true" data-autoplay="10000" data-items-xs="1" data-items-sm="1" data-items-md="3" data-items-xl="{{($element->layout == 'One Column') ? 1 : (($element->layout == 'Two Column') ? 2 : (($element->layout == 'Three Column') ? 3 : 4)) }}">
                            @foreach ($priceposts as $pricepost)
                            @if ($pricepost->status == 1)
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
                                        {{-- <ul class="iconlist">
                                            <li><i class="icon-check text-smaller"></i> <strong>Premium</strong> Plugins</li>
                                            <li><i class="icon-check text-smaller"></i> <strong>SEO</strong> Features</li>
                                            <li><i class="icon-check text-smaller"></i> <strong>Full</strong> Access</li>
                                            <li><i class="icon-check text-smaller"></i> <strong>100</strong> User Accounts</li>
                                            <li><i class="icon-check text-smaller"></i> <strong>1 Year</strong> License</li>
                                            <li><i class="icon-check text-smaller"></i> <strong>24/7</strong> Support</li>
                                        </ul> --}}
                                        {!!$pricepost->body!!}
                                    </div>
                                    <div class="pricing-action">
                                        <a href="{{route('package.order',$pricepost->slug)}}" class="btn btn-danger btn-lg">Get Started</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        {{-- @foreach ($priceposts as $pricepost)

                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

							<div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-start">
								<div class="pricing-title">
									<span class="text-danger">Most Popular</span>
									<h3>{{$pricepost->title}}</h3>
								</div>
								<div class="pricing-price">
									<span class="price-unit">&euro;</span>{{$pricepost->price}}<span class="price-tenure">{{$pricepost->duration}}</span>
								</div>
								<div class="pricing-features">
									<ul class="iconlist">
										<li><i class="icon-check text-smaller"></i> <strong>Premium</strong> Plugins</li>
										<li><i class="icon-check text-smaller"></i> <strong>SEO</strong> Features</li>
										<li><i class="icon-check text-smaller"></i> <strong>Full</strong> Access</li>
										<li><i class="icon-check text-smaller"></i> <strong>100</strong> User Accounts</li>
										<li><i class="icon-check text-smaller"></i> <strong>1 Year</strong> License</li>
										<li><i class="icon-check text-smaller"></i> <strong>24/7</strong> Support</li>
									</ul>
                                    {!!$pricepost->body!!}
								</div>
								<div class="pricing-action">
									<a href="#" class="btn btn-danger btn-lg">Get Started</a>
								</div>
							</div>

						</div>
                        @endforeach --}}

                        @endisset


                        @elseif($element->module_type == 'Price-Table Category')
                        @php
                            $pricecategories = App\Models\Pricing_Table\Pricecategory::all()->take($element->post_qty);
                        @endphp

                        @isset($pricecategories)
                        @foreach ($pricecategories as $pricecategory)
                        {{-- <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

                                <div class="feature-box fbox-rounded fbox-effect">
                                    <div class="fbox-icon">
                                        <a href="{{route('price.posts',$pricecategory->id)}}"><img src="{{asset('uploads/pricecategory_photo/'.$pricecategory->image)}}"></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>{{$pricecategory->name}}</h3>
                                        <p>{!!Str::limit($pricecategory->body, 100)!!}</p>
                                    </div>
                                </div>
						</div> --}}
                        @endforeach
                        @endisset



                        @elseif($element->module_type == 'Portfolio Post')
                        @php
                            $portfolioposts = App\Models\Portfolio\Portfolio::latest()->take($element->post_qty)->get();
                        @endphp

                        @isset($portfolioposts)

                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-xl="{{($element->layout == 'One Column') ? 1 : (($element->layout == 'Two Column') ? 2 : (($element->layout == 'Three Column') ? 3 : 4)) }}">
                            @foreach ($portfolioposts as $portfoliopost)
                            @if ($portfoliopost->status == 1)
                            <div class="portfolio-item">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img src="{{asset('uploads/portfoliophoto/thumb/'.$portfoliopost->image)}}" alt="Open Imagination">
                                    </a>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                            <a href="{{asset('uploads/portfoliophoto/'.$portfoliopost->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                            {{-- <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a> --}}
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                    </div>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{route('portfolio.details',$portfoliopost->slug)}}">{{$portfoliopost->title}}</a></h3>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        @endisset


                        @elseif($element->module_type == 'Team Section')
                        @php
                            $teamposts = App\Models\Teams\Teampost::all()->take($element->post_qty);
                        @endphp

                        @isset($teamposts)

                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-xl="{{($element->layout == 'One Column') ? 1 : (($element->layout == 'Two Column') ? 2 : (($element->layout == 'Three Column') ? 3 : 4)) }}">
                            @foreach ($teamposts as $teampost)
                            @if ($teampost->status == 1)
                            <div class="team">
                                <div class="team-image">
                                    <img src="{{asset('uploads/teamphoto/'.$teampost->image)}}" alt="John Doe">
                                </div>
                                <div class="team-desc team-desc-bg">
                                    <div class="team-title"><h4>{{$teampost->name}}</h4><span>{{$teampost->designation}}</span></div>
                                    <a href="{{$teampost->facebook}}" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="{{$teampost->twitter}}" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="{{$teampost->instagram}}" class="social-icon inline-block si-small si-light si-rounded si-instagram">
                                        <i class="icon-instagram"></i>
                                        <i class="icon-instagram"></i>
                                    </a>
                                    <a href="{{$teampost->linkedin}}" class="social-icon inline-block si-small si-light si-rounded si-linkedin">
                                        <i class="icon-linkedin"></i>
                                        <i class="icon-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        @endisset


                        @elseif ($element->module_type == 'Client List')

                        @php
                            $clients = App\Models\Client::all();
                            $count = count($clients);
                            $cou = $count-2;
                            $half = ceil($count/2);
                            $test = 2;
                        @endphp

                        @isset($clients)

                        <div id="oc-events" class="owl-carousel events-carousel carousel-widget" data-pagi="false" data-autoplay="5000" data-items-md="1" data-items-lg="2" data-items-xl="2">
                            @for ($i=0; $i<=$cou; $i+=2)

                            <div class="oc-item">
                                <div class="entry event mb-3">
                                    <div class="grid-inner row align-items-center g-0 p-4" style="background: #fff;">
                                        <div class="col-md-4 mb-md-0">
                                            <a href="#" class="entry-image" style="height: 100px; width: 115px; padding-top: 5%;">
                                                <img src="{{asset('uploads/clientlogo/'.$clients[$i]['logo'])}}" alt="Inventore voluptates velit totam ipsa">
                                            </a>
                                        </div>
                                        <div class="col-md-8 ps-md-4">
                                            <div class="entry-title title-xs">
                                                <h3><a href="#">{{$clients[$i]['name']}}</a></h3>
                                            </div>
                                            {{-- <div class="entry-meta">
                                                <ul>
                                                    <li><a href="#"><i class="icon-line-link"></i>{{$client->website}}</a></li>
                                                    <li><a href="#"><i class="icon-map-marker2"></i> Melbourne</a></li>
                                                </ul>
                                            </div> --}}
                                            <div class="entry-content">
                                                <ul>
                                                    <li><a href="#"><i class="icon-line-link"></i>{{$clients[$i]['website']}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry event mb-3">
                                    <div class="grid-inner row align-items-center g-0 p-4" style="background: #fff;">
                                        <div class="col-md-4 mb-md-0">
                                            <a href="#" class="entry-image" style="height: 100px; width: 150px; padding-top: 6%;">
                                                <img src="{{asset('uploads/clientlogo/'.$clients[$i+1]['logo'])}}" alt="Inventore voluptates velit totam ipsa">
                                            </a>
                                        </div>
                                        <div class="col-md-8 ps-md-4">
                                            <div class="entry-title title-xs">
                                                <h3><a href="#">{{$clients[$i+1]['name']}}</a></h3>
                                            </div>
                                            {{-- <div class="entry-meta">
                                                <ul>
                                                    <li><a href="#"><i class="icon-line-link"></i>{{$client->website}}</a></li>
                                                    <li><a href="#"><i class="icon-map-marker2"></i> Melbourne</a></li>
                                                </ul>
                                            </div> --}}
                                            <div class="entry-content">
                                                <ul>
                                                    <li><a href="#"><i class="icon-line-link"></i>{{$clients[$i+1]['name']}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            @endfor

                        </div>

                        {{-- <div id="oc-events" class="owl-carousel events-carousel carousel-widget" data-pagi="false" data-autoplay="5000" data-items-md="1" data-items-lg="2" data-items-xl="2">

                            @foreach ($clients as $key => $client)
                            @if ($key%2 != 0)
                            <div class="oc-item">
                                <div class="entry event mb-3">
                                    <div class="grid-inner row align-items-center g-0 p-4" style="background: #fff;">
                                        <div class="col-md-4 mb-md-0">
                                            <a href="#" class="entry-image" style="height: 100px; width: 150px; padding-top: 6%;">
                                                <img src="{{asset('uploads/clientlogo/'.$client->logo)}}" alt="Inventore voluptates velit totam ipsa">
                                            </a>
                                        </div>
                                        <div class="col-md-8 ps-md-4">
                                            <div class="entry-title title-xs">
                                                <h3><a href="#">{{$client->name}}</a></h3>
                                            </div>
                                            <div class="entry-content">
                                                <ul>
                                                    <li><a href="#"><i class="icon-line-link"></i>{{$client->website}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div> --}}

                        @endisset

                        @elseif ($element->module_type == 'Counter Up')

                        @php
                            $counters = App\Models\Counter::all();
                        @endphp

                        @isset($counters)

                        <div class="row col-mb-50">
                            @foreach ($counters as $counter)
                            <div class="col-sm-6 col-lg-3 text-center" style="padding-top: 50px;">
                                <i class="i-plain i-xlarge mx-auto mb-0 icon-{{$counter->icon}}"></i>
                                <div class="counter counter-large" style="color: {{$counter->color}};"><span data-from="100" data-to="{{$counter->number}}{{$counter->extra_text}}" data-refresh-interval="50" data-speed="2000"></span></div>
                                <h5>{{$counter->title}}</h5>
                            </div>
                            @endforeach
                        </div>

                        @endisset



                        @elseif($element->module_type == 'Gallery')
                        @php
                            $galleryphotos = App\Models\Gallery\Gallery::with('gallerycategory')->get()->take($element->post_qty);
                        @endphp

                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif
                        @isset($galleryphotos)
                        @php
                        $gallerycategories = \App\Models\Gallery\Gallerycategory::all();
                        @endphp
                        <div class="grid-filter-wrap">
                            <ul class="grid-filter" data-container="#portfolio">
                                <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                                @foreach ($gallerycategories as $category)
                                <li><a href="#" data-filter=".{{$category->id}}" >{{$category->name}}</a></li>
                                @endforeach
                            <div class="grid-shuffle rounded" data-container="#portfolio">
                                <i class="icon-random"></i>
                            </div>
                        </div>


                        <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">
                        @foreach ($galleryphotos as $photo)
                        {{-- @foreach ($photo->gallerycategory as $category) --}}
                        <article class="col-sm-3 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }} {{$photo->gallerycategory->id}}">
                            <div class="grid-inner">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img src="{{asset('uploads/gallery_photo/thumb/'.$photo->image)}}" alt="Open Imagination">
                                    </a>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                            <a href="{{asset('uploads/gallery_photo/'.$photo->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                    </div>
                                </div>
                                {{-- <div class="portfolio-desc">
                                    <h3>{{$photo->name}}</h3>
                                </div> --}}
                            </div>
                        </article>
                        {{-- @endforeach --}}
                        @endforeach
                        </div>

                        @endisset



                        @elseif($element->module_type == 'Custome Element')


                        @if ($element->title)
                        @if ($element->title_show == 1)
                        <div class="heading-block">
                            <h2 style="color: {{$element->title_color}};">{{$element->title}}</h2>
                        </div>
                        @endif
                        @endif

                        @isset($element->galleryimg)
                        <div class="masonry-thumbs grid-container grid-4"  data-lightbox="gallery">
                            @php
                                $galaryimage = explode("|", $element->galleryimg);
                            @endphp
                            @foreach ($galaryimage as $key => $images)
                            <a class="grid-item" href="{{asset('uploads/elementgalleryphoto/'.$images)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/elementgalleryphoto/'.$images)}}" alt="Gallery Thumb 1"></a>
                            @endforeach
                        </div>
                        @endisset


                        @isset($element->image)
                        <img src="{{asset('uploads/elementphoto/'.$element->image)}}" height="{{$element->img_height}}" width="{{$element->img_width}}" >
                        @endisset

                        {!!$element->body!!}

                        @endif

                    </div>
                    {{-- </div> --}}

                </div>
                @endforeach
            </div>

            {{-- <div class="line"></div> --}}

        </div>
        @endif
        @endforeach
        </div>

        {{-- <div class="row col-mb-50">
            <div class="col-sm-6 col-lg-3 text-center">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-smile"></i>
                <div class="counter counter-large" style="color: #1abc9c;"><span data-from="100" data-to="3700" data-refresh-interval="50" data-speed="2000"></span></div>
                <h5>Happy Customer</h5>
            </div>

            <div class="col-sm-6 col-lg-3 text-center">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-download"></i>
                <div class="counter counter-large" style="color: #e74c3c;"><span data-from="100" data-to="2050" data-refresh-interval="50" data-speed="2500"></span></div>
                <h5>Total Downloads</h5>
            </div>

            <div class="col-sm-6 col-lg-3 text-center">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-gift"></i>
                <div class="counter counter-large" style="color: #3498db;"><span data-from="100" data-to="2050" data-refresh-interval="50" data-speed="3500"></span></div>
                <h5>Awards Won</h5>
            </div>

            <div class="col-sm-6 col-lg-3 text-center">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-user"></i>
                <div class="counter counter-large" style="color: #9b59b6;"><span data-from="100" data-to="387" data-refresh-interval="30" data-speed="2700"></span></div>
                <h5>Total Agents</h5>
            </div>
        </div> --}}



@endsection()

@section('scripts')

@endsection
