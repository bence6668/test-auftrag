<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class TempItemController extends Controller
{
    public function createTempItem(InvoiceItemRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        if (!Session::has('temp-items')) {
            Session::put('temp-items', []);
        }

        Session::push('temp-items', array_merge($fields, ['id' => count(Session::get('temp-items')) + 1]));

        return back();
    }

    public function deleteTempItem($invoiceItem): RedirectResponse
    {
        $items = Session::get('temp-items');
        unset($items[$invoiceItem]);
        Session::put('temp-items', $items);

        return back();
    }
}
