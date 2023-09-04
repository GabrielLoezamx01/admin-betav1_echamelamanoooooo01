<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikesPost;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    private $query = [];
    public function __construct()
    {
        $this->query = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data   = $request->validate([
            'id_post' => 'required',
        ]);
        $ids       = explode(',', $request->id_post);
        $uniqueIds = array_unique($ids);
        $data      = [];
        $likesData = DB::table('likes')
            ->whereIn('id_post', $uniqueIds)
            ->select('id_post', 'id_seller', 'id_user')->get();
        $array     = json_decode($likesData,true);
        $likesData = collect($array);
        foreach ($likesData as $like){
            $id_post         = $like['id_post'];
            $total           = $likesData->where('id_post',$id_post)->count();
            if(array_key_exists($id_post, $data)){
                $data[$id_post]['id_seller'] [] = $like['id_seller'];
                $data[$id_post]['id_user'] []   = $like['id_user'];
                array_unique($data[$id_post]['id_seller']);
                array_unique($data[$id_post]['id_user']);
            }else{
                $push['sessionUuid']      = session('uuid');
                $push['total']     = $total;
                $push['id_seller'] = [$like['id_seller']];
                $push['id_user']   = [$like['id_user']];
                $push['total']     = $total;
                $data [$id_post]   = $push;
            }
        }
        return $data;
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
        $this->query   = [
            'id_post'       => $data['id_post'],
            'id_seller'     => Session('type_user') == 'V' ? $uuid_user : '0',
            'id_user'       => Session('type_user') == 'C' ? $uuid_user : '0',
        ];
        $comparacion   = LikesPost::where($this->query)->exists();
        if($comparacion){
            return  LikesPost::where($this->query)->delete();
        }else{
                $this->query['time']    = now();
                return LikesPost::create($this->query);
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
    public function update(bool $validate = false)
    {
        $update = LikesPost::where($this->query)->update(
            ['deslike' => $validate == true ? 1 : 0]
        );
        return $update;
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
