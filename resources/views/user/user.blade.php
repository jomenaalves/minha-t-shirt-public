@extends('layouts.main')

@section('title', 'Usuários')

@section('content')
    <section class="pc-container">
        <div class="pc-content">    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Usuários</h5>
                            @if (Auth::user()->role == 'admin')
                                <button type="button" id="btn_create_user" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target=".create-user-modal-lg">Criar usuário</button>
                            @endif
                        </div>
                        <div class="card-body table-border-style">
                            <div id="table-user" class="table-responsive table-hover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div class="modal fade create-user-modal-lg" tabindex="-1" aria-labelledby="create_user_modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="create_user">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Cadastrar novo usuário</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="form-group">
                            <label class="form-label">Nome<span class="req-march">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Nome completo">
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class=" col-6 form-group">
                                <label class="form-label">Nome de usuário<span class="req-march">*</span></label>
                                <input type="text" class="form-control" name="username" placeholder="Nome de usuário">
                            </div>
                            <div class=" col-6 form-group">
                                <label class="form-label">Função<span class="req-march">*</span></label>
                                <input type="text" class="form-control" name="function" placeholder="Função">
                            </div>
                        </div>
                        <div class="form-check form-switch mb-2 mt-2">
                            <input type="checkbox" class="form-check-input input-info" id="user_permission_edit" name="user_permission_edit" checked>
                            <label class="form-check-label" for="customswitchv1-6">Este usuário tem permissão de editar as páginas abaixo.</label>
                        </div>
                        <div id="all_permissions" class="row d-flex justify-content-start mt-4">
                            <div id="permissions_web" class="col-md-6 col-12">
                                <h5 class="mb-3">Permissões web</h5>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="products_web" name="products_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Produtos</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="stock_web" name="stock_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Estoques</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="cash_register_web" name="cash_register_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Caixa</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="to_pay_web" name="to_pay_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Contas a pagar</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="users_web" name="users_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Usuários</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="reports_web" name="reports_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Relatórios</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="orders_web" name="orders_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Pedidos</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="settings_nfe_web" name="settings_nfe_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Configurações da NF-e</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="nfe_web" name="nfe_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">NF-e</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="movement_history_web" name="movement_history_web" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Histórico de movimentação</label>
                                </div>                            
                            </div>
                            <div id="permissions_app" class="col-md-6 col-12">
                                <h5 class="mb-3">Permissões app</h5>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="products_app" name="products_app" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Produtos</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="stocks_app" name="stocks_app" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Estoques</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="cash_register_app" name="cash_register_app" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Caixa</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="freight_app" name="freight_app" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Frete</label>
                                </div>
                                <div class="form-check form-switch mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input input-info" id="orders_app" name="orders_app" checked>
                                    <label class="form-check-label" for="customswitchv1-6">Pedidos</label>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-dark mt-3" role="alert">A <strong>primeira senha</strong> de acesso do usuário será o seu próprio <strong>nome de usuário</strong>.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection