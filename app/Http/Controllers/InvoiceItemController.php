<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceItemRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\RedirectResponse;

class InvoiceItemController extends Controller
{

    public function store(Invoice $invoice, InvoiceItemRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        $invoice->items()->create($fields);

        return back()->with('success', 'Position wurde hinzufügt');
    }

    public function destroy(InvoiceItem $invoiceItem): RedirectResponse
    {
        $invoiceItem->delete();

        return back()->with('success', 'Position wurde gelöscht');
    }
}
