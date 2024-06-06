@extends('layouts.main')

@section('title', 'Editar estoque')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <input type="hidden" id="warehouse_id" value="{{ $warehouse->id }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Editar estoque</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs profile-tabs mb-3 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="nav_details" data-bs-toggle="tab" href="#details_warehouse" role="tab" aria-selected="true">Detalhes
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="nav-edit" data-bs-toggle="tab" href="#edit_warehouse" role="tab" aria-selected="false" tabindex="-1">Editar
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="details_warehouse" role="tabpanel" aria-labelledby="nav_details">
                                    <div class="row justify-content-start">
                                        <div class="card-header">
                                            <h5>Detalhes do estoque</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <span class="f-18 fw-bold">Nome / Descrição</span>
                                                </div>
                                                <div class="col-9">
                                                    <span>{{ $warehouse->description }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <span class="f-18 fw-bold">Endereço</span>
                                                </div>
                                                <div class="col-9">
                                                    <p class="my-0">{{ $warehouse->address }}</p>
                                                    <p class="my-0">Bairro: {{ $warehouse->neighborhood }}</p>
                                                    <p class="my-0">{{ $warehouse->city }} - {{ $warehouse->state }}</p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <span class="f-18 fw-bold">Situação</span>
                                                </div>
                                                <div class="col-9">
                                                    {!! $warehouse->status_label !!}
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <span class="f-18 fw-bold">Cor do estoque em gráficos</span>
                                                </div>
                                                <div class="col-9 pt-2">
                                                    <div class="color-box" style="background-color: {{ $warehouse->color }};"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="edit_warehouse" role="tabpanel" aria-labelledby="edit-warehouse">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card border">
                                                <div class="card-header">
                                                    <h5>Editar estoque</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form id="edit-warehouse-form">
                                                        <input type="hidden" name="id" value="{{ $warehouse->id }}">

                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Dê um nome/descrição para este estoque<span class="req-march">*</span></label>
                                                            <input type="text" class="form-control" id="description" name="description" value="{{ $warehouse->description }}">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-2">
                                                                <label for="zipcode" class="form-label">CEP<span class="req-march">*</span></label>
                                                                <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $warehouse->zipcode }}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label for="address" class="form-label">Endereço<span class="req-march">*</span></label>
                                                                <input type="text" class="form-control" id="address" name="address" value="{{ $warehouse->address }}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label for="neighborhood" class="form-label">Bairro<span class="req-march">*</span></label>
                                                                <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ $warehouse->neighborhood }}">
                                                            </div>
                                                            <div class="col-2">
                                                                <label for="number" class="form-label">Número<span class="req-march">*</span></label>
                                                                <input type="text" class="form-control" id="number" name="number" value="{{ $warehouse->number }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-5">
                                                                <label for="city" class="form-label">Cidade<span class="req-march">*</span></label>
                                                                <input type="text" class="form-control" id="city" name="city" value="{{ $warehouse->city }}">
                                                            </div>
                                                            <div class="mb-3 col-2">
                                                                <label for="state" class="form-label">Estado<span class="req-march">*</span></label>
                                                                <input type="text" class="form-control" id="state" name="state" value="{{ $warehouse->state }}">
                                                            </div>
                                                            <div class="mb-3 col-5">
                                                                <label for="complement" class="form-label">Complemento</label>
                                                                <input type="text" class="form-control" id="complement" name="complement" value="{{ $warehouse->complement }}">
                                                            </div> 
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="color" class="form-label">Cor do estoque no gráfico<span class="req-march">*</span></label>
                                                            <input type="color" class="form-control" id="color" name="color" value="{{ $warehouse->color }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Situação<span class="req-march">*</span></label>
                                                            <select class="form-select" id="status" name="status">
                                                                <option value="1" {{ $warehouse->status == 1 ? 'selected' : '' }}>Ativo</option>
                                                                <option value="0" {{ $warehouse->status == 0 ? 'selected' : '' }}>Inativo</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" id="edit-warehouse-submit" class="btn btn-primary">Salvar alterações</button>
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
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5>Dados dos produtos no estoque</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <button id="add-stock-nav-modal" type="button" data-bs-toggle="modal" data-bs-target="#adding-stock-modal" class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                <i class="fa fa-plus mx-2"></i>
                                <span>Lançar estoque</span>
                            </button>
                        </div>
                        <div class="col-4">
                            <button id="remove-stock-nav-modal" type="button" data-bs-toggle="modal" data-bs-target="#remove-stock-modal" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                                <i class="fa fa-minus mx-2"></i>
                                <span>Baixar estoque</span>
                            </button>
                        </div>
                        <div class="col-4">
                            <button id="transfer-stock-nav-modal" type="button" data-bs-toggle="modal" data-bs-target="#transfer-stock-modal" class="btn btn-dark w-100 d-flex align-items-center justify-content-center">
                                <i class="fa fa-exchange-alt mx-2"></i>
                                <span>Transferir estoque</span>  
                            </button>
                        </div>
                    </div>
                    <div>
                        <ul class="nav nav-tabs profile-tabs mb-3 border-bottom" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="nav_summary" data-bs-toggle="tab" href="#summary" role="tab" aria-selected="false" tabindex="-1">Resumo
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="nav_products" data-bs-toggle="tab" href="#products" role="tab" aria-selected="true">Produtos
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="nav_history" data-bs-toggle="tab" href="#history" role="tab" aria-selected="false" tabindex="-1">Histórico
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="summary" role="tabpanel" aria-labelledby="nav_summary">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border mb-2">
                                        <div class="card-header">
                                            <h5>Resumo do estoque</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <div class="card bg-primary text-white widget-visitor-card">
                                                        <div class="card-body">
                                                            <div class="text-left">
                                                                <h2 class="text-white">Número de produtos neste estoque</h2>
                                                            </div>
                                                            <div class="text-center">
                                                                <h1 class="text-white">{{ $statistic_warehouse->products }}</h1>
                                                            </div>
                                                            <i class="material-icons-two-tone d-block f-50 text-white">check_circle</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card bg-red-500 text-white widget-visitor-card">
                                                        <div class="card-body">
                                                            <div class="text-left">
                                                                <h2 class="text-white">Número de produtos negativos</h2>
                                                            </div>
                                                            <div class="text-center">
                                                                <h1 class="text-white">{{ $statistic_warehouse->products_negative }}</h1>
                                                            </div>
                                                            <i class="material-icons-two-tone d-block f-50 text-white">remove_circle</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card bg-green-500 text-white widget-visitor-card">
                                                        <div class="card-body">
                                                            <div class="text-left">
                                                                <h2 class="text-white">Número de produtos positivos</h2>
                                                            </div>
                                                            <div class="text-center">
                                                                <h1 class="text-white">{{ $statistic_warehouse->products_positive }}</h1>
                                                            </div>
                                                            <i class="material-icons-two-tone d-block f-50 text-white">add_circle</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="products" role="tabpanel" aria-labelledby="nav_products">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5>Produtos no estoque</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#ID</th>
                                                        <th>Nome</th>
                                                        <th>Quantidade nesse estoque</th>
                                                    <tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($products_warehouse as $product)
                                                        <tr>
                                                            <td>{{ $product->id }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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

@section('modals')
    <div id="adding-stock-modal" class="modal fade" tabindex="-1" aria-labelledby="adding-stock" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="add-stock">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="add-modal-title">Lançar estoque</h5>
                        <div class="mb-3 mt-2">
                            <button type="button" id="btn-add-products" class="btn btn-light-secondary">Adicionar Produto</button>
                        </div>
                    </div>
                    <div class="modal-body ps-4 pe-2">
                        <div class="row justify-content-start">
                            <div id="add-stock-observation" class="col-12 d-none">
                                <label class="form-label" for="observation">Observação</label>
                                <textarea class="form-control mb-2" id="observation" name="observation" rows="3"></textarea>
                            </div>
                            <div id="product-adding-template" class="d-flex justify-content-start flex-wrap mb-3 d-none product-item">
                                <div class="col-6 form-group pe-2">
                                    <label class="form-label" for="put-products">Produto<span class="req-march">*</span></label>
                                    <select class="form-select" id="put-products" ></select>
                                </div>
                                <div class="col-5 form-group px-2">
                                    <label class="form-label" for="put-quantity">Quantidade<span class="req-march">*</span></label>
                                    <input type="text" class="form-control" id="put-quantity" placeholder="Insira a quantidade">
                                </div>
                                <div class="col-1 d-flex align-items-center justify-content-center">
                                    <button id="clear-add" type="button" class="btn btn-link-danger mt-3 clear-product"><i class="ti ti-trash"></i></button>
                                </div>
                            </div>   
                            <div id="product-add-container"></div>                     
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Lançar Estoque</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="remove-stock-modal" class="modal fade" tabindex="-1" aria-labelledby="remove-stock" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="remove-stock">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="remove-modal-title">Remover estoque</h5>
                        <div class="mb-3 mt-2">
                            <button type="button" id="btn-remove-products" class="btn btn-light-secondary">Adicionar Produto</button>
                        </div>
                    </div>
                    <div class="modal-body ps-4">
                        <div class="row justify-content-start">
                            <div id="remove-stock-observation" class="col-12 d-none">
                                <label class="form-label" for="remove-observation">Observação</label>
                                <textarea class="form-control mb-2" id="remove-observation" name="remove_observation" rows="3"></textarea>
                            </div>
                            <div id="product-remove-template" class="d-flex justify-content-start flex-wrap mb-3 d-none product-item">
                                <div class="col-6 form-group">
                                    <label class="form-label" for="remove-products">Produto<span class="req-march">*</span></label>
                                    <select class="form-select" id="remove-products" ></select>
                                </div>
                                <div class="col-5 form-group px-2">
                                    <label class="form-label" for="remove-quantity">Quantidade<span class="req-march">*</span></label>
                                    <input type="text" class="form-control" id="remove-quantity" placeholder="Insira a quantidade">
                                </div>
                                <div class="col-1 d-flex align-items-center justify-content-center">
                                    <button id="clear-remove" type="button" class="btn btn-link-danger mt-3 clear-product"><i class="ti ti-trash"></i></button>
                                </div>
                            </div>   
                            <div id="product-remove-container"></div>                     
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Remover Estoque</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="transfer-stock-modal" class="modal fade" tabindex="-1" aria-labelledby="transfer-stock-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="transfer-stock">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="transfer-modal-title">Transferir estoque</h5>
                        <div class="mb-3 mt-2">
                            <button type="button" id="btn-transfer-products" class="btn btn-light-secondary">Adicionar Produto</button>
                        </div>
                    </div>
                    <div class="modal-body ps-4 pe-2">
                        <div class="row justify-content-start">
                            <div id="transfer-stock-observation" class="col-12 d-none">
                                <label class="form-label" for="transfer-observation">Observação</label>
                                <textarea class="form-control mb-2" id="transfer-observation" name="transfer_observation" rows="3"></textarea>
                            </div>
                            <div id="product-transfer-template" class="d-flex justify-content-start flex-wrap mb-3 d-none product-item">
                                <div class="col-4 form-group pe-2">
                                    <label class="form-label" for="transfer-products">Produto<span class="req-march">*</span></label>
                                    <select class="form-select" id="transfer-products" ></select>
                                </div>
                                <div class="col-4 form-group px-2">
                                    <label class="form-label" for="transfer-stocks">Estoque<span class="req-march">*</span></label>
                                    <select class="form-select" id="transfer-stocks"></select>
                                </div>
                                <div class="col-3 form-group px-2">
                                    <label class="form-label" for="transfer-quantity">Quantidade<span class="req-march">*</span></label>
                                    <input type="text" class="form-control" id="transfer-quantity" placeholder="Insira a quantidade">
                                </div>
                                <div class="col-1 d-flex align-items-center justify-content-center">
                                    <button id="clear-transfer-product" type="button" class="btn btn-link-danger mt-3 clear-product"><i class="ti ti-trash"></i></button>
                                </div>
                            </div>
                            <div id="product-transfer-container"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Transferir Estoque</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection