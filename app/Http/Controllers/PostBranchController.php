<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PostBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  DB::table('post_branch')
        ->join('branch', 'branch.id_branch', '=', 'post_branch.id_branch')
        ->select('post_branch.id_post', 'post_branch.*','branch.*', DB::raw('COUNT(likes_post.id_post) as likes_count'))
        ->leftJoin('likes_post', 'post_branch.id_post', '=', 'likes_post.id_post')
        ->groupBy('post_branch.id_post')
        ->orderBy('fecha', 'desc')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
