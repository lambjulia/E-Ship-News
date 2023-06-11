<?php

namespace App\Http\Controllers;

use App\Models\NewsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class NewsController extends Controller
{
    public function allNews()
    {
        $news = News::all();
        $images = NewsImages::all();

        return view('news.news-all', compact('news', 'images'));
    }

    public function create()
    {
        return view('news.news-create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'thumbnail' => 'required',
                'image' => 'required',
            ],
            [
                'required' => 'Este campo é obrigatório.',
            ],
        );

        $selectedOptions = $request->input('tags');

        $selectedOptionsString = implode(',', $selectedOptions);

        if ($request->hasFile('thumbnail')) {
            $images = $request->file('thumbnail');
            $fileName = uniqid() . '.jpg';
            $path = $images->storeAs('public/images',  $fileName);
            $path = 'storage/images/' . $fileName;
        }

        $news = News::create([
            'user_id' => $userId,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'thumbnail' => $path,
            'tags' => $selectedOptionsString,

        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            foreach ($images as $image) {
                $fileName = uniqid() . '.jpg';
                $path = $image->storeAs('public/images',  $fileName);
                $path = 'storage/images/' . $fileName;
                $image = new NewsImages();
                $image->image = $fileName;
                $image->path = $path;
                $image->news_id = $news->id;
                $image->save();
            }
        }

        return redirect()->back()->with('news-store', '402');
    }

    public function edit($id)

    {
        $news = News::find($id);
        $images = NewsImages::where('news_id', '=', $id)->get();
        $user = Auth::user();
        $itens = explode(',', $news->tags);

        return view('news.news-edit', compact('news', 'images', 'user', 'itens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
            ],
            [
                'required' => 'Este campo é obrigatório.',
            ],
        );

        $selectedOptions = $request->input('tags');

        $selectedOptionsString = implode(',', $selectedOptions);

        $news = News::find($id);

        $path = $request->old('path', $news->thumbnail);

        if ($request->hasFile('thumbnail')) {
            $images = $request->file('thumbnail');
            $fileName = uniqid() . '.jpg';
            $path = $images->storeAs('public/images',  $fileName);
            $path = 'storage/images/' . $fileName;
        }


        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->thumbnail = $path;
        $news->tags = $selectedOptionsString;
        $news->save();

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            foreach ($images as $image) {
                $fileName = uniqid() . '.jpg';
                $path = $image->storeAs('public/images',  $fileName);
                $path = 'storage/images/' . $fileName;
                $image = new NewsImages();
                $image->image = $fileName;
                $image->path = $path;
                $image->news_id = $news->id;
                $image->save();
            }
        }

        return redirect()->back()->with('news-update', '402');
    }

    public function destroyImage($id)
    {
        $imagem = NewsImages::findOrFail($id);

        $imagem->delete();

        return redirect()->back()->with('image-delete', '402');
    }


    public function show($id)
    {
        $news = News::find($id);
        $images = NewsImages::where('news_id', '=', $id)->get();
        $news->increment('views');

        $selectedOptions = News::pluck('tags');
        $stringArray = str_replace(['[', ']', '"'], '', $selectedOptions);
        $valores = explode(",", $stringArray);

        return view('news.news-show', compact('news', 'images', 'valores'));
    }

    public function destroyNews($id)
    {
        $news = News::findOrFail($id);

        $news->delete();

        return redirect()->back()->with('news-delete', '402');
    }
}
