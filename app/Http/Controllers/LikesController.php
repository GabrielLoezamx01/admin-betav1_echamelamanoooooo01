<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikesPost;
use Illuminate\Support\Facades\Session;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $query     = [];
    public function index(Request $request)
    {
        $data = $request->validate([
            'id_post' => 'required',
        ]);
        return LikesPost::where(['id_post'  =>  $data['id_post'], 'deslike' => 0])->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required',
            'id_post' => 'required',
        ]);
        $uuid_user     = Session('uuid');
        if ($data['id_user'] == $uuid_user) {
            $this->query        = [
                'id_post'       => $data['id_post'],
                'id_seller'     => Session('type_user') == 'V' ? $uuid_user : 0,
                'id_user'       => Session('type_user') == 'C' ? $uuid_user : 0,
                'deslike'       => 0
            ];
            try {
                $updateLike        = LikesPost::where($this->query)->get()->isEmpty() ? $this->update(true) : $this->update(false);
                if ($updateLike) {
                    $query['time'] = now();
                    return LikesPost::create($query);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error interno del servidor'], 500);
            }
        } else {
            return response()->json(['error' => 'Error con la id de usuario modificado'], 500);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($validate = false)
    {
        return LikesPost::where($this->query)->update(['deslike' => $validate == true ? 1 : 0]) ?? false;
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
