<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        return $response;
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
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/' . $id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $title
     * @param  string  $body
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put('https://jsonplaceholder.typicode.com/posts/' . $id, [
            'id' => $id,
            'title' => $request->title,
            'body' => $request->body,
            'userId' => $request->id
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
}
