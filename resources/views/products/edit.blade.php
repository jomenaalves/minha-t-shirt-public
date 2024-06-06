@extends('layouts.main')

@section('title', 'Editar produtos')

@section('content')
    <section class="pc-container">
        <div class="pc-content">    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between border-bottom-0">
                            <h5>Dados do Produto</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <button class="nav-link active" id="details_nav" data-bs-toggle="tab" data-bs-target="#details_product" type="button" role="tab" aria-controls="contact" aria-selected="false">Detalhes</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="edit_nav" data-bs-toggle="tab" data-bs-target="#edit_product" type="button" role="tab" aria-controls="contact" aria-selected="false">Editar</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab_product">
                                <div class="tab-pane fade show active" id="details_product" role="tabpanel" aria-labelledby="details-tab">
                                    @foreach(['Name' => $product->name,
                                        'Código de barras' => $product->barcode,
                                        'Código do sistema' => $product->system_code,
                                        'NCM' => $product->ncm ?? '',
                                        'CSOSN' => $product->csosn ?? '',
                                        ] as $label => $value)
                                        <div class="row align-items-center mb-2">
                                            <div class="col-3">
                                                <span class="f-18 fw-bold">{{ $label }}</span>
                                            </div>
                                            <div class="col-9">
                                                <span>{{ $value }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-3">
                                            <span class="f-18 fw-bold">Situação</span>
                                        </div>
                                        <div class="col-9">
                                            {!! $product->status_label !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="edit_product" role="tabpanel" aria-labelledby="edit-tab">
                                <div class="card-body">
                                    <form id="edit_product_form">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <div class="row row row-cols-auto mb-3">
                                            <label for="status" class="form-label mr-3">Status*</label>
                                            <div>
                                                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ $product->status == 'active'? 'checked' : '' }}>
                                                <span class="">Produto ativo</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nome*</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Código de barras*</label>
                                            <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Código do sistema*</label>
                                            <input type="text" class="form-control" id="system_code" name="system_code" value="{{ $product->system_code }}" required>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">    
                        <div class="card-header d-flex justify-content-between border-bottom-0">
                            <h5>Estoque</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <button class="nav-link active" id="details_stock_nav" data-bs-toggle="tab" data-bs-target="#details_stock" type="button" role="tab" aria-controls="contact" aria-selected="false">Visão geral</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="history_stock_nav" data-bs-toggle="tab" data-bs-target="#history_stock" type="button" role="tab" aria-controls="contact" aria-selected="false">Histórico</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab_product">
                                <div class="tab-pane fade show active" id="details_stock" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="card-body">
                                        <span>Total 0</span>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="history_stock" role="tabpanel" aria-labelledby="history-tab">
                                    <div class="card-body">
                                        <span>Total 0</span>
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
    