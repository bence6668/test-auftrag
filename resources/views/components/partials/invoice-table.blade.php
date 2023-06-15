@props(['invoices'])

<table
    data-toggle="table"
    data-search="true"
    data-pagination="true"
    data-locale="de-DE"
>
    <thead>
    <tr>
        <th data-sortable="true">Nr.</th>
        <th data-sortable="true">Bestellnummer</th>
        <th data-sortable="true">Datum</th>
        <th data-sortable="true">Firma</th>
        <th data-sortable="true">Betrag</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->order_number }}</td>
            <td>{{ date('d.m.Y', strtotime($invoice->date)) }}</td>
            <td>{{ $invoice->address->company_name }}</td>
            <td>{{ $invoice->getTotals()['brutto'] }} CHF</td>
            <td><a href="{{ route('invoices.edit', ['invoice' => $invoice]) }}">
                    <button class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@push('scripts')
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table-locale-all.min.js"></script>
@endpush
