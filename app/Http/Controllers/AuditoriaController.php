<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AuditoriaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $auditorias = Auditoria::paginate();

        return view('auditoria.index', compact('auditorias'))
            ->with('i', ($request->input('page', 1) - 1) * $auditorias->perPage());
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
        $auditoria = Auditoria::find($id);

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
