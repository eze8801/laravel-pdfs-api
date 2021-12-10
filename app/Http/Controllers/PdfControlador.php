<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PdfControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdfs = Pdf::all();
        
        return response()->json([
            'status' => 1,
            'data' => $pdfs
        ]);
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
        $request->validate([
            'nombre' => 'required',
            'ref' => 'required|numeric',
            'titulo' => 'required',
            'archivo' => 'required|mimes:pdf'
        ]);

        $pdf = new Pdf();
        $pdf->nombre = $request->nombre;
        $pdf->ref = $request->ref;
        $pdf->titulo = $request->titulo;

        $archivo = $request->file('archivo');
        $nombre = date('YmdHis') . '.' . $archivo->getClientOriginalExtension();
        $archivo->move('assets/', $nombre);
        $pdf->archivo = $nombre;

        $pdf->save();

        return response()->json([
            'status' => 1,
            'data' => $pdf
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pdf = Pdf::findOrFail($id);

        return response()->json([
            'status' => 1,
            'data' => $pdf
        ]);
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
        $request->validate([
            'nombre' => 'required',
            'ref' => 'required|numeric',
            'titulo' => 'required'
        ]);

        $pdf = Pdf::find($id);
        $pdf->nombre = $request->nombre;
        $pdf->ref = $request->ref;
        $pdf->titulo = $request->titulo;
        $pdf->save();

        return response()->json([
            'status' => 1,
            'data' => $pdf
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pdf = Pdf::find($id);

        $path = 'assets/' . $pdf->archivo;

        if (File::exists($path)) {
            File::delete($path);
        }

        $pdf->delete();
        
        return response()->json([
            'status' => 1,
            'data' => $id
        ]);
    }

    public function obtenerPorRef($ref)
    {
        $pdfs = Pdf::where('ref', $ref)->get();

        return response()->json([
            'status' => 1,
            'data' => $pdfs
        ]);
    }
}
