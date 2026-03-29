<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Invoice;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required',
            'description' => 'required|string',
            'expiry_date' => 'required|date',
            'payment' => 'required|numeric',
            'user' => 'required|string',
            'portal_id' => 'required|integer|exists:portals,id',
            'project' => 'required',
        ]);
        $user = User::where('id', $request->get('user'))->first();
        $path = $request->file('file')->store('files');
        $file = File::create([
            "filename" => $request->file("file")->getClientOriginalName(),
            "mime_type" => $request->file("file")->getClientMimeType(),
            "path" => $path,
            "visibility" => true,
        ]);

        Invoice::create([
            "name" => $request["name"],
            "file_id" => $file->id,
            "portal_id" => $request["portal_id"],
            "description" => $request["description"],
            "expiry_date" => $request["expiry_date"],
            "price" => $request["payment"],
            "user_id" => $request["user"],
            'project_id' => $request["project"],
        ]);
        $portal = Portal::where('id', $request["portal_id"])->first();
        $user->files()->attach($file->id);
        return view("invoice.index", compact('portal'));
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
        $file = File::where('id', $invoice->file->id)->first();
        $file->delete();
        $invoice->delete();
        $user = Auth::user();
        return view('portal.show', compact('portal', 'user'));
    }
    public function download(Invoice $invoice)
    {
        return response($invoice->file->content)->header('Content-Type', $invoice->file->mime_type)
            ->header('Content-Disposition', 'attachment; filename="'.$invoice->file->filename.'"');
    }
    public function payment(Portal $portal, Invoice $invoice)
    {
        $invoice->update([
            "price" => 0.00
        ]);
        return view('paymentSucceeded', compact('portal', 'invoice'));
    }
}
