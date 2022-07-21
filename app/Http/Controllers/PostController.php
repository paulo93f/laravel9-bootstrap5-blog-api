<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


class PostController extends Controller
{
    public function index(Request $request)
    {

        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        $posts = collect($posts)->map(function ($post) {
            $model = new Post();
            $model->user_id = $post['userId'];
            $model->id = $post['id'];
            $model->title = $post['title'];
            $model->body = $post['body'];
            return $model;
        });

        $data = $this->paginate($posts, 10, $request->page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);


        return view('posts.posts', compact('data'));
    }

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function paginate($items, $perPage = 5, $page = null, $options = [])

    {

        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
