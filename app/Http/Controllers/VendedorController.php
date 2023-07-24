<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Tools\Settings;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_sucursales = count(DB::table('branch')->where('id_seller', session('uuid'))->get()) > 0 ? DB::table('branch')->where('id_seller', session('uuid'))->get() : [] ;
        return view('site.vendedor')->with('branch', $main_sucursales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data       = Settings::validate_auto($request->all());
        $validated  = $request->validate($data);
        $this->saveDatabase($this->arrayBranch($request), 'branch');
        return redirect('mis_sucursales');
    }
    private function arrayBranch($request)
    {
        $nombreArchivo = '';
        if (isset($request->img)) {
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $extension = $request->file('img')->extension();
                $nombreArchivo = time() . '_' . uniqid() . '.' . $extension;
                $request->file('img')->storeAs('public/sucursales', $nombreArchivo);
            }
        }
        return [
            'id_seller'   => session('uuid'),
            'name_branch' => $request->nombre,
            'street'      => $request->calle,
            'address'     => $request->direccion,
            'city'        => $request->ciudad,
            'state'       => 'A',
            'postal_code' => $request->postal,
            'delete'      => 0,
            'id_service'  => $request->servicio,
            'description' => $request->descripcion,
            'span'        => isset($request->span)  ? $request->span : 0,
            'rang'        => isset($request->rang)  ? $request->rang : 0,
            'image'       => $nombreArchivo,
            'id_like'     => isset($request->likes) ? $request->like : 0,
            'maps'        => '',
            'rfc'         => isset($request->rfc)   ? $request->rfc : 0
        ];
    }
    private function saveDatabase(array $data, string $table)
    {
        DB::table($table)->insert($data);
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
