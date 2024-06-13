@extends('layouts.admin')

@section('contenido')

<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Médico {{ $medico->id }}</h3>
        </div>

        <form action="{{ route('medico.update', $medico->id) }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre del médico" value="{{ $medico->nombre }}">
                </div> 

                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="Ingrese la especialidad" value="{{ $medico->especialidad }}">
                </div> 

                <div class="form-group">
                    <label for="aniosservicio">Años de Servicio</label>
                    <input type="text" class="form-control" name="aniosservicio" id="aniosservicio" placeholder="Ingrese los años de servicio" value="{{ $medico->aniosservicio }}">
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    @if ($medico->foto)
                        <img src="{{ asset('imagenes/medico/' . $medico->foto) }}" alt="{{ $medico->nombre }}" width="70px" height="70px" class="img-thumbnail">
                    @else
                        <p>No hay imagen disponible</p>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                <a href="{{ route('medico.index') }}" class="btn btn-danger me-1 mb-1">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
