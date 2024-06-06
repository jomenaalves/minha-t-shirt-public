@extends('app.layouts.main')

@section('title', 'Pedidos')

@section('filter')
    <i id="filter" class="material-icons">search</i>
@endsection

@section('content')
    <main>
        <br>
        <p>
            <a href="/dashboard">Dashboard</a> /  <a href="/pedidos">Pedidos</a>
        </p>

        <div class="col-12 card py-2 px-3">
            <div class="align-items-start d-flex justify-content-between">
                <p class="m-0 bold"><strong>Dados do Cliente</strong></p>
                <button id="btn_edit_order" class="btn rounded df-button modal_trigger" data-modal-title="Editar Pedido" data-modal-content="#edit_order_content"><i class="bx bxs-pencil d-flex"></i></button>
            </div>
            <hr>
            <div class="client-details"></div>
        </div>

        <div class="col-12 card py-2 px-3 mt-3">
            <div class="align-items-end d-flex justify-content-between">
                <p class="m-0"><strong>Dados de Endereço</strong></p>
                <button id="btn_edit_address" class="btn rounded df-button modal_trigger" data-modal-title="Editar Endereço" data-modal-content="#edit_address_content"><i class="bx bxs-pencil d-flex"></i></button>
            </div>
            <hr>
            <div class="client-address"></div>
        </div>

        <div class="col-12 card py-2 px-3 mt-3">
            <div class="align-items-end d-flex justify-content-between">
                <p class="m-0"><strong>Resumo do pedido</strong></p>
                <button id="btn_edit_discount" class="btn rounded df-button modal_trigger" data-modal-title="Editar desconto" data-modal-content="#edit_discount_content"><i class="bx bxs-pencil d-flex"></i></button>

            </div>
            <hr>
            <div class="order-items"></div>
        </div>
        
        <div class="col-12 card py-2 px-3 mt-3">
            <div class="align-items-end d-flex justify-content-between">
                <p class="m-0"><strong>Items do pedido</strong></p>
                <button id="btn_edit_products" class="btn rounded df-button modal_trigger" data-modal-title="Editar itens" data-modal-content="#edit_products_content">+</button>
            </div>
            <hr>
            <div id="order-list"></div>
        </div>

        <div class="col-12 card py-2 px-3 mt-3" id="payment-link-content">
            @if($paymentLink)

                <div class="align-items-end d-flex justify-content-between">
                    <p class="m-0"><strong>Link de pagamento</strong></p>
                </div>
                <hr>
                <div class="payment-link">
                    <a href="{{$paymentLink['paymentLink']}}" target="_blank">{{ $paymentLink['paymentLink'] }}</a>
                </div>

            @else 
                <button class="btn btn-primary" id="generatePaymentLink">GERAR CHECKOUT PARA PAGAMENTO</button>
            @endif
        </div>
    </main>
@endsection

@section('modal')
    <div id="modal_template" class="modal">
        <div class="modal_content">
            <div class="modal_close">X</div>
            <h4 class="modal_title"></h4>
            <div class="modal_body"></div>
        </div>     
    </div>
    
    <!-- Modal Contents -->
    <div id="edit_order_content" class="modal_dynamic_content" style="display:none;">
        <form id="edit_order">
            <div class="form-check form-switch mt-4 mb-3">
                <input class="form-check-input" type="checkbox" id="order_type_person">
                <label class="form-check-label" for="flexSwitchCheckDefault">Pessoa jurídica</label>
            </div>            
                <div class="mb-3">
                    <label for="document" id="document_label" class="form-label">CPF<span class="req-march">*</span></label>
                    <input type="text" class="form-control" id="document" name="document" placeholder="000.000.000-00">
                </div>
                <div class="mb-3">
                    <label for="name" id="name_label" class="form-label">Nome<span class="req-march">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome">
                </div>
                <div class="mb-3 physical-person">
                    <label for="register" class="form-label">RG<span class="req-march">*</span></label>
                    <input type="text" class="form-control" id="register" name="register" placeholder="Digite o RG">
                </div>
                <div class="mb-3 juridic-person d-none">
                    <label for="corporate-reason" class="form-label">Razão social<span class="req-march">*</span></label>
                    <input type="text" class="form-control" id="corporate-reason" name="corporate_reason" placeholder="Digite a razão social">
                </div>
                <div class="mb-3 juridic-person d-none">
                    <label for="state-registration" class="form-label">IE<span class="req-march">*</span></label>
                    <input type="text" class="form-control" id="state-registration" name="state-registration" placeholder="Digite a inscrição estadual">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefone<span class="req-march">*</span></label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email<span class="req-march">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email">
                </div>        
            <div>
                <button type="submit" class="btn btn-dark mt-2 w-100">Salvar</button>
            </div>           
        </form>        
    </div>
    
    <div id="edit_address_content" class="modal_dynamic_content" style="display:none;">
        <form id="edit_address">            
            <div class="mb-3">
                <label for="cep" class="form-label">CEP<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Endereço<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Digite o endereço">
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Número<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Digite o número">
            </div>
            <div class="mb-3">
                <label for="complement" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complement" name="complement" placeholder="Digite o complemento">
            </div>
            <div class="mb-3">
                <label for="neighborhood" class="form-label">Bairro<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Digite o bairro">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Cidade<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Digite a cidade">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">Estado<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Digite o estado">
            </div>
            <div>
                <button type="submit" class="btn btn-dark mt-2 w-100">Salvar</button>
            </div>           
        </form>
    </div>
    
    <div id="edit_discount_content" class="modal_dynamic_content" style="display:none;">
        <!-- Content for view order modal -->
        <form id="edit_discount">
            <input type="hidden" id="transaction_id" name="transaction_id">
            <input type="hidden" id="amount" name="amount">
            <div class="mb-3">
                <label for="freight" class="form-label">Valor do frete<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="freight" name="freight" placeholder="0000,00">
            </div>
            <div class="mb-3">
                <label for="select-type" class=form-label">Tipo do desconto</label>
                <select class="form-select" aria-label="select-type" id="payment_type" name="payment-type">
                    <option selected hidden>Selecione o tipo de desconto</option>
                    <option value="fixed">Fixo</option>
                    <option value="percentage">Percentual</option>
                  </select>
            </div>
            <div class="mb-3">
                <label for="discount_value" class="form-label">Valor do desconto</label>
                <input type="text" class="form-control" id="discount_value" name="discount_value" placeholder="Digite o valor do desconto">
            </div>
            <div>
                <button type="submit" class="btn btn-dark mt-2 w-100">Salvar</button>
            </div>  
        </form>
    </div>
    
    <div id="edit_products_content" class="modal_dynamic_content" style="display:none;">
        <form id="edit_products">
            <div class="mt-3 mb-3">
                <label for="select-type" class=form-label">Produto<span class="req-march">*</span></label>
                <select class="form-select" id="select_products" aria-label="select-type" name="product_id"></select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Preço<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="price" name="price" placeholder="0000,00">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Digite a quantidade">
            </div>
            <div>
                <button type="submit" class="btn btn-dark mt-2 w-100">Salvar</button>
            </div>  
        </form>
    </div>
@endsection

