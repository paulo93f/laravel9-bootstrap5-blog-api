<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * @OA\Info(title="API Post", version="1.0")
 *
 * @OA\Server(url="http://127.0.0.1:8000/")
 */
class ApiController extends Controller
{
    /**
     * Display a listing of the Posts resources and each User details.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/posts/",
     *      tags={"Blog API Documentation"},
     *     summary="Shows all posts",
     *     @OA\Response(
     *         response=200,
     *         description="Shows all posts."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error ocurred."
     *     )
     * )
     */
    public function index()
    {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
        $users = Http::get('https://jsonplaceholder.typicode.com/users')->json();

        $collection = collect($users);

        foreach ($posts as $index => $post) {

            $posts[$index]['user'] = $collection->where('id', $post['userId'])->first();
        }

        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $title
     * @param  string  $body
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *     path="/api/post/",
     *     tags={"Blog API Documentation"},
     *     summary="Insert a post",
     *      @OA\Parameter(
     *          name="title",
     *          description="Post title",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="body",
     *          description="Post body",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="userId",
     *          description="User id of the post",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Insert a post."
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post created."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error ocurred."
     *     )
     * )
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'userId' => 'required'
        ]);

        // $post = new Post([
        //     'title' => $request->get('title'),
        //     'body' => $request->get('body'),
        //     'userId' => $request->get('userId')
        // ]);

        // $post->save();

        // return redirect('/posts')->with('success', 'Post saved!');

        $response = Http::post('https://jsonplaceholder.typicode.com/posts/', [
            'title' => $request->title,
            'body' => $request->body,
            'userId' => $request->userId
        ]);

        return $response;
    }

    /**
     * @OA\Get(
     *      path="/api/post/{id}",
     *      tags={"Blog API Documentation"},
     *      summary="Get post and user information",
     *      description="Returns post and user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/' . $id)->json();

        $response['user'] = $this->getUser($response['userId']);

        return $response;
    }

    /**
     * @OA\Put(
     *      path="/api/post/{id}",
     *      tags={"Blog API Documentation"},
     *      summary="Update the post information",
     *      description="Update the post information",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="title",
     *          description="Post title",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="body",
     *          description="Post body",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="userId",
     *          description="User id of the post",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update(Request $request)
    {
        $response = Http::put('https://jsonplaceholder.typicode.com/posts/' . $request->id, [
            'id' => $request->id,
            'title' => $request->title,
            'body' => $request->body,
            'userId' => $request->userId
        ]);

        return $response;
    }

    /**
     * @OA\Delete(
     *      path="/api/post/{id}",
     *      tags={"Blog API Documentation"},
     *      summary="Delete a post",
     *      description="Delete a post",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function destroy($id)
    {
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/' . $id);

        return $response;
    }

    /**
     * Get the specified user details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUser($id)
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users/' . $id)->json();

        return $response;
    }
}
