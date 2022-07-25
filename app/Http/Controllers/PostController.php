<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController as ApiController;

use App\Models\Post;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


class PostController extends ApiController
{

    /**
     * Get the posts details from the api class controller.
     */
    public function getPosts(Request $request)
    {

        $postsCollection = ApiController::index();

        $data = $this->paginate($postsCollection, 9, $request->page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);


        return view('posts.posts', compact('data'));
    }

    /**
    * Function helper for pagination 
    */

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Get the specified posts details from the api class controller.
     */
    public function getPost($postId)
    {
        $post = ApiController::show($postId);

        return view('posts.post_details', compact('post'));
    }

    public function getPostUser($userId)
    {

        $user = Http::get('https://jsonplaceholder.typicode.com/users/' . $userId)->object();

        return $user;
    }
}
