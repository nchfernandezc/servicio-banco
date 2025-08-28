<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AuditoriaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $auditorias = Auditoria::with(['movimiento.user', 'movimiento.bancoEmisor', 'movimiento.bancoReceptor'])
            ->latest('fecha_registro')
            ->paginate(15);

        return view('auditoria.index', compact('auditorias'))
            ->with('i', ($request->input('page', 1) - 1) * $auditorias->perPage());
    }

    /**
     * Show the reports page with filters.
     */
    public function reportes(Request $request): View
    {
        $query = Auditoria::with(['movimiento.user', 'movimiento.bancoEmisor', 'movimiento.bancoReceptor'])
            ->latest('fecha_registro');

        // Aplicar filtros
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_registro', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_registro', '<=', $request->fecha_fin);
        }

        if ($request->filled('tipo_movimiento')) {
            $query->whereHas('movimiento', function($q) use ($request) {
                $q->where('tipo_movimiento', $request->tipo_movimiento);
            });
        }

        $auditorias = $query->paginate(25)->appends($request->query());

        return view('auditoria.reportes', compact('auditorias'));
    }

    /**
     * Generate PDF report.
     */
    public function generarReportePdf(Request $request)
    {
        $query = Auditoria::with(['movimiento.user', 'movimiento.bancoEmisor', 'movimiento.bancoReceptor'])
            ->latest('fecha_registro');

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_registro', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_registro', '<=', $request->fecha_fin);
        }

        if ($request->filled('tipo_movimiento')) {
            $query->whereHas('movimiento', function($q) use ($request) {
                $q->where('tipo_movimiento', $request->tipo_movimiento);
            });
        }

        $auditorias = $query->get();
        $filtros = [
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'tipo_movimiento' => $request->tipo_movimiento,
        ];

        $pdf = PDF::loadView('pdf.auditorias', compact('auditorias', 'filtros'))
                 ->setPaper('a4', 'landscape');

        $nombreArchivo = 'reporte-auditoria-' . now()->format('Y-m-d-His') . '.pdf';
        
        return $pdf->stream($nombreArchivo);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $auditoria = new Auditoria();

        return view('auditoria.create', compact('auditoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuditoriaRequest $request): RedirectResponse
    {
        Auditoria::create($request->validated());

        return Redirect::route('auditorias.index')
            ->with('success', 'Auditoria created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $auditoria = Auditoria::with([
            'movimiento' => function($query) {
                $query->with(['user', 'bancoEmisor', 'bancoReceptor']);
            }
        ])->findOrFail($id);

        return view('auditoria.show', compact('auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $auditoria = Auditoria::find($id);

        return view('auditoria.edit', compact('auditoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuditoriaRequest $request, Auditoria $auditoria): RedirectResponse
    {
        $auditoria->update($request->validated());

        return Redirect::route('auditorias.index')
            ->with('success', 'Auditoria updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Auditoria::find($id)->delete();

        return Redirect::route('auditorias.index')
            ->with('success', 'Auditoria deleted successfully');
    }
}
