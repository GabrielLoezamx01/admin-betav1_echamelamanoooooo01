<?php

namespace App\Http\Controllers;
use Throwable;
use App\Models\Publications;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validate      = 'HEY';
        $publicaciones = collect(Publications::where('status','1')->where('publications_id', $request->id)
        ->join('clients','publications.id_user','=','clients.uuid')
        ->join('services as s','publications.id_servicio','=','s.id')
        ->select('publications.*','clients.name','clients.last_name','clients.email','clients.phone','clients.andress','clients.photo','clients.validate as VALIDACION', 'clients.uuid as uuidCliente','s.name as nombre_servicio')
        ->orderBy('date','DESC')->first());
        $validate = [
            'session'     => session('uuid'),
            'basededatos' =>  $publicaciones->get('uuid')
        ];
        if(session('uuid') == $publicaciones->get('uuid')){
            $validate = 'nooo';
        }
        $database = DB::table('comments')->where('publications_id',$request->id)
            ->leftJoin('clients','comments.id_user_comments','=','clients.uuid')
            ->leftJoin('seller','comments.id_user_comments','=','seller.uuid')
            ->select('clients.name','clients.last_name','clients.photo','comments.*')
            ->orderByRaw('date ASC ')->get();
            return view('site.comment')->with(compact(
                'database',
                'publicaciones',
                'validate'
            ));
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
            $fecha      = date('Y-m-d H:i:s');
            $idp        = $request->publications_id ?? $request->idp;
            $uuid       = session('uuid');
            $comentario = $request->comentario ?? $request->contenido ?? 'Comentario';
            DB::table('comments')->insert([
                'comentario'       => $comentario,
                'publications_id'  => $idp,
                'reactions'        => 0,
                'id_user_comments' => $uuid,
                'date'             => $fecha
            ]);
            $json = [
                "type"    => 1,
                "id_post" => $idp
            ];
            DB::table('notifications')->insert([
                'titulo'      => 'Nuevo Comentario',
                'mensaje'     =>  $comentario,
                'fecha_envio' =>  $fecha,
                'leida'       => 0,
                'id_client'   => $request->uuidc,
                'json'        => json_encode($json)
            ]);
            if(isset($request->idp)){
                return redirect('comments?id='.$request->idp);
            }
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
