<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BancoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $bancos = Banco::paginate();

        return view('banco.index', compact('bancos'))
            ->with('i', ($request->input('page', 1) - 1) * $bancos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $banco = new Banco();

        return view('banco.create', compact('banco'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BancoRequest $request): RedirectResponse
    {
        //Banco::create($request->validated());

        $banco = Banco::create($request->all());
        $balance = $banco->actualizarBalanceBanco();

        return Redirect::route('bancos.index')
            ->with('success', 'Banco created successfully. Balance: ' . ($balance ?? 'Error'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $banco = Banco::find($id);

        return view('banco.show', compact('banco'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $banco = Banco::find($id);

        return view('banco.edit', compact('banco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BancoRequest $request, Banco $banco): RedirectResponse
    {
        $banco->update($request->validated());

        return Redirect::route('bancos.index')
            ->with('success', 'Banco updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Banco::find($id)->delete();

        return Redirect::route('bancos.index')
            ->with('success', 'Banco deleted successfully');
    }
}
