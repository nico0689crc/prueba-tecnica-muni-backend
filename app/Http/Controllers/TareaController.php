<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = $request->query('pagesize', 10);
        $pageSize = is_numeric($pageSize) && $pageSize > 0 ? (int)$pageSize : 10;

        $currentPage = $request->query('page', 1);
        $currentPage = is_numeric($currentPage) && $currentPage > 0 ? (int)$currentPage : 1;

        if ($request->user()->cannot('viewAny', Tarea::class)) {
            $tareas = $request->user()->tareas()->paginate($pageSize, ['*'], 'page', $currentPage);
        } else {
            $tareas = Tarea::paginate($pageSize, ['*'], 'page', $currentPage);
        }

        return response()->json($tareas);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'detalles' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,en_progreso,completado',
            'prioridad' => 'nullable|in:baja,media,alta',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no puede tener más de 255 caracteres.',
            'detalles.string' => 'Los detalles deben ser una cadena de texto.',
            'estado.in' => 'El estado debe ser uno de los siguientes valores: pendiente, en_progreso, completado.',
            'prioridad.in' => 'La prioridad debe ser uno de los siguientes valores: baja, media, alta.',
        ]);

        $tarea = Tarea::create($validatedData);

        $tarea->usuarios()->attach($request->user()->id, ['estado' => 'finalizado']);

        return response()->json($tarea, 201);
    }

    public function show(Tarea $tarea, Request $request) {
        return response()->json($tarea);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $validatedData = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'detalles' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,en_progreso,completado',
            'prioridad' => 'nullable|in:baja,media,alta',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no puede tener más de 255 caracteres.',
            'detalles.string' => 'Los detalles deben ser una cadena de texto.',
            'estado.in' => 'El estado debe ser uno de los siguientes valores: Pendiente, En Progreso, Completado.',
            'prioridad.in' => 'La prioridad debe ser uno de los siguientes valores: Baja, Media, Alta.',
        ]);

        if (isset($validatedData['estado']) && $validatedData['estado'] === 'completado') {

            $tareasFinalizadasCount = $tarea->usuarios()->wherePivot('estado', '!=', 'finalizado')->count();

            if ($tareasFinalizadasCount > 0) {
                return response()->json([
                    'message' => 'No se puede marcar la tarea como completada hasta que todos los usuarios asignados hayan confirmado.'
                ], 400);
            }
        }

        $tarea_ = Tarea::findOrFail($tarea->id);
        $tarea_->update($validatedData);

        return response()->json($tarea_);
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json(['message' => 'Tarea eliminada correctamente',]);
    }
}
