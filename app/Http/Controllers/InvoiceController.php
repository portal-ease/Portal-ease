<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Portal;
use App\Services\FileStorageService;

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

        return redirect()->route('portal.invoice.index', [
            'portal' => $portal,
        ])->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, Invoice $invoice)
    {
        return view('invoice.show', [
            'portal' => $portal,
            'invoice' => $invoice,
            'user' => auth()->user(),
        ]);
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
    public function update(Portal $portal, InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portal $portal, Invoice $invoice)
    {
        $this->storageService->delete($invoice->file);

        $invoice->delete();

        return redirect()->route('portal.invoice.index', [
            'portal' => $portal,
        ])->with('success', 'Invoice deleted successfully.');
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
