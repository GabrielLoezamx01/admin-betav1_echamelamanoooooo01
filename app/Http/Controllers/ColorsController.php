<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ColorsController extends Controller
{
    public function insert (Request $r){
        $imageName = '';
        $branch = $r->id_branch;

        $data = [
                "id_branch"      => $branch,
                "primary_color"  => $r->color_1 ?? '',
        ];
        if(isset($r->portada)){
            if ($r->hasFile("portada")) {
                $image = $r->file("portada");
                $path = $image->store('public/postSucursales/lating/'.$branch);
                $imageName = basename($path);
                $data['wallpaper_1'] = $imageName;
            }
        }
        if(isset($r->color_2)){
            $data['color_1'] = $r->color_2;
        }
        if(isset($r->color_3)){
            $data['color_2'] = $r->color_3;
        }
        $database = DB::table('setting_lating_page')->where('id_branch', $branch)->count();
        if($database){
            DB::table('setting_lating_page')
            ->where('id_branch', $branch)
            ->update($data);
        }else{
            DB::table('setting_lating_page')->insert($data);
        }
        return redirect('sucursal?id_branch='.$branch);
    }
}
