<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Throwable;
use Illuminate\Http\Request;
class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::where('cat_status', 'A')->get();
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
            return Category::create($request->all())->get();
        } catch (Throwable $e) {
            report($e);
        }
        // EL REQUEST DEBE MANDAR EL ARRAY.... SE VALIDA CON FRONDEND
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::where('cat_uuid', $id)->first();
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
        return Category::where('cat_uuid', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Category::where('cat_uuid', $id)->update(['cat_status' => 'E']);
        // ELIMINA PERMANENTE
        // Category::destroy(1);
    }
}
