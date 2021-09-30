<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = User::latest()->paginate(10);

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
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            
            $password = Hash::make($request->get('password'));
            
            User::create([
                'email' => $request->get('email'),
                'password' => $password,
            ]);


            return [
                'success' => true,
                'message' => 'Success, user created successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Error: ' . $th->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = User::find($id);

            return $data;
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Error: ' . $th->getMessage(),
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            User::find($id)->update($request->all());

            return [
                'success' => true,
                'message' => 'Success, user update successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Error: ' . $th->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::find($id)->delete();

            return [
                'success' => true,
                'message' => 'Success, user deleted successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Error: ' . $th->getMessage(),
            ];
        }
    }
}
