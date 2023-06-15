<x-layouts.app>
    <x-partials.alert />
    <div class="card my-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a class="btn btn-primary" href="/">Zurück zum Übersicht</a>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-invoice" >Rehcnung löschen</button>
                </div>
            </div>
            <h1 class="mt-4">Rechnung {{ $invoice->order_number }} bearbeiten</h1>
            <form action="{{ route('invoices.update', ['invoice' => $invoice->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col">
                        <x-forms.fields.input label="Bestellnummer" name="order_number" :value="old('order_number', $invoice->order_number)"/>
                    </div>
                    <div class="col">
                        <x-forms.fields.select label="Rechnungsadresse" name="address_id">
                            @foreach($addresses as $address)
                                <option @selected(old('address_id', $invoice->address->id) == $address->id) value="{{ $address->id }}">{{ $address->getFullAddress() }}</option>
                            @endforeach
                        </x-forms.fields.select>
                    </div>
                </div>
                <div class="row">
                    <x-forms.fields.input type="date" label="Rechungsdatum" name="date" :value="old('date', $invoice->date)"/>
                </div>
                <div class="row">
                    <div class="col">
                        <x-forms.fields.textarea label="Bemerkung" name="notice" :value="old('notice', $invoice->notice)"/>
                    </div>
                </div>
                <button class="btn btn-primary mt-4" type="submit" >Rechnung bearbeiten</button>
                <div class="row mt-4">
                    <div class="col">
                        <h2>Positionen</h2>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPositionModal" >Neue Position</button>
                    </div>
                </div>
                @if($invoiceItems->count())
                    <div class="mt-2">
                        @foreach($invoiceItems as $item)
                            <div class="card">
                                <div class="card-body">
                                    <x-forms.invoice-item-edit :item="$item" :onCreationView="true"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-end">
                        <p id="netto-field">Total netto CHF <span class="fw-bold">{{ $totals['netto'] }}</span></p>
                        <p id="tax-field">MWST 7.7% CHF <span class="fw-bold">{{ $totals['mwst'] }}</span></p>
                        <p id="total-field">Total brutto CHF <span class="fw-bold">{{ $totals['brutto'] }}</span></p>
                    </div>
                @endif
                @error('items')
                    <p class="text-danger">Die Rechnung muss mindestens 1 Position enthalten</p>
                @enderror
            </form>
        </div>
    </div>

    <x-partials.modal id="delete-invoice">
        <x-slot:header>
            <h5 class="modal-title" id="exampleModalLabel">Wollen Sie diese Rechnung löschen?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </x-slot:header>
        <x-slot:footer>
            <form action="{{ route('invoices.destroy', ['invoice' => $invoice->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                <button type="submit" class="btn btn-danger">Rechnung löschen</button>
            </form>
        </x-slot:footer>
    </x-partials.modal>

    <div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('invoice-item.store', ['invoice' => $invoice->id]) }}" method="POST">
                    @csrf
                    <x-forms.invoice-item-create/>
                </form>
            </div>
        </div>
    </div>



    @if($errors->has(['title']) || $errors->has(['qty']) || $errors->has(['price'])|| $errors->has(['discount']) || $errors->has(['price_with_discount']) || $errors->has(['tax']))
        @push('scripts')
            <script>
                $(document).ready(function(){
                    $("#addPositionModal").modal('show');
                });
            </script>
        @endpush
    @endif
</x-layouts.app>
