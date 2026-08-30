<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Portal;
use App\Models\User;
use App\Services\FileStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    private FileStorageService $storageService;

    public function __construct(FileStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Portal $portal)
    {
        return view('invoice.index', compact('portal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Portal $portal)
    {
        return view('invoice.create', compact('portal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Portal $portal, InvoiceRequest $request)
    {
        $data = $request->validated();
        $file = $this->storageService->storeDocument($request->file('file'), true);

        $invoice = Invoice::query()->create([...$data,
            'file_id' => $file->id,
        ]);

        $invoice->user->files()->attach($file->id);

        return view('invoice.index', compact('portal'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, Invoice $invoice)
    {
        $user = Auth::user();

        return view('invoice.show', compact('invoice', 'portal', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portal $portal, Invoice $invoice)
    {
        return view('invoice.edit', compact('invoice', 'portal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Portal $portal, Request $request, Invoice $invoice)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'expiry_date' => 'required|date',
            'price' => 'required|numeric',
            'user_id' => 'required',
        ]);
        $invoice->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portal $portal, Invoice $invoice)
    {
        $this->storageService->delete($invoice->file);

        $invoice->delete();
        $user = Auth::user();

        return view('portal.show', compact('portal', 'user'));
    }

    public function download(Portal $portal, Invoice $invoice)
    {
        return $this->storageService->download($invoice->file);
    }

    public function payment(Portal $portal, Invoice $invoice)
    {
        $invoice->update([
            'price' => 0.00,
        ]);

        return view('invoice.payment', compact('portal', 'invoice'));
    }
}
