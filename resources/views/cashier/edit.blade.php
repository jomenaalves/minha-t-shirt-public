@extends('layouts.main')

@section('title', 'Caixa - Visão geral')

@section('content')   
    <section class="pc-container">
        <div class="pc-content"> 
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                            <h5 class="m-b-10">Caixa - Visão geral</h5>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info d-flex justify-content-between mt-3 close-cashier d-none" role="alert">
                        <h4 class="mt-2">Este caixa está fechado.</h4>
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target=".open-cashier-modal-md">Abrir caixa</button>                            
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex justify-content-start mt-3 divergent-payment-cashier d-none" role="alert">
                        <h4 class="mt-2">O valor total do caixa difere dos valores recebidos. Valor total de vendas <span class="total-sales"></span> | Valor total de pagamentos <span class="total-payments"></span></h4>
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-secondary order-card">
                        <div class="card-body">
                        <h5 class="text-white">Número de produtos</h5>
                        <h1 class="text-white quantity-products"></h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">loyalty</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-primary order-card">
                        <div class="card-body">
                        <h5 class="text-white">Valor das vendas</h5>
                        <h1 class="text-white sold"></h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">monetization_on</i>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-dark order-card">
                        <div class="card-body">
                        <h5 class="text-white">Valor das saídas</h5>
                        <h1 class="text-white withdrawal"></h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">assignment_return</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-danger order-card">
                        <div class="card-body">
                        <h5 class="text-white">Valor total em caixa</h5>
                        <h1 class="text-white total-cashier"></h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">account_balance_wallet</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-stretch">
                <div class="col-md-12 col-xl-6 ">
                    <div class="card bg-dark order-card box-large">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between pe-5">
                                <div>
                                    <h5 class="text-white">Formas de Pagamento</h5>
                                    <p class="text-white payment mb-0"></p>
                                </div>
                                <div class="d-flex align-items-center pe-5">
                                    <button type="button" id="btn_methods_payment" class="btn btn-secondary me-2" onclick="editCashierPage.loadCashierPayments()">Editar</button>
                                </div>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white mt-auto">payment</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-6">
                    <div class="card bg-secondary order-card box-large">
                        <div class="card-body d-flex flex-row">
                            <div class="d-flex justify-content-between pe-5 w-100">
                                <div>
                                    <h5 class="text-white">Observação</h5>
                                    <h3 class="text-white note"></h3>
                                </div>
                                <div class="d-flex align-items-center  pe-5">
                                    <button type="button" class="btn btn-dark me-2 btn-update-note" data-bs-toggle="modal" data-bs-target=".update-note-modal-md">Editar</button>
                                </div>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white mt-auto">assignment</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Lançamentos do dia</h5>
                            <div class="options me-2">                                                        
                                <button type="button" id="btn_close_cashier" class="btn btn-light-secondary">Fechar caixa</button>
                        
                                <button type="button" id="btn_adding_products" class="btn btn-light-danger" data-bs-toggle="modal" data-bs-target=".adding-products-modal-lg">Lançar produtos</button>
                        
                                <button type="button" id="btn_add_withdrawal" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target=".withdrawal-modal-md">Fazer retirada</button>
                            </div>                         
                        </div>
                        <div class="card-body table-border-style">
                            <ul class="nav nav-tabs profile-tabs mb-3 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">Produtos vendidos
                                    </a>
                                </li>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab" aria-selected="false" tabindex="-1">Retiradas
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                    <div id="table_cashier_edit" class="table-responsive table-hover"></div>
                                </div>
                                <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                    <div class="row">
                                        <div id="table_withdrawal" class="table-responsive table-hover"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div class="modal fade adding-products-modal-lg" tabindex="-1" aria-labelledby="adding-products" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="adding_products">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Lançar produtos no fechamento</h5>
                        <div class="mb-3 mt-2">
                            <button type="button" id="btn_edit_products" class="btn btn-light-secondary">Adicionar Produtos</button>
                        </div>
                    </div>
                    <div class="modal-body ps-4 pe-2">
                        <div class="row justify-content-start">                       
                            <div id="product_edit_template" class="d-flex justify-content-start flex-wrap mb-3 d-none product-item">
                                <div class="col-3 form-group pe-2">
                                    <label class="form-label" for="put_products">Produto<span class="req-march">*</span></label>
                                    <select class="form-select" id="put_products" ></select>
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
                                    <input type="text" class="form-control" id="put_price" placeholder="Insira o preço">
                                </div>
                                <div class="remove">
                                    <button type="button" class="btn btn-link-danger remove-product"><i class="ti ti-trash"></i></button>
                                </div>
                            </div>   
                            <div id="product_edit_container"></div>                     
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Lançar produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade update-payment-modal-md" tabindex="-1" aria-labelledby="update-payment" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="update_payment">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Editar formas de pagamento</h5>
                        <div class="mb-3 mt-2">
                            <button type="button" id="btn_edit_payment" class="btn btn-light-secondary">Adicionar pagamento</button>
                        </div>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row d-flex justify-content-start">
                            <div id="payment_form_container" class="d-flex justify-content-start flex-wrap mb-3"></div>
                            <div id="payment_edit_template" class="d-flex justify-content-start flex-wrap mb-3 d-none payment-item">
                                <div class="col-6 form-group pe-2">
                                    <label class="form-label" for="put_method">Forma de pagamento<span class="req-march">*</span></label>
                                    <select class="form-select" id="put_method">
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
                                    <label class="form-label">Valor recebido<span class="req-march">*</span></label>
                                    <input type="text" class="form-control" id="put_value" placeholder="Insira o valor">
                                </div>
                                <div class="col-1 remove">
                                    <button type="button" class="btn btn-link-danger remove-payment"><i class="ti ti-trash"></i></button>
                                </div>
                            </div>                          
                            <div id="payment_edit_container"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade update-note-modal-md" tabindex="-1" aria-labelledby="update-note" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="update_note">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Observação do fechamento</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row d-flex justify-content-start">
                            <div class="col-12 form-group">
                                <label class="form-label">Observação (opcional)</label>
                                <textarea class="form-control" id='input_note' name="note" rows="3"></textarea>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade withdrawal-modal-md" tabindex="-1" aria-labelledby="withdrawal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="withdrawal">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Fazer retirada</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="col-12 form-group">
                            <label class="form-label">Valor a ser retirado<span class="req-march">*</span></label>
                            <input type="text" class="form-control" name="value_withdrawal" placeholder="Insira o valor">
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-12 form-group">
                                <label class="form-label">Descrição da retirada<span class="req-march">*</span></label>
                                <textarea class="form-control" name="description_withdrawal" rows="3"></textarea>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Efetivar retirada</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade open-cashier-modal-md" tabindex="-1" aria-labelledby="open-cashier" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="open_cashier">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Confirmar reabertura do caixa.</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="col-12 form-group">
                            <label class="form-label">Digita a senha master para confirmação<span class="req-march">*</span></label>
                            <input type="password" class="form-control" name="master_password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Reabrir caixa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade remove-item-modal-md" tabindex="-1" aria-labelledby="remove-item" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="remove_item">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Remover item do fechamento</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row d-flex justify-content-start">
                            <input type="hidden" id='cashier_product_id' name='cashier_product_id'>
                            <div class="text-center remove-item-alert">
                                <i class="ti ti-alert-circle f-70"></i>
                                <h4 class="mt-3">O produto será removido desse fechamento e sua quantidade será lançada novamente no estoque</h4>
                            </div>
                            <hr class="my-3">
                            <div class="col-12 form-group text-center">
                               <h4><strong>Produto: </strong> <span class="remove-product"></span></h4>
                               <h4><strong>Estoque: </strong> <span class="remove-store"></span></h4>
                               <h4><strong>Quantidade: </strong> <span class="remove-quantity"></span></h4>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Remover item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade update-item-modal-md" tabindex="-1" aria-labelledby="update-item" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="update_item">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Atualizar item do fechamento</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row d-flex justify-content-start">
                            <input type="hidden" id='update_cashier_product_id' name='update_cashier_product_id'>
                            <div class="col-12 form-group d-flex justify-content-center align-items-center flex-column">
                               <h4><strong>Produto: </strong> <span class="update-product"></span></h4>
                               <h4><strong>Estoque: </strong> <span class="update-store"></span></h4>
                               <h4><strong>Quantidade: </strong> <span class="update-quantity"></span></h4>
                               <div class="col-12 form-group mt-3 text-center w-50">
                                    <label class="form-label">Insira a nova quantitade<span class="req-march">*</span></label>
                                    <input type="number" class="form-control" id="update_new_quantity" name="update_new_quantity" min="1" step="1">
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection