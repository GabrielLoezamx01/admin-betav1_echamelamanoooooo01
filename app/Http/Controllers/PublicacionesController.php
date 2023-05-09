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
    public function index()
    {
        $elementos = Publications::where('status','1')
        ->join('clients','publications.id_user','=','clients.uuid')
        ->select('publications.*','clients.name','clients.last_name','clients.email','clients.phone','clients.andress','clients.photo')
        // ->join('clients','publications.id_user','=','clients.id')
        ->orderBy('date','DESC')->paginate(10);
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
            $insert         = [
                'content'   => $request->content,
                'status'    => 1,
                'reactions' => 0,
                'id_user'   => session('uuid'),
                'date'      => date('Y-m-d H:i:s'),
                'uuid'      => $request->uuid
            ];
            return Publications::create($insert)->get();
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

            // return [
            //     'comments'    => $comments,
            //  //   'publication' => Publications::where('publications_id',$id)->first(),
            // ];
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
