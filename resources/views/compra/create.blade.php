@extends('template')

@section('title', __('messages.purchases.create'))

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.purchases.create') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">{{ __('messages.menus.purchases') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.purchases.create') }}</li>
    </ol>
</div>

<form action="{{ route('compras.store') }}" method="post">
    @csrf
    <div class="container mt-4">
        <div class="row gy-4">

            <!-- Purchase -->
            <div class="col-md-8">
                <div class="text-white bg-primary p-1 text-center">
                    {{ __('messages.purchases.details') }}
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row">

                        <!-- Producto -->
                        <div class="col-md-12 mb-2">
                            <select
                                class="form-control selectpicker show-tick"
                                data-live-search="true" data-size="3"
                                title="{{ __('messages.forms.fields.option.select_product') }}"
                                name="producto_id" id="producto_id">
                                @foreach($productos as $item)
                                    <option value="{{ $item->id }}">{{ $item->codigo.'-'.$item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cantidad -->
                        <div class="col-md-4 mb-2">
                            <label for="cantidad" class="form-label">{{ __('messages.forms.fields.quantity') }}</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control"/>
                            @error('cantidad')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Precio de Compra -->
                        <div class="col-md-4 mb-2">
                            <label for="precio_compra" class="form-label">{{ __('messages.forms.fields.purchase_price') }}</label>
                            <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1"/>
                            @error('precio_compra')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Precio de Venta -->
                        <div class="col-md-4 mb-2">
                            <label for="precio_venta" class="form-label">{{ __('messages.forms.fields.selling_price') }}</label>
                            <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1"/>
                            @error('precio_venta')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Boton para agregar -->
                        <div class="col-md-12 mb-2 mt-2 text-end">
                            <button type="button" id="btn_add_product" class="btn btn-primary">{{ __('messages.buttons.add') }}</button>
                        </div>

                        <!-- Tabla para el detalle de la compra -->
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="details_table" class="table table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="text-white">#</th>
                                            <th class="text-white">{{ __('messages.forms.fields.product') }}</th>
                                            <th class="text-white">{{ __('messages.forms.fields.quantity') }}</th>
                                            <th class="text-white">{{ __('messages.forms.fields.purchase_price') }}</th>
                                            <th class="text-white">{{ __('messages.forms.fields.selling_price') }}</th>
                                            <th class="text-white">{{ __('messages.columns.subtotal') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">{{ __('messages.columns.subtotal') }}</th>
                                            <th class="text-end" colspan="2">
                                                <span id="sums">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">{{ __('messages.columns.tax_name') }}</th>
                                            <th class="text-end" colspan="2">
                                                <span id="totalTaxes">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">{{ __('messages.columns.total') }}</th>
                                            <th class="text-end" colspan="2">
                                                <input type="hidden" name="total" value="0" id="inputTotal">
                                                <span id="total">0</span>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Boton para cancelar compra -->
                        <div class="col-md-12 mb-2">
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelPurchaseModal">
                                {{ __('messages.buttons.cancel_purchase') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product -->
            <div class="col-md-4">
                <div class="text-white bg-success p-1 text-center">
                    {{ __('messages.purchases.generals') }}
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        <!-- Proveedor-->
                        <div class="col-md-12 mb-2">
                            <label for="proveedore_id" class="form-label">{{ __('messages.forms.fields.supplier') }}</label>
                            <select
                                data-live-search="true" data-size="2"
                                title="{{ __('messages.forms.fields.option.select_one') }}"
                                class="form-control selectpicker show-tick"
                                name="proveedore_id" id="proveedore_id"
                            >
                                @foreach ($proveedores as $item)
                                    <option value="{{ $item->id }}">{{ $item->persona->razon_social }}</option>
                                @endforeach
                            </select>
                            @error('proveedore_id')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Tipo de Comprobante -->
                        <div class="col-md-12 mb-2">
                            <label for="comprobante_id" class="form-label">{{ __('messages.forms.fields.voucher') }}</label>
                            <select
                                data-live-search="true" data-size="2"
                                title="{{ __('messages.forms.fields.option.select_one') }}"
                                class="form-control selectpicker show-tick"
                                name="comprobante_id" id="comprobante_id"
                            >
                                @foreach ($comprobantes as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipo_comprobante }}</option>
                                @endforeach
                            </select>
                            @error('comprobante_id')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Número de Comprobante -->
                        <div class="col-md-12 mb-2">
                            <label for="numero_comprobante" class="form-label">{{ __('messages.forms.fields.voucher_number') }}</label>
                            <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control"/>
                            @error('numero_comprobante')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Impuesto -->
                        <div class="col-md-6 mb-2">
                            <label for="impuesto" class="form-label">{{ __('messages.forms.fields.tax') }}</label>
                            <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-success"/>
                            @error('impuesto')
                                <small class="text-danger">{{'*' . $message}}</small>
                            @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="col-md-6 mb-2">
                            <label for="fecha" class="form-label">{{ __('messages.forms.fields.date') }}</label>
                            <input readonly type="text" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>"/>
                            <?php
                                use Carbon\Carbon;
                                $fecha_hora = Carbon::now()->toDateTimeString();
                            ?>
                            <input type="hidden" name="fecha_hora" value="{{ $fecha_hora }}">
                        </div>

                        <div class="col-md-12 mb-2 text-center">
                            <button id="btn_save" type="submit" class="btn btn-success">{{ __('messages.buttons.save') }}</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal to cancel purchase-->
    <div class="modal fade" id="cancelPurchaseModal" tabindex="-1" aria-labelledby="cancelPurchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelPurchaseModalLabel">{{ __('messages.modals.confirmation_message_title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('messages.modals.confirmation_message_cancel_purshase') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.buttons.close') }}</button>
                    <button id="btn_cancel_purchase" type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('messages.buttons.confirm') }}</button>
                </div>
            </div>
        </div>
    </div>

</form>


@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btn_add_product').click(function(){
            addProduct();
        });

        $('#btn_cancel_purchase').click(function(){
            console.log('btn_cancel_purchase');
            cancelPurchase();
        });

        // hide or show buttons
        hideOrShowButtons();

        $('#impuesto').val(`${tax}%`);
    });

    let count = 0;
    let subtotal = [];
    let sums = 0;
    let totalTaxes = 0;
    let total = 0;

    function addProduct(){
        let productId = $('#producto_id').val();
        let nameProduct = ($('#producto_id option:selected').text()).split('-')[1];
        let quantity = $('#cantidad').val();
        let purchasePrice = $('#precio_compra').val();
        let sellingPrice = $('#precio_venta').val();

        // Validate
        if ( (nameProduct != '' && nameProduct != undefined) && quantity != '' && purchasePrice != '' && sellingPrice != '' ) {
            // Check value
            if ( parseInt(quantity) > 0 && (quantity%1 == 0) && parseFloat(purchasePrice) > 0 && parseFloat(sellingPrice) > 0 ) {

                if ( parseFloat(sellingPrice) >  parseFloat(purchasePrice) ) {

                    subtotal[count] = round(quantity*purchasePrice);
                    sums += subtotal[count];
                    totalTaxes = round(sums/100 * tax);
                    total = round(sums + totalTaxes);

                    let row = `<tr id="row${count}">
                            <th>${count+1}</th>
                            <td><input type="hidden" name="arrayproductoid[]" value="${productId}">${nameProduct}</td>
                            <td><input type="hidden" name="arrayquantity[]" value="${quantity}">${quantity}</td>
                            <td><input type="hidden" name="arraypurchaseprice[]" value="${purchasePrice}">${purchasePrice}</td>
                            <td><input type="hidden" name="arraysellingprice[]" value="${sellingPrice}">${sellingPrice}</td>
                            <td>${subtotal[count]}</td>
                            <td><button class="btn btn-danger" type="button" onClick="deleteProduct(${count})"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>`;

                    $('#details_table').append(row);
                    clearFields();
                    count++;

                    // hide or show buttons
                    hideOrShowButtons();

                    // Show calculate fields
                    showValues();
                } else {
                    showTostModal(`{{ __('messages.forms.fields.incorrect_purchase_price') }}`);
                }
            }else{
                showTostModal(`{{ __('messages.forms.fields.incorrect_values') }}`);
            }
        } else {
            showTostModal(`{{ __('messages.forms.fields.fields_missing') }}`);
        }
    }

    function clearFields() {
        let select =  $('#producto_id');
        select.selectpicker();
        select.selectpicker('val', '');
        $('#cantidad').val('');
        $('#precio_compra').val('');
        $('#precio_venta').val('');
    }

    function deleteProduct(index){
        // Calculate values
        sums -= round(subtotal[index]);
        totalTaxes = round(sums/100 * tax);
        total = round(sums + totalTaxes);

        // Show calculate fields
        showValues();

        // Remove row from table
        $('#row'+index).remove();

        // hide or show butons
        hideOrShowButtons();

    }

    function showValues(){
        // Show calculate fields
        $('#sums').html(currencyFormatter({currency:locale_currency, value:sums}));
        $('#totalTaxes').html(currencyFormatter({currency:locale_currency, value:totalTaxes}));
        $('#total').html(currencyFormatter({currency:locale_currency, value:total}));
        $('#impuesto').val(totalTaxes);
        $('#inputTotal').val(total);
    }

    function cancelPurchase(){
        // Remove the tbody from details table
        $('#details_table > tbody').empty();
        // Add new row to details table
        let row = `<tr>
            <th></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>`;

        $('#details_table').append(row);

        count = 0;
        subtotal = [];
        sums = 0;
        totalTaxes = 0
        total = 0;

        // Show calculate fields
        showValues();
        $('#impuesto').val(`${tax}%`);

        // clear fields from details table
        clearFields();

        // hide or show butons
        hideOrShowButtons();
    }

    function hideOrShowButtons(){
        if(total == 0 ) {
            $('#btn_cancel').hide();
            $('#btn_save').hide();
            $('#impuesto').val(`${tax}%`);
        } else {
            $('#btn_cancel').show();
            $('#btn_save').show();
        }
    }
</script>
@endpush