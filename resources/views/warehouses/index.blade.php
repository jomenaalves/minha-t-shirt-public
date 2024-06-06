@extends('layouts.main')

@section('title', 'Estoque')

@section('content')
    <section class="pc-container">
        <div class="pc-content">    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Estoque</h5>
                            <button type="button" id="btn_create_user" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target="#create_warehouse_modal">
                                Cadastrar novo
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h4>Filtros</h4>
                                <form id="filter_warehouse">
                                    <div class="row mb-2 align-items-end">
                                        <div class="col-3">
                                            <label for="area" class="form-label">Campo</label>
                                            <select class="form-select" id="area" name="area">
                                                <option value="description">Descrição</option>
                                                <option value="barcode">Endereço</option>
                                            </select>
                                        </div>
                                        <div class="col-7">
                                            <label for="search_term" class="form-label">Termo de Busca</label>
                                            <input type="text" class="form-control" id="search_term" name="search_term">
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-primary">Aplicar</button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" id="active_warehouses" name="active_warehouses">
                                        <label for="active_warehouses" class="form-label ml-2 mb-0">Listar somente os estoques ativos</label>
                                    </div> 
                                </form>
                            </div>
                            <div class="table-border-style">
                                <div id="table_warehouse" class="table-responsive table-hover"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    
@section('modals')
    <div class="modal fade" id="create_warehouse_modal" tabindex="-1" aria-labelledby="createWarehouseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createWarehouseLabel">Criar estoque</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create_warehouse_form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Dê um nome/descrição para este estoque*</label>
                            <input type="text" class="form-control" id="create_description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="create_zipcode" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="create_zipcode" name="zipcode">
                        </div>
                        <div class="mb-3">
                            <label for="create_address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="create_address" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="create_number" class="form-label">Número</label>
                            <input type="text" class="form-control" id="create_number" name="number">
                        </div>
                        <div class="mb-3">
                            <label for="create_complement" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="create_complement" name="complement">
                        </div> 
                        <div class="mb-3">
                            <label for="create_neighborhood" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="create_neighborhood" name="neighborhood">
                        </div>
                        <div class="mb-3">
                            <label for="create_city" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="create_city" name="city">
                        </div>
                        <div class="mb-3">
                            <label for="create_state" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="create_state" name="state">
                        </div>
                        <div class="mb-3">
                            <label for="create_color" class="form-label">Cor do estoque no gráfico</label>
                            <input type="color" class="form-control" id="create_color" name="color">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="create_warehouse_submit" type="button" class="btn btn-primary">Finalizar cadastro</button>
                </div>
            </div>
        </div>
    </div>
@endsection