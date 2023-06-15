<x-layouts.app>
    <x-partials.alert />
    <a class="btn btn-primary mt-4" href="{{ route('invoices.create') }}">Rechnung erstellen</a>
    <div class="grid row-gap-4">
        <x-partials.invoice-table :invoices="$invoices"/>
    </div>
</x-layouts.app>
