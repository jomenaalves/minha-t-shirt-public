@extends('layouts.main')

@section('title', 'NF-e')

@section('content')
    <section class="pc-container">
        <div class="pc-content">    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>NF-e</h5>
                            <button type="button" id="btn_filters" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target=".filters-modal-lg">Filtros</button>
                        </div>
                        <div class="card-body table-border-style">
                            <div id="table_nfe" class="table-responsive table-hover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div class="modal fade filters-modal-lg" tabindex="-1" aria-labelledby="filters_modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="filter-nfe">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Filtros</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row d-flex justify-content-start">
                            <div class="col-6 form-group">
                                <label class="form-label" for="field_type">Campo</label>
                                <select class="form-select" id="field_type" name="field_type">
                                <option selected disabled>Selecione um campo</option>
                                <option value="key">Chave</option>
                                <option value="number">Número</option>
                                <option value="client">Cliente</option>
                                <option value="document">CPF / CNPJ</option>
                                <option value="order-number">Número do pedido</option>
                                </select>
                            </div>
                            <div class=" col-6 form-group">
                                <label class="form-label">Termo de busca</label>
                                <input type="text" class="form-control" name="username" placeholder="Nome de usuário">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class=" col-6 form-group">
                                <label class="form-label">Data inicial</label>
                                <input type="date" class="form-control" name="inicial_date" placeholder="Data inicial">
                            </div>
                            <div class=" col-6 form-group">
                                <label class="form-label">Data final</label>
                                <input type="date" class="form-control" name="final_date" placeholder="Data final">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-6 form-group">
                                <label class="form-label" for="type">Tipo</label>
                                <select class="form-select" id="type" name="type">
                                <option selected disabled>Selecione um tipo</option>
                                <option value="all">Todos</option>
                                <option value="enter">Entrada</option>
                                <option value="out">Saída</option>
                                </select>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                <option selected disabled>Selecione um status</option>
                                <option value="all">Todos</option>
                                <option value="authorized">Autorizada</option>
                                <option value="canceled">Cancelada</option>
                                <option value="wear_out">Inutilizada</option>
                                <option value="reserved_number">Número reservado</option>
                                <option value="rejected">Rejeitada</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade view-nfe-modal-md" tabindex="-1" aria-labelledby="view-nfe-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">                
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Nota número: <span id="invoice_number"></span></h5>
                </div>
                <div class="modal-body px-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-11">
                            <p>Chave: <strong><span id="view_key"></span></strong></p>
                            <div class="row justify-content-start">
                                <p class="col-6">Número / Série: <strong><span id="view_number_serie"></span></strong></p>
                                <p class="col-6">Tipo: <strong><span id="view_type"></span></strong></p>
                            </div>
                            <div class="row justify-content-start">
                                <p class="col-6">Cliente: <strong><span id="view_client"></span></strong></p>
                                <p class="col-6">Valor: <strong><span id="view_value"></span></strong></p>
                            </div>
                            <div class="row justify-content-start">
                                <p class="col-6">Data: <strong><span id="view_date"></span></strong></p>
                                <p class="col-6">Status: <strong><span id="view_status"></span></strong></p>
                            </div>
                            <button class="btn btn-danger w-100 my-3" type="button">Download PDF</button>                       
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection