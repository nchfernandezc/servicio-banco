<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Banco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BalanceRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $bancos = Banco::with('latestBalance')->paginate(10);

        return view('balance.index', compact('bancos'))
            ->with('i', ($request->input('page', 1) - 1) * $bancos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        Log::info('entrando al metodo create');
        $banco_id = $request->query('banco_id');
        Log::info('banco_id recibido: ' . $banco_id);

        $balance = new Balance;
        $bancos = Banco::all();

        return view('balance.create', compact('balance', 'bancos', 'banco_id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BalanceRequest $request): RedirectResponse
    {
        Balance::create($request->validated());

        return Redirect::route('balances.index')
            ->with('success', 'Balance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $balance = Balance::find($id);

        return view('balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $balance = Balance::find($id);
        $bancos = Banco::all();

        return view('balance.edit', compact('balance', 'bancos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BalanceRequest $request, Balance $balance): RedirectResponse
    {
        $balance->update($request->validated());

        return Redirect::route('balances.index')
            ->with('success', 'Balance updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Balance::find($id)->delete();

        return Redirect::route('balances.index')
            ->with('success', 'Balance deleted successfully');
    }
}
