<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;

class ViewSucursalController extends Controller
{
    public function index(Request $request){
        try{
            $s = Branch::findOrFail($request->id_branch);
            if(!empty($s)){
                $publicaciones  = DB::table('post_branch')->where('id_branch',$s->id_branch)->get();
                $opinions       = DB::table('branch_opinions as b')
                ->join('clients as c','b.id_client','c.uuid')
                ->where('b.id_branch',$s->id_branch)
                ->select('b.*','c.uuid as id_client','c.name','c.last_name','c.userName','c.photo')
                ->get();
                $r = DB::table('setting_lating_page')->where('id_branch', $request->id_branch)->first();

                $json = [
                    'branch'   => $s,
                    'post'     => $publicaciones,
                    'opinions' => $opinions,
                    'ux'       => $r
                ];
                unset($publicaciones);
                unset($r);
                unset($opinions);
                unset($s);
                return view('site.sucursales.index')->with(compact('json'));
            }
        }
        catch (ModelNotFoundException $e) {
            return redirect('Bienvenido');
        }

    }
}
