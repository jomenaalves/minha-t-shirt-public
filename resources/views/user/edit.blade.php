@extends('layouts.main')

@section('title', 'Editar usuários')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Editar usuário</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs profile-tabs mb-3 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">Perfil
                                    </a>
                                </li>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-2" role="tab" aria-selected="false" tabindex="-1">Alterar senha
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-3" role="tab" aria-selected="false" tabindex="-1">Permissões
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                    <div class="row justify-content-start">
                                        <div class="col-md-3 col-xxl-3">
                                            <div class="card border">
                                                <div class="card-header">
                                                    <h5>Imagem de perfil</h5>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div id="photo_profile" class="photo-user"></div>
                                                    <small class="d-block my-3 text-muted">Alterar imagem do perfil</small>
                                                    <button id="btn_upload_photo" class="btn btn-primary">Upload imagem</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-xxl-9">
                                            <form id="edit_details_profile">
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Editar detalhes do perfil</h5>
                                                    </div>
                                                    <div class="card-body">                                                     
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nome<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="name" name="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nome de usuário<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="username" name="username"  value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Função<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="function" name="function"  value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 mb-3">
                                                                <div class="form-check form-switch mb-2 mt-2">
                                                                    <input type="checkbox" class="form-check-input input-info" id="user_is_active" name="user_is_active">
                                                                    <label class="form-check-label" for="customswitchv1-6">Ativo</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="btn btn-primary">Salvar detalhes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>    
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <form id="update_password_user">
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Alteração de senha</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Senha atual</label>
                                                                    <input type="text" class="form-control" name="old_password" placeholder="Senha atual">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nova Senha</label>
                                                                    <input type="password" class="form-control" name="password" placeholder="Nova senha">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Confirme sua nova senha</label>
                                                                    <input type="password" class="form-control" name="password_confirmation"placeholder="Confirmação de senha">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="btn btn-primary">Alterar senha</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                                    <form id="update_permissions_user">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Permissão usuário</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="user_permission_edit" name="user_permission_edit">
                                                            <label class="form-check-label" for="customswitchv1-6">Usuário possui permissão de edição</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-xxl-6">
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Permissões web</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="products_web" name="products_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Produtos</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="stock_web" name="stock_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Estoques</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="cash_register_web" name="cash_register_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Caixa</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="to_pay_web" name="to_pay_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Contas a pagar</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="users_web" name="users_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Usuários</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="reports_web" name="reports_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Relatórios</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="orders_web" name="orders_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Pedidos</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="settings_nfe_web" name="settings_nfe_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Configurações da NF-e</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="nfe_web" name="nfe_web">
                                                            <label class="form-check-label" for="customswitchv1-6">NF-e</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="movement_history_web" name="movement_history_web">
                                                            <label class="form-check-label" for="customswitchv1-6">Histórico de movimentação</label>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xxl-6">
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Permissões app</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="products_app" name="products_app">
                                                            <label class="form-check-label" for="customswitchv1-6">Produtos</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="stocks_app" name="stocks_app">
                                                            <label class="form-check-label" for="customswitchv1-6">Estoques</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="cash_register_app" name="cash_register_app">
                                                            <label class="form-check-label" for="customswitchv1-6">Caixa</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="freight_app" name="freight_app">
                                                            <label class="form-check-label" for="customswitchv1-6">Frete</label>
                                                        </div>
                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input type="checkbox" class="form-check-input input-info" id="orders_app" name="orders_app">
                                                            <label class="form-check-label" for="customswitchv1-6">Pedidos</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-primary">Salvar permissões</button>
                                            </div>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>     
@endsection