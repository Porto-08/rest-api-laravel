<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Post::latest()->paginate(10);

            return $data;
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Error: ' . $th->getMessage(),
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            Post::create($request->all());

            return [
                'success' => true,
                'message' => 'Post created successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => "Error: " . $th->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Post::find($id);

            return [
                'success' => true,
                'message' => "Post found successfully.",
                $data,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => "Error: " . $th->getMessage(),
            ];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $data = Post::find($id);

            return [
                'success' => true,
                'message' => "Post found successfully.",
                $data,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => "Error: " . $th->getMessage(),
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);


        try {

            Post::find($id)->update($request->all());

            return [
                'success' => true,
                'message' => 'Post update successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => "Error: " . $th->getMessage(),
            ];
        }
    }

    /**
     * Filter the specified resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function search($data)
    {
        try {
            $filter = Post::where('title', 'like', '%' . $data . '%')->get();

            return [
                'success' => true,
                'message' => 'Posts found successfully.',
                'data' => $filter,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => "Error: " . $th->getMessage(),
                'data' => $filter,
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            Post::find($id)->delete();

            return [
                'success' => true,
                'message' => 'Post successfully deleted',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => "Error: " . $th->getMessage(),
            ];
        }
    }
}
