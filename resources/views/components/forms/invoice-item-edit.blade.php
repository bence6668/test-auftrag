@props(['item', 'onCreationView' => false])

<div id="item-{{ $item['id'] }}">
    <div class="row">
        <div class="col">
            <x-forms.fields.input label="Beschreibung" name="items[{{ $item['id'] }}][title]"
                                  :value="old('title', $item['title'])"/>
        </div>
        <div class="col">
            <x-forms.fields.input label="Menge" name="items[{{ $item['id'] }}][qty]" :value="old('qty', $item['qty'])"
                                  type="number"/>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <x-forms.fields.input label="Preis" name="items[{{ $item['id'] }}][price]"
                                  :value="old('price', $item['price'])" type="number" id="price-{{$item['id']}}"/>
        </div>
        <div class="col">
            <x-forms.fields.input label="Rabatt" name="items[{{ $item['id'] }}][discount]"
                                  :value="old('discount', $item['discount'])" type="number"
                                  id="discount-{{$item['id']}}"/>
        </div>
        <div class="col">
            <x-forms.fields.input label="Price mit Rabatt" name="items[{{ $item['id'] }}][price_with_discount]"
                                  :value="old('price_with_discount', $item['price_with_discount'])" type="number"
                                  id="price_with_discount-{{$item['id']}}" readonly class="item-total-field"/>
        </div>
        <div class="col">
            <label for="tax" class="form-label">MWST</label>
            <select class="form-select" aria-label="Default select example" id="tax"
                    name="items[{{ $item['id'] }}][tax]">
                <option value="7.7">7.7%</option>
            </select>
        </div>
        <div class="col d-flex justify-content-center py-3">
            @if(!$onCreationView)
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#delete-item-{{ $item['id'] }}"
                >
                    <i class="bi bi-trash"></i>
                </button>
            @endif
        </div>
    </div>
</div>

@if(!$onCreationView)
    <x-partials.modal id="delete-item-{{  $item['id'] }}">
        <x-slot:header>
            <h5 class="modal-title" id="exampleModalLabel">Wollen Sie dieser Position löschen?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </x-slot:header>
        <x-slot:footer>
            <form action="{{ route('invoice-items.delete', ['invoiceItem' =>  $item['id']]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                <button type="submit" class="btn btn-danger">Position löschen</button>
            </form>
        </x-slot:footer>
    </x-partials.modal>
@endif
@push('scripts')
    <script>
        let newPriceField_{{$item['id']}} = document.querySelector('#price-{{ $item['id'] }}');
        let newDiscountField_{{$item['id']}} = document.querySelector('#discount-{{ $item['id'] }}');
        let priceWithDiscountField_{{$item['id']}} = document.querySelector('#price_with_discount-{{$item['id']}}');

        newPriceField_{{$item['id']}}.addEventListener("change", () => {
            priceWithDiscountField_{{$item['id']}}.value = newDiscountField_{{$item['id']}}.value ?
                newPriceField_{{$item['id']}}.value - newPriceField_{{$item['id']}}.value * newDiscountField_{{$item['id']}}.value / 100 :
                newPriceField_{{$item['id']}}.value;
        });

        newDiscountField_{{$item['id']}}.addEventListener("change", () => {
            priceWithDiscountField_{{$item['id']}}.value = newPriceField_{{$item['id']}}.value ?
                newPriceField_{{$item['id']}}.value - newPriceField_{{$item['id']}}.value * newDiscountField_{{$item['id']}}.value / 100 :
                0;
        });
    </script>
@endpush
