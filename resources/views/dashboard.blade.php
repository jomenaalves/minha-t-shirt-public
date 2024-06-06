@extends('layouts.main')

@section('title', 'Dashboard 23')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12 d-flex justify-content-between">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard - Visão geral</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target=".open-cashier-modal-md">Download do app</button>                            
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <div class="row">
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-secondary order-card">
                        <div class="card-body">
                        <h5 class="text-white">Número total de peças<br>em estoque</h5>
                        <h1 class="text-white quantity-products">3821</h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">loyalty</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-primary order-card">
                        <div class="card-body">
                        <h5 class="text-white">Número de produtos com<br>estoque negativo</h5>
                        <h1 class="text-white sold">12</h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">remove_circle</i>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-dark order-card">
                        <div class="card-body">
                        <h5 class="text-white">Número de produtos com<br>estoque positivo</h5>
                        <h1 class="text-white withdrawal">28</h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">arrow_circle_up</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3">
                    <div class="card bg-danger order-card">
                        <div class="card-body">
                        <h5 class="text-white">Número de produtos com<br>estoque zerado</h5>
                        <h1 class="text-white total-cashier">14</h1>
                        <i class="material-icons-two-tone d-block f-46 card-icon text-white">arrow_circle_down</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Últimas movimentações no estoque</h5>
                        </div>
                        <div class="card-body">
                            <div class="latest-update-box ps-5">
                                <div class="row p-t-20 p-b-30">
                                    <div class="col-auto text-end update-meta">
                                        <p class="text-muted m-b-0 d-inline-flex">2 hrs ago</p>
                                        <i class="feather icon-twitter bg-info update-icon"></i>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#!">
                                            <h6>+ 1652 Followers</h6>
                                        </a>
                                        <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
                                    </div>
                                </div>                               
                                <div class="row p-b-30">
                                    <div class="col-auto text-end update-meta">
                                        <p class="text-muted m-b-0 d-inline-flex">4 hrs ago</p>
                                        <i class="feather icon-briefcase bg-danger update-icon"></i>
                                    </div>
                                    <div class="col">
                                        <a href="#!">
                                            <h6>+ 5 New Products were added!</h6>
                                        </a>
                                        <p class="text-muted m-b-0">Congratulations!</p>
                                    </div>
                                </div>
                                <div class="row p-b-30">
                                    <div class="col-auto text-end update-meta">
                                        <p class="text-muted m-b-0 d-inline-flex">1 day ago</p>
                                        <i class="feather icon-check f-w-600 bg-success update-icon"></i>
                                    </div>
                                    <div class="col">
                                        <a href="#!">
                                            <h6>Database backup completed!</h6>
                                        </a>
                                        <p class="text-muted m-b-0">Download the <span class="text-primary"> <a href="#!" class="text-primary">latest backup</a> </span>.</p>
                                    </div>
                                </div>
                                <div class="row p-b-30">
                                    <div class="col-auto text-end update-meta">
                                        <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>
                                        <i class="feather icon-facebook bg-primary update-icon"></i>
                                    </div>
                                    <div class="col">
                                        <a href="#!">
                                            <h6>+2 Friend Requests</h6>
                                        </a>
                                        <p class="text-muted m-b-10">This is great, keep it up!</p>
                                    </div>
                                </div>
                                <div class="row p-b-30">
                                    <div class="col-auto text-end update-meta">
                                        <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>
                                        <i class="feather icon-facebook bg-primary update-icon"></i>
                                    </div>
                                    <div class="col">
                                        <a href="#!">
                                            <h6>+2 Friend Requests</h6>
                                        </a>
                                        <p class="text-muted m-b-10">This is great, keep it up!</p>
                                    </div>
                                </div>
                                <div class="row p-b-30">
                                    <div class="col-auto text-end update-meta">
                                        <p class="text-muted m-b-0 d-inline-flex">1 day ago</p>
                                        <i class="feather icon-check f-w-600 bg-success update-icon"></i>
                                    </div>
                                    <div class="col">
                                        <a href="#!">
                                            <h6>Database backup completed!</h6>
                                        </a>
                                        <p class="text-muted m-b-0">Download the <span class="text-primary"> <a href="#!" class="text-primary">latest backup</a> </span>.</p>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Visão geral da distribuição do estoque</h5>
                        </div>
                        <div class="card-body">
                            <div id="chart" class="ps-xxl-5 ps-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
