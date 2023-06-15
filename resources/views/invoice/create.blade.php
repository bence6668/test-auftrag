<x-layouts.app>
    <div class="card mt-4">
        <div class="card-body">
            <h1>Rechnung erstellen</h1>
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <x-forms.fields.input label="Bestellnummer" name="order_number" :value="old('order_number')"/>
                    </div>
                    <div class="col">
                        <x-forms.fields.select label="Rechnungsadresse" name="address_id">
                            <option @if(empty(old('address_id'))) selected @endif disabled>--- Rechnungsadresse auswählen ---</option>
                            @foreach($addresses as $address)
                                <option @if(old('address_id') == $address->id) selected @endif value="{{ $address->id }}">{{ $address->getFullAddress() }}</option>
                            @endforeach
                        </x-forms.fields.select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <x-forms.fields.input type="date" label="Rechungsdatum" name="date" :value="old('date')"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <x-forms.fields.textarea label="Bemerkung" name="notice" :value="old('notice')"/>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Rehcnung erstellen</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <h2>Positionen</h2>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPositionModal" >Neue Position</button>
                    </div>
                    @error('items')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @if($invoiceItems)
                        <div class="mt-2">
                            @foreach($invoiceItems as $item)
                                <div class="card">
                                    <div class="card-body">
                                        <x-forms.invoice-item-edit :item="$item" :onCreationView="true"/>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('invoices.temp-item.create') }}" method="POST">
                    @csrf
                    <x-forms.invoice-item-create />
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
