<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Sucursales;
use DB;

class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return     = [];
        $sucursales = DB::table('branch')->where('delete',0)->get();
        foreach ($sucursales as $key => $item){
            $likes      = DB::table('love_branch')->where('id_branchR',$item->id_branch)->get();
            $return [] = [
                'sucursal' => $item,
                'likes' => $likes,
                'count' => $likes->count()
            ];
        }
        return view('site.sucursales')->with(compact('return'));
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
