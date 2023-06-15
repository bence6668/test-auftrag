<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class InvoiceController extends Controller
{

    public function index(): View
    {
       $invoices = Invoice::with('address')->latest()->get();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    public function create(): View
    {
        $addresses = Address::all();
        $invoiceItems = Session::get('temp-items');

        return view('invoice.create', ['addresses' => $addresses, 'invoiceItems' => $invoiceItems]);

    }

    public function store(InvoiceRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $invoice = Invoice::create($fields);

        collect($fields['items'])->each(function ($item) use ($invoice) {
            $invoice->items()->create($item);
        });

        Session::forget('temp-items');

        return redirect()->to('/')->with('success', 'Rehcnung wurde erfolgreich erstellt');
    }

    public function edit(Invoice $invoice): View
    {
        $addresses = Address::all();

        return view('invoice.edit', ['invoice' => $invoice, 'invoiceItems' => $invoice->items, 'totals' => $invoice->getTotals(), 'addresses' => $addresses]);
    }

    public function update(InvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        $fields = collect($request->validated());

        $invoice->fill($fields->except('items')->toArray());

        if ($invoice->isDirty()) {
            $invoice->save();
        }

        $invoice->items->each(function (InvoiceItem $item) use ($fields) {
            $item->fill($fields->get('items')[$item->id]);

            if ($item->isDirty()) {
                $item->save();
            }
        });

        return back()->with('success', 'Rechnung wurde erfolgreich aktualisiert');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return redirect('/')->with('success', 'Rechnung wurde gelöscht');
    }
}
