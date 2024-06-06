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
        <button type="button" id="btn_create_order" class="btn btn-success  modal_trigger" data-modal-title="Criar Pedido" data-modal-content="#create_order_content">+</button>

        <div id="order_list"></div>
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
@endsection

<div id="create_order_content" class="modal_dynamic_content" style="display:none;">
    <form id="create_order">
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
            <div class="mb-3 juridic-person d-none">
                <label for="corporate-reason" class="form-label">Razão social<span class="req-march">*</span></label>
                <input type="text" class="form-control" id="corporate-reason" name="corporate-reason" placeholder="Digite a razão social">
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
            <button type="submit" class="btn btn-dark mt-2 w-100">Criar pedido</button>
        </div>           
    </form>        
</div>

