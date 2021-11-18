<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function news(Request $request)
    {
        $posts = DB::table('news')->select('news.id', 'title', 'content', 'author', 'category', 'posted', 'users.name')->join('users', 'users.id', '=', 'news.author')->orderBy('news.id', 'desc')->limit(3)->offset(($request->pageNumber - 1) * 3)->get();

        foreach ($posts as &$post) {
            $post->start_time = (new \DateTime($post->posted))->format("F j, Y");
            if (strlen($post->content) > 400) {
                $post->content = substr($post->content, 0, 400) . '... <a href="news/'. $post->id .'" style="color:skyblue">Continue Reading</a>';
            }
        }

        return response()->json([
            'items' => $posts,
            'total' => DB::table('news')->count()
        ]);
    }

    public function article($id)
    {
        $posts = DB::table('news')->select('news.id', 'title', 'content', 'author', 'posted', 'users.name')->join('users', 'users.id', '=', 'news.author')->where('news.id', $id)->get();

        if (count($posts) == 0) {
            return redirect('/');
        }

        foreach ($posts as &$post)
            $post->start_time = (new \DateTime($post->posted))->format("F j, Y");


        return view('news')
            ->with('items', $posts)
            ->with('title', $posts[0]->title);

    }

}
