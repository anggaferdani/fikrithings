<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $query = Category::where('status', 1);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $categories = $query->paginate(10);

        return view('backend.pages.category.index', compact(
            'categories',
        ));
    }

    public function create() {}

    public function store(Request $request) {
        try {
            $request->validate([
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);

            $slug = $this->generateSlug($request->input('title'));
    
            $array = [
                'image' => $this->handleFileUpload($request->file('image'), 'category/'),
                'title' => $request['title'],
                'description' => $request['description'],
                'slug' => $slug,
            ];

            Category::create($array);
    
            return redirect()->route('admin.category.index')->with('success', 'Success');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {
        try {
            $category = Category::find($id);
    
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
    
            $array = [
                'title' => $request['title'],
                'description' => $request['description'],
            ];

            if ($request->hasFile('image')) {
                $array['image'] = $this->handleFileUpload($request->file('image'), 'category/');
            }

            if ($category->title !== $request->input('title')) {
                $array['slug'] = $this->generateSlug($request->input('title'));
            }
    
            $category->update($array);
    
            return redirect()->route('admin.category.index')->with('success', 'Success');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $category = Category::find($id);

            $category->update([
                'status' => 0,
            ]);

            return redirect()->route('admin.category.index')->with('success', 'Success');
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
        $count = Category::where('slug', 'like', "$slug%")->count();
    
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
    
        return $slug;
    }
}
