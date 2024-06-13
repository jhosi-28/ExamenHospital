<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MedicoFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MedicoController extends Controller
{
    public function __construct()
    {
        // Constructor vacío
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('texto');

        
        $medicos = Medico::when($query, function ($query, $search) {
            return $query->where('nombre', 'like', '%' . $search . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(7);

        return view('almacen.medico.index', compact('medicos', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("almacen.medico.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicoFormRequest $request)
    {
        $medico = new Medico;
        $medico->nombre = $request->nombre;
        $medico->especialidad = $request->especialidad;
        $medico->aniosservicio = $request->aniosservicio;

        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $nombrefoto = Str::slug($request->nombre) . "." . $foto->guessExtension();
            $ruta = public_path("/imagenes/medico/");

            $foto->move($ruta, $nombrefoto);
            $medico->foto = $nombrefoto;
        }

        $medico->save();
        return redirect()->route('medico.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medico = Medico::findOrFail($id);
        return view("almacen.medico.show", compact('medico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);
        return view("almacen.medico.edit", compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicoFormRequest $request, $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->nombre = $request->nombre;
        $medico->especialidad = $request->especialidad;
        $medico->aniosservicio = $request->aniosservicio;

        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $nombrefoto = Str::slug($request->nombre) . "." . $foto->guessExtension();
            $ruta = public_path("/imagenes/medico/");

            $foto->move($ruta, $nombrefoto);
            $medico->foto = $nombrefoto;
        }

        $medico->save();
        return redirect()->route('medico.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();
        
        return redirect()->route('medico.index')
            ->with('success', 'Médico eliminado correctamente');
    }
}
