@extends('layouts.main')

@section('title', 'Produtos')

@section('content')
    <section class="pc-container">
        <div class="pc-content">    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Produtos</h5>
                            <button type="button" id="btn_create_user" class="btn btn-light-dark" data-bs-toggle="modal" data-bs-target="#create_product_modal">
                                Criar produto
                            </button>
                        </div>
                        <div class="card-body table-border-style">
                            <div id="table_product" class="table-responsive table-hover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    
@section('modals')
    <div class="modal fade" id="create_product_modal" tabindex="-1" aria-labelledby="createProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductLabel">Criar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create_product_form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome*</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Código de barras*</label>
                            <input type="text" class="form-control" id="barcode" name="barcode" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Código do sistema*</label>
                            <input type="text" class="form-control" id="system_code" name="system_code" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="create_product_submit" type="button" class="btn btn-primary">Finalizar cadastro</button>
                </div>
            </div>
        </div>
    </div>
@endsection