<?php

namespace App\Http\Controllers;
use App\Models\Publications;
use Throwable;
use Psy\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(isset($request->search) && isset($request->id)){
            if($request->search){
                if(isset($request->id)){
                    $elementos = Publications::where('status','1')->where('id_servicio', $request->id)
                    ->join('clients','publications.id_user','=','clients.uuid')
                    ->join('services as s','publications.id_servicio','=','s.id')
                    ->select('publications.*','clients.name','clients.userName','clients.last_name','clients.email','clients.phone','clients.andress','clients.photo','clients.validate as VALIDACION', 'clients.uuid as uuidCliente','s.name as nombre_servicio')
                    ->orderBy('date','DESC')->paginate(10);
                }
            }
        }else{
            $elementos = Publications::where('status','1')
            ->leftjoin('clients','publications.id_user','=','clients.uuid')
            ->leftjoin('seller','publications.id_user','=','seller.uuid')
            ->join('services as s','publications.id_servicio','=','s.id')
            ->select('publications.*','clients.name','clients.userName','clients.last_name','clients.email','clients.phone','clients.andress','clients.photo','clients.validate as VALIDACION', 'clients.uuid as uuidCliente','s.name as nombre_servicio')
            ->orderBy('date','DESC')->paginate(10);
        }
        return response()->json($elementos);
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
            $servicie = $request->servicie == 0 ? 1 : $request->servicie;
            $user     = DB::table('clients')->where('uuid',session('uuid'))->first();
            $insert         = [
                'content'     => $request->content,
                'status'      => 1,
                'reactions'   => 0,
                'id_user'     => session('uuid'),
                'date'        => date('Y-m-d H:i:s'),
                'uuid'        => $request->uuid,
                'id_servicio' => $servicie
            ];
            $notify   = $this->sellerNotify($user->postal, $servicie, $request->uuid);
            return Publications::create($insert)->get();
        } catch (Throwable $e) {
            report($e);
        }
    }
    public function sellerNotify($postal , $servicio, $id_publicacion){
        $branch =  DB::table('branch')->where('postal_code',$postal)->get();

        foreach ($branch as $key => $value){
            if($value->id_service == $servicio){
             $database =   DB::table('seller_notify_p')->insert([
                    'id_p'        => $id_publicacion,
                    'id_user'     => session('uuid'),
                    'postal'      => $postal,
                    'id_servicie' => $servicio,
                    'status'      => 'A',
                    'id_seller'         => $value->id_seller,
                    'id_service_seller' => $value->id_service,
                    'time'  => date("Y-m-d H:i:s")
                ]);
            }else{
                    DB::table('seller_notify_p')->insert([
                    'id_p'        => $id_publicacion,
                    'id_user'     => session('uuid'),
                    'postal'      => $postal,
                    'id_servicie' => $servicio,
                    'status'      => 'F',
                    'id_seller'         => 0,
                    'id_service_seller' => 0,
                    'time'  => date("Y-m-d H:i:s")
                ]);
            }
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
            return Publications::where('uuid',$id)->first();
        } catch (Throwable $e) {
            return $e;
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
        try {
           return Publications::where('uuid',$id)->update(['content' => $request->cat_name]);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return Publications::where('uuid',$id)->update(['status' => 0]);
         } catch (Throwable $e) {
             return $e;
         }
    }
}
