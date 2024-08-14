<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class FrontController extends Controller
{
    public function aboutMe() {
        $companyProfile = CompanyProfile::first();
        return view('frontend.pages.about-me', compact(
            'companyProfile',
        ));
    }

    public function index() {
        $companyProfile = CompanyProfile::first();
        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.index', compact(
            'companyProfile',
            'categories',
        ));
    }

    public function articles($slug) {
        $category = Category::where('slug', $slug)->first();
        $articles = Article::where('category_id', $category->id)->where('status', 1)->paginate(12);
        return view('frontend.pages.articles', compact(
            'category',
            'articles',
        ));
    }

    public function article($categorySlug, $slug) {
        $category = Category::where('slug', $categorySlug)->first();
        $article = Article::where('slug', $slug)->first();
        return view('frontend.pages.article', compact(
            'article',
        ));
    }
}
