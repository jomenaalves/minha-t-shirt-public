@extends('app.layouts.main')

@section('title', 'Produtos')

@section('filter')
    <i id="filter" class="material-icons">search</i>
@endsection

@section('content')
    <div class="mdl-grid">
        <div class="container">
           <h1>Produtos</h1>
        </div>
    </div>
    <div id="toast-container" class="mdl-js-snackbar mdl-snackbar">
        <div class="mdl-snackbar__text"></div>
        <button class="mdl-snackbar__action" type="button"></button>
    </div>
@endsection

@section('modal-filter')
    <div id="modal_filter">
        <div id="modal_filter_content">
            <div id="modal_filter_close">X</div>
            <form action="#" method="post" class="mdl-grid">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--12-col">
                    <input class="mdl-textfield__input" type="text" name="name">
                    <label class="mdl-textfield__label" for="name">Busque pelo nome</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--12-col">
                    <select class="mdl-textfield__input" name="ordenation">
                        <option value="" selected readonly hidden></option> <!-- Empty option for the floating label effect -->
                        <option value="az">Nome (A-Z)</option>
                        <option value="za">Nome (Z-A)</option>
                    </select>
                    <label class="mdl-textfield__label" for="ordenation">Forma de ordenação</label>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <button type="submit" id="btn_filter" class="mdl-button mdl-js-button mdl-button--raised btn-primary w-100">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>    
@endsection
