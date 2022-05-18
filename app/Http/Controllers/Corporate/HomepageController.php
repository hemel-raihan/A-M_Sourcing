<?php

namespace App\Http\Controllers\Corporate;

use App\Models\blog\Post;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Package\Order;
use App\Models\Career\Jobpost;
use App\Models\Gallery\Gallery;
use App\Models\Package\Address;
use App\Models\Product\Product;
use App\Models\Service\Service;
use App\Models\Pagebuilder\Element;
use App\Models\Portfolio\Portfolio;
use App\Models\Pricing_Table\Price;
use App\Http\Controllers\Controller;
use App\Models\Pagebuilder\Custompage;
use App\Models\Gallery\Gallerycategory;
use App\Models\Product\Productcategory;
use App\Models\Service\Servicecategory;
use Illuminate\Support\Facades\Artisan;
use App\Models\general_content\Contentpost;
use App\Models\Portfolio\Portfoliocategory;
use App\Models\Pricing_Table\Pricecategory;
use Illuminate\Support\Facades\Notification;
use App\Models\general_content\Contentcategory;
use App\Notifications\EmailVarification;
use App\Notifications\OrderCompleteNotification;

class HomepageController extends Controller
{
    public function index()
    {
        // $categories = category::all();

        // $randomvideos = Video::where('type','=','Random Video')->get();
        // $othersvideos = Video::where('type','=','Others Video')->get();
        // $banner_img  = Slide::where([['type','home-banner'],['status',true]])->orderBy('id','desc')->first();
        // $notices = Notice::all();
        // $links = Link::where('status',1)->orderBy('id','desc')->limit(5)->get();
        // $posts = Post::where('scrollable',1)->orderBy('id','desc')->limit(5)->get();

        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->with('pagebuilders')->orderBy('id','desc')->first();
        // foreach($page->pagebuilders as $test)
        // {
        //     foreach($test->elements as $tes)
        //     {
        //         if($tes->module_type == 'Blog Category')
        //         {
        //             $blogcategories = category::all();
        //         }
        //         else
        //         {
        //             $blogcategories = null;
        //         }

        //         if($tes->module_type == 'Service Category')
        //         {
        //             $servicecategories = Servicecategory::all();
        //         }
        //         else
        //         {
        //             $servicecategories = null;
        //         }

        //         if($tes->module_type == 'General Category')
        //         {
        //             $generalcategories = Contentcategory::all();
        //         }
        //         else
        //         {
        //             $generalcategories = null;
        //         }

        //         if($tes->module_type == 'Portfolio Category')
        //         {
        //             $portfoliocategories = Portfoliocategory::all();
        //         }
        //         else
        //         {
        //             $portfoliocategories = null;
        //         }
        //         if($tes->module_type == 'Price-Table Category')
        //         {
        //             $pricecategories = Pricecategory::all();
        //         }
        //         else
        //         {
        //             $pricecategories = null;
        //         }
        //         if($tes->module_type == 'Product Category')
        //         {
        //             $productcategories = Productcategory::all();
        //         }
        //         else
        //         {
        //             $productcategories = null;
        //         }
        //         if($tes->module_type == 'Blog Post')
        //         {
        //             $blogposts = Post::where('status',1)->orderBy('id','desc')->limit(5)->get();
        //         }
        //         else
        //         {
        //             $blogposts = null;
        //         }
        //         if($tes->module_type == 'General Post')
        //         {
        //             $generalposts = Contentpost::where('status',1)->orderBy('id','desc')->limit(5)->get();
        //         }
        //         else
        //         {
        //             $generalposts = null;
        //         }
        //         if($tes->module_type == 'Service Post')
        //         {
        //             $serviceposts = Service::all();
        //         }
        //         else
        //         {
        //             $serviceposts = Service::all();
        //         }
        //         if($tes->module_type == 'Portfolio Post')
        //         {
        //             $portfolioposts = Portfolio::all();
        //         }
        //         else
        //         {
        //             $portfolioposts = null;
        //         }
        //         if($tes->module_type == 'Price-Table Post')
        //         {
        //             $priceposts = Price::all();
        //         }
        //         else
        //         {
        //             $priceposts = null;
        //         }
        //         if($tes->module_type == 'Product Post')
        //         {
        //             $productposts = Product::all();

        //         }
        //         else
        //         {
        //             $productposts = null;
        //         }

        //     }

        // }
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.homepage',compact('page'));

        // if ($page->pagebuilders()->exists())
        // {
        //     return view('frontend_theme.corporate.homepage',compact('page','blogcategories','servicecategories','generalcategories','portfoliocategories','pricecategories','blogposts'
        //     ,'generalposts','serviceposts','portfolioposts','priceposts','productcategories','productposts','test'));
        // }
        // else
        // {
        //     return view('frontend_theme.corporate.homepage',compact('page'));
        // }

    }

    public function portfolios($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $portfoliocategory = Portfoliocategory::find($id);
        $portfoliocategoryposts = $portfoliocategory->portfolios()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('portfoliocategoryposts','portfoliocategory','page'));
    }

    public function portfoliodetails($slug)
    {

        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $portfolio = Portfolio::where('slug',$slug)->first();
        // foreach($portfolio->portfoliocategories as $categories)
        // {
        //     $portfolio_id = $categories->id;
        // }
        // $portfoliocategory = Portfoliocategory::find($portfolio_id);
        // $portfoliocategoryposts = $portfoliocategory->portfolios()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('portfolio','page'));
    }

    public function services($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $servicecategory = Servicecategory::find($id);
        $servicecategoryposts = $servicecategory->services()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('servicecategoryposts','servicecategory','page'));
    }

    public function servicedetails($slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $service = Service::where('slug',$slug)->first();
        foreach($service->servicecategories as $categories)
        {
            $service_id = $categories->id;
        }
        $servicecategory = Servicecategory::find($service_id);
        $servicecategoryposts = $servicecategory->services()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('service','servicecategoryposts','page'));
    }

    public function prices($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $pricecategory = Pricecategory::find($id);
        $pricecategoryposts = $pricecategory->prices()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('pricecategoryposts','pricecategory','page'));
    }

    public function package_order($slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $price = Price::where([['slug',$slug],['status',1]])->first();

        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.package_order',compact('page','price'));
    }

    public function package_order_store(Request $request, $slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $price = Price::where([['slug',$slug],['status',1]])->first();
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $address = Address::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_code' => rand(0, 99999),
            'contact_no' => $request->contact_no,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'nda_file' => $request->nda_file,
        ]);

        Notification::route('mail',$address->email)
                            ->notify(new EmailVarification($address));
        notify()->success("A verification code has sent to your email");
        return view('frontend_theme.corporate.email_varification',compact('address','price','page'));
    }

    public function resend_code($id,$slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $address = Address::find($id);
        $price = Price::where([['slug',$slug],['status',1]])->first();

        $address->update([
            'email_verified_code' => rand(0, 99999),
        ]);

        Notification::route('mail',$address->email)
                            ->notify(new EmailVarification($address));

        notify()->success("Another verification code has sent to your email");
        return view('frontend_theme.corporate.email_varification',compact('address','price','page'));
    }


    public function email_varified(Request $request)
    {
        if($request->email_verified_code == $request->code)
        {
                $order = Order::create([
                'order_code' => rand(0, 99999),
                'address_id' => $request->address_id,
                'price_id' => $request->price_id,
                ]);

                $address = Address::find($request->address_id);
                Notification::route('mail',$address->email)
                            ->notify(new OrderCompleteNotification($address,$order));

            notify()->success("Your Order Successfully sent to the Admin");
            return redirect()->route('home');
        }
        else
        {
            $price = Price::find($request->price_id);
            $address = Address::find($request->address_id);
            $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
            notify()->error("Invalid Code..Please Try again!");
            return view('frontend_theme.corporate.email_varification',compact('address','price','page'));
        }
    }

    public function blogs($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $blogcategory = category::find($id);
        $blogcategoryposts = $blogcategory->posts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('blogcategoryposts','blogcategory','page'));
    }

    public function blogdetails($slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $blog = Post::where([['slug',$slug],['status',1],['is_approved',1]])->first();
        foreach($blog->categories as $blogcategories)
        {
            $blog_id = $blogcategories->id;
        }
        $blogcategory = category::find($blog_id);
        $blogcategoryposts = $blogcategory->posts()->where([['status',1],['is_approved',1]])->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('blog','blogcategoryposts','page'));
    }

    public function generals($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $contentcategory = Contentcategory::find($id);
        $contentcategoryposts = $contentcategory->contentposts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('contentcategoryposts','contentcategory','page'));
    }

    public function generaldetails($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $content = Contentpost::find($id);
        foreach($content->contentcategories as $categories)
        {
            $content_id = $categories->id;
        }
        $contentcategory = Contentcategory::find($content_id);
        $contentcategoryposts = $contentcategory->contentposts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('content','contentcategoryposts','page'));
    }

    public function contact()
    {
        return view('frontend_theme.corporate.contact_form');
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        //$search_news = Page::where('title','LIKE',"%$query%")->where('status',1)->get();

        $search_news = Page::where('title','LIKE','%'.$query.'%')->where('status',1)->get();
        return view('frontend_theme.corporate.search',compact('search_news','query'));
    }

    public function gallery_view()
    {
        $categories = Gallerycategory::all();
        $galleries = Gallery::all();
        return view('frontend_theme.corporate.gallery_page',compact('categories','galleries'));
    }

    public function faqpage()
    {
        return view('frontend_theme.corporate.faq');
    }

    public function career()
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $alljobs = Jobpost::all();
        return view('frontend_theme.corporate.all_posts',compact('alljobs','page'));
    }

    public function career_details($slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $job = Jobpost::where('slug',$slug)->first();
        return view('frontend_theme.corporate.posts_singlepage',compact('job','page'));
    }

    public function price_category()
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $pricecategories = Pricecategory::all();
        return view('frontend_theme.corporate.all_posts',compact('pricecategories','page'));
    }

    public function all_price($slug)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $pricecategory = Pricecategory::where('slug',$slug)->first();
        $prices = $pricecategory->prices()->get();
        return view('frontend_theme.corporate.default-page',compact('prices','page','pricecategory'));
    }
}
