@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')

                    @php
                    $page = \App\Models\Pagebuilder\Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
                    @endphp


@include('frontend_theme.corporate.front_layout.vertical.banner',['Faq'=> 'Faq'])



                                @if ($page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-12">
                                @elseif(!$page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-9">
                                @elseif($page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-9">
                                @elseif(!$page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
                                <div class="postcontent col-lg-6">
                                @endif

                                <div class="container-sm">
                                    {{-- <div class="single-post mb-0" style="width: 80%; margin-left:10%;"> --}}
                                <div class="single-post mb-0" >

                                        <!-- Single Post
                                        ============================================= -->
                                <div class="entry clearfix">

                                    </br>
                                </br>
                                @php
                                    $faqs = \App\Models\Faq::where('status','=',1)->get();
                                @endphp
                                @isset($faqs)
                                @foreach ($faqs as $faq)
                                <div class="toggle toggle-bg">
                                    <div class="toggle-header">
                                        <div class="toggle-icon">
                                            <i class="toggle-closed icon-ok-circle"></i>
                                            <i class="toggle-open icon-remove-circle"></i>
                                        </div>
                                        <div class="toggle-title">
                                            {{$faq->title}}
                                        </div>
                                    </div>
                                    <div class="toggle-content">{{$faq->desc}}</div>
                                </div>
                                @endforeach
                                @endisset

                            </div>
                        </div>
                    </div>
                </div>


@endsection()

@section('scripts')

@endsection
