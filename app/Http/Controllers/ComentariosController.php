<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::table('comments')->insert([
                'comentario'       => $request->comentario,
                'publications_id'  => $request->publications_id,
                'reactions'        => 0,
                'id_user_comments' => session('uuid'),
                'date'      => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $e) {
            report($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return DB::table('comments')->where('publications_id',$id)
            ->join('clients','comments.id_user_comments','=','clients.uuid')
            ->select('clients.name','clients.last_name','clients.photo','comments.*')
            ->orderByRaw('date ASC ')->get();

        } catch (Throwable $e) {
            report($e);
        }

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
