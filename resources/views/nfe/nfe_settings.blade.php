@extends('layouts.main')

@section('title', 'Configurações da NF-e')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Configurações da NF-e</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs profile-tabs mb-3 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">Empresa emissora
                                    </a>
                                </li>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-2" role="tab" aria-selected="false" tabindex="-1">Certificado digital
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                    <div class="row justify-content-start">
                                        <div class="col-md-3 col-xxl-3">
                                            <div class="card border">
                                                <div class="card-header">
                                                    <h5>Logotipo da empresa</h5>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div id="logotype" class="photo-user"></div>
                                                    <small class="d-block my-3 text-muted">Alterar logotipo da empresa</small>
                                                    <button id="btn_upload_photo" class="btn btn-primary">Upload logotipo</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-xxl-9">
                                            <form id="edit_details_profile">
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Dados da empresa emissora</h5>
                                                    </div>
                                                    <div class="card-body">                                                     
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nome fantasia<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="fantasy_name" name="fantasy_name" placeholder="Nome fantasia">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Razão social<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="corporate_reason" name="corporate_reason" placeholder="Razão Social">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">Cnpj<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Cnpj">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">Inscrição estadual<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="state_registration" name="state_registration" placeholder="Inscrição estadual">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">CEP<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Endereço<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Endereço">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <div class="form-group">
                                                                    <label class="form-label">Número<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="address_number" name="address_number" placeholder="Número">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label class="form-label">Bairro<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Bairro">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">Complemento<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="complement" name="complement" placeholder="Complemento">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">Cidade<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="city" name="city" placeholder="Cidade">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Estado<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="state" name="state" placeholder="Estado">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Percentual do preço<span class="req-march">*</span></label>
                                                                    <input type="text" class="form-control" id="percentage_price" name="percentage_price" placeholder="Percentual do preço">
                                                                </div>
                                                            </div>                                                         
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="btn btn-primary">Atualizar</button>
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
                                                        <h5>Certificado digital</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-4">
                                                                <p>Certificado emitido em: <strong><span id="certificate_issued"></span> </strong></p>
                                                                <p>Certificado expira em: <strong><span id="certificate_expires"></span> </strong></p>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Enviar novo certificado</label>
                                                                    <input type="file" class="form-control" name="old_password" placeholder="Senha atual">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Senha</label>
                                                                    <input type="password_certified" class="form-control" name="password_certified" placeholder="Senha">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="btn btn-primary">Atualizar</button>
                                                            </div>
                                                        </div>
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
            </div> 
        </div>
    </section>     
@endsection