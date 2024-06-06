@extends('layouts.main')

@section('title', 'Caixa')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title mb-3">
                                <h4 class="m-b-10">Controle de caixa - Filtros</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between align-items-end">
                        <div class=" col-6 form-group">
                            <label class="form-label">Data inicial</label>
                            <input type="date" class="form-control" name="inicial_date" placeholder="Data inicial">
                        </div>
                        <div class=" col-5 form-group">
                            <label class="form-label">Data final</label>
                            <input type="date" class="form-control" name="final_date" placeholder="Data final">
                        </div>
                        <div class=" col-1 form-group">
                            <button type="submit" class="btn btn-light-dark w-100">Filtrar</button>
                        </div>
                    </div>
                </div>
            </div>     
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Controle de caixa</h5>
                            <div class="options">
                                <button type="button" id="btn_filters" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target=".filters-modal-md">Excel</button>
                                                     
                                <button type="button" id="btn_filters" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target=".filters-modal-md">PDF</button>
                      
                                <button type="button" id="btn_accounting_entry" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target=".accounting-entry-modal-lg">Lançar caixa</button>
                            </div>                         
                        </div>
                        <div class="card-body table-border-style">
                            <div id="table_cashier" class="table-responsive table-hover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')

    <div class="modal fade accounting-entry-modal-lg" tabindex="-1" aria-labelledby="filters_modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content accounting-entry-large">
                <form id="accounting_entry">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Fechar caixa</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row d-flex justify-content-start">                            
                            <div class="col-4 form-group">
                                <label class="form-label">Data do caixa</label>
                                <input type="date" class="form-control" name="date_accounting" placeholder="Data do caixa">
                            </div>
                            <div class="col-8 form-group">
                                <label class="form-label">Observação (opcional)</label>
                                <textarea class="form-control" name="note" rows="1"></textarea>
                                <input type="hidden" class="products-total" name="products_total"> 
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-md-8 col-12">
                                <div class="mb-3 mt-2">
                                    <button type="button" id="btn_add_products" class="btn btn-light-secondary">Adicionar Produtos</button>
                                </div>
                                <div id="product_container"></div>
                                <div id="product_template" class="d-flex justify-content-start d-none mb-3 product-item">
                                   
                                    <div class="col-3 form-group pe-2">
                                        <label class="form-label" for="put_products">Produto<span class="req-march">*</span></label>
                                        <select class="form-select" id="put_products"></select>
                                    </div>
                                    <div class="col-3 form-group px-2">
                                        <label class="form-label" for="put_stock">Estoque<span class="req-march">*</span></label>
                                        <select class="form-select" id="put_stock"></select>
                                    </div>
                                    <div class="col-2 form-group px-2">
                                        <label class="form-label">Quantidade<span class="req-march">*</span></label>
                                        <input type="text" class="form-control" id="put_quantity" placeholder="Insira a quantidade">
                                    </div>
                                    <div class="col-3 form-group ps-2">
                                        <label class="form-label">Preço<span class="req-march">*</span></label>
                                        <input type="text" class="input-money form-control" id="put_price" placeholder="Insira o preço">
                                    </div>
                                    <div class="remove">
                                        <button type="button" class="btn btn-link-danger remove-product"><i class="ti ti-trash"></i></button>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-3 mt-2">
                                    <button type="button" id="btn_add_payment_methods" class="btn btn-light-secondary">Adicionar forma de pagamento</button>
                                </div> 
                                <div id="payment_container"></div>
                                <div id="payment_template" class="d-flex justify-content-start d-none mb-3 payment-item">
                                    <div class="col-6 form-group pe-2">
                                        <label class="form-label" for="put_method">Forma de pagamento<span class="req-march">*</span></label>
                                        <select class="form-select" id="put_methods">
                                            <option selected disabled>Método de pagamento</option>
                                            <option value="pix">Pix</option>
                                            <option value="transfer">Transferência (TED/DOC)</option>
                                            <option value="money">Dinheiro</option>
                                            <option value="credit_card">Cartão de crédito</option>
                                            <option value="debit_card">Cartão de débito</option>
                                            <option value="others">Outros</option>
                                        </select>
                                    </div>
                                    <div class="col-5 form-group ps-2">
                                        <label class="form-label">Preço<span class="req-march">*</span></label>
                                        <input type="text" class="form-control input-money" id="put_value" placeholder="Insira o valor">
                                    </div>
                                    <div class="remove">
                                        <button type="button" class="btn btn-link-danger remove-payment"><i class="ti ti-trash"></i></button>
                                    </div>
                                </div>  
                            </div>                                                  
                        </div>
                        <div class="card social-widget-card bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-start">
                                    <div>
                                        <h2 class="text-white m-0">R$ <span class="value-total">0,00</span></h2>
                                        <span class="m-t-10">Valor total</span>
                                    </div>
                                    <div class="vertical-line"></div>
                                    <div>
                                        <h2 class="text-white m-0">R$ <span class="pay-total">0,00</span></h2>
                                        <span class="m-t-10">Valor total pago</span>
                                    </div>
                                </div>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">monetization_on</i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Lançar caixa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection