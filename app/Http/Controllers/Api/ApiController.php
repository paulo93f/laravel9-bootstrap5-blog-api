<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    /**
     * Display a listing of the Posts resources and each User details.
     *
     * @return \Illuminate\Http\Response
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
            'userId' => $request->id
        ]);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/' . $id)->json();

        $response['user'] = $this->getUser($response['userId']);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string  $title
     * @param  string  $body
     * @param  int  $userId
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
