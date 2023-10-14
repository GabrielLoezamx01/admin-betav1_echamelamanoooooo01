<?php

namespace App\Http\Controllers;

use App\Models\c;
use Illuminate\Http\Request;
use DB;
use  App\Models\PostBranch;
class SettingsSucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $r = DB::table('setting_lating_page')->where('id_branch', $request->id_branch)->first();
        $settings = [
            "id_branch"      => $request->id_branch,
            "primary_color"  => $r->primary_color ?? '',
            "color_1"        => $r->color_1 ?? '',
            "color_2"        => $r->color_2 ?? '',
            "wallpaper_1"    => $r->wallpaper_1  ?? '',
        ];
        return view('site.sucursales.settings')->with(compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'contenido' => 'required|string',
            'Tittle'    => 'string',
            'image1'     => 'required'
        ]);
        $imagePaths = [];

        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile("image$i")) {
                $image = $request->file("image$i");
                $path = $image->store('public/postSucursales');
                $imageName = basename($path);
                $imagePaths["image$i"] = $imageName;
            }
        }
        $post = new PostBranch;
        $post->contenido   = $data['contenido'];
        $post->Tittle      = $data['Tittle'];
        $post->fecha       = now();
        $post->img_1       = $imagePaths['image1'];
        $post->img_2       = $imagePaths['image2'] ?? '';
        $post->img_3       = $imagePaths['image3'] ?? '';
        $post->Tittle      = $request->Tittle;
        $post->status      = 1;
        $post->id_branch   = $request->id_branch;
        $post->save();
        return redirect()->back()->with('success', 'Imágenes cargadas con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}
