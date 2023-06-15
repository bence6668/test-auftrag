
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Position erstellen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col">
                <x-forms.fields.input label="Beschreibung" name="title" :value="old('title')"/>
            </div>
            <div class="col">
                <x-forms.fields.input label="Menge" name="qty" :value="old('qty')" type="number"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-forms.fields.input label="Preis" name="price" :value="old('price')" type="number" id="price-new"/>
            </div>
            <div class="col">
                <x-forms.fields.input label="Rabatt" name="discount" :value="old('discount')" type="number" id="discount-new"/>
            </div>
            <div class="col">
                <x-forms.fields.input label="Price mit Rabatt" name="price_with_discount" :value="old('price_with_discount')" type="number" id="price_with_discount-new" readonly/>
            </div>
            <div class="col">
                <x-forms.fields.select label="MWST" name="tax">
                    <option value="7.7">7.7%</option>
                </x-forms.fields.select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary">Position erstellen</button>
    </div>

@push('scripts')
    <script>
        let newPriceField_new = document.querySelector('#price-new');
        let newDiscountField_new = document.querySelector('#discount-new');
        let priceWithDiscountField_new = document.querySelector('#price_with_discount-new');

        newPriceField_new.addEventListener("change", () => {
            priceWithDiscountField_new.value = newDiscountField_new.value ?
                newPriceField_new.value - newPriceField_new.value * newDiscountField_new.value/100 :
                newPriceField_new.value;
        });

        newDiscountField_new.addEventListener("change", () => {
            priceWithDiscountField_new.value = newPriceField_new.value ?
                newPriceField_new.value - newPriceField_new.value * newDiscountField_new.value/100 :
                0;
        });
    </script>
@endpush
