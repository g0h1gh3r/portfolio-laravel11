<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSectionSetting;
use App\Models\Category;
use App\Models\ContactSectionSetting;
use App\Models\Experience;
use App\Models\Feedback;
use App\Models\FeedbackSectionSetting;
use App\Models\FooterContactInfo;
use App\Models\FooterHelpLink;
use App\Models\FooterInfo;
use App\Models\FooterSocialLink;
use App\Models\FooterUsefulLink;
use App\Models\Hero;
use App\Models\PortfolioItem;
use App\Models\PortfolioSectionSetting;
use App\Models\Service;
use App\Models\SkillItem;
use App\Models\SkillSectionSetting;
use App\Models\TyperTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $typerTitles = TyperTitle::all();
        $services = Service::all();
        $about = About::first();
        $portfolioSectionSetting = PortfolioSectionSetting::first();
        $portfolioCategories = Category::all();
        $portfolioItems = PortfolioItem::all();
        $skillSectionSetting = SkillSectionSetting::first();
        $skillItems = SkillItem::all();
        $experience = Experience::first();
        $feedbacks = Feedback::all();
        $feedbackSectionSetting = FeedbackSectionSetting::first();
        $blogs = Blog::latest()->take(5)->get();
        $blogSectionSetting = BlogSectionSetting::first();
        $blogCategories = BlogCategory::all();
        $contactSectionSetting = ContactSectionSetting::first();
        $footerSocialLinks = FooterSocialLink::all();
        $footerUsefulLinks = FooterUsefulLink::all();
        $footerHelpLinks = FooterHelpLink::all();
        $footerContactInfo = FooterContactInfo::first();
        $footerInfo = FooterInfo::first();
        return view('frontend.home',
         compact('hero',
         'typerTitles',
         'services',
         'about',
         'portfolioSectionSetting',
         'portfolioCategories',
         'portfolioItems',
         'skillSectionSetting',
         'skillItems',
         'experience',
         'feedbacks',
         'feedbackSectionSetting',
         'blogs',
         'blogSectionSetting',
         'blogCategories',
         'contactSectionSetting',
         'footerSocialLinks',
         'footerUsefulLinks',
         'footerHelpLinks',
         'footerContactInfo',
         'footerInfo',
         ));
    }

    public function showPortfolio($id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details',compact('portfolio'));
    }

    public function showBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $previousBlog = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextBlog = Blog::where('id', '>', $blog->id)->orderBy('id')->first();
        return view('frontend.blog-details',compact('blog','previousBlog','nextBlog'));
    }

    public function blog()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('frontend.blog',compact('blogs'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'subject' => ['required','max:300'],
            'email' => ['required','email'],
            'message' => ['required','max:2000'],
        ]);

        Mail::send(new ContactMail($request->all()));
        return response(['status' => 'success', 'message' => 'Mail Sent Successfully!']);

    }
}
