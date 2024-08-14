<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request) {
        $query = Article::with('category')->where('status', 1);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('slug', 'like', '%' . $search . '%');
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $articles = $query->paginate(10);
        $categories = Category::where('status', 1)->get();

        return view('backend.pages.article.index', compact(
            'articles',
            'categories',
        ));
    }

    public function create() {}

    public function store(Request $request) {
        try {
            $request->validate([
                'category_id' => 'required',
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);

            $slug = $this->generateSlug($request->input('title'));
    
            $array = [
                'image' => $this->handleFileUpload($request->file('image'), 'article/'),
                'category_id' => $request['category_id'],
                'slug' => $slug,
                'title' => $request['title'],
                'description' => $request['description'],
            ];

            Article::create($array);
    
            return redirect()->route('admin.article.index')->with('success', 'Success');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {
        try {
            $article = Article::find($id);
    
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);
    
            $array = [
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'description' => $request['description'],
            ];

            if ($request->hasFile('image')) {
                $array['image'] = $this->handleFileUpload($request->file('image'), 'article/');
            }

            if ($article->title !== $request->input('title')) {
                $array['slug'] = $this->generateSlug($request->input('title'));
            }
    
            $article->update($array);
    
            return redirect()->route('admin.article.index')->with('success', 'Success');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $article = Article::find($id);

            $article->update([
                'status' => 0,
            ]);

            return redirect()->route('admin.article.index')->with('success', 'Success');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    private function handleFileUpload($file, $path)
    {
        if ($file) {
            $fileName = date('YmdHis') . rand(999999999, 9999999999) . $file->getClientOriginalExtension();
            $file->move(public_path($path), $fileName);
            return $fileName;
        }
        return null;
    }

    private function generateSlug($title) {
        $slug = Str::slug($title);
        $count = Article::where('slug', 'like', "$slug%")->count();
    
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
    
        return $slug;
    }
}
