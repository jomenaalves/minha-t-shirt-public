let dataTableUsers;

const WarehousesPage = { 
    init: () => {
        WarehousesPage.setListener();
        WarehousesPage.setDatatableWarehouses();
    },

    setListener: () => {
        $('#create_warehouse_submit').on('click', function() {
            WarehousesPage.createWarehouses();
        });

        $('#create_warehouse_modal').on('hidden.bs.modal', function () {
            $('#create_warehouse_form').trigger("reset");
        });

        $('#create_zipcode').on('blur', function() {
            WarehousesPage.getAddressByZipCode();
        });
    },

    getAddressByZipCode: () => {
        let zipcode = $('#create_zipcode').val();

        $.ajax({
            url: route("warehouses.getAddressByCep", zipcode),
            type: 'GET',
            success: (res) => {
                $('#create_address').val(res.address);
                $('#create_neighborhood').val(res.neighborhood);
                $('#create_city').val(res.city);
                $('#create_state').val(res.state);
            },
            error: (res) => {
                Swal.fire({
                    icon: "error",
                    title: 'Erro',
                    text: 'CEP inválido',
                });
            }
        });
    },

    createWarehouses: () => { 
        let form = $('#create_warehouse_form');
        let formData = new FormData(form[0]);
        $.ajax({
            url: route('warehouses.store'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (res) => {
                Swal.fire({
                    icon: "success",
                    title: 'Sucesso',
                    text: res.message,
                });

                WarehousesPage.setDatatableWarehouses();
                
                $('#create_warehouse_form').trigger("reset");
                $('#create_warehouse_modal').modal('hide');
            },
            error: (res) => {
                Swal.fire({
                    icon: "error",
                    title: 'Erro',
                    text: res.responseJSON.message,
                });
            }
        });
    },

    setDatatableWarehouses: () => { 
        $.ajax({
            url: route('warehouses.loadWarehousesFromDatatable'),
            type: 'GET',
            success: (res) => {
                if (window.dt) {
                    window.dt.destroy();
                }

                window.dt = new simpleDatatables.DataTable('#table_warehouse', {
                    data: {
                        headings: ['Id', 'Descrição', 'Endereço', 'Situação', ''],
                        data: res.map(warehouse => {               
                            return [
                                warehouse.id,
                                warehouse.description,
                                warehouse.address,
                                warehouse.status,
                                `<a id="btn-${warehouse.id}" href="${route('warehouses.show', warehouse.id)}" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-success align-middle btn-edit-warehouse"></a>`
                            ];
                        })
                    },
                    columns: [
                        { select: 0 }, 
                        { select: 1 }, 
                        { select: 2 },
                        { select: 3 },
                        { select: 4, sortable: false } 
                    ],
                    perPage: 10,
                    perPageSelect: false,
                    searchable: false,
                    labels: {
                        noRows: "Nenhum estoque cadastrado",
                        info: "Exibindo de {start} a {end} no total de {rows} resultados",
                        paginate: {
                            "first": "Primeira",
                            "last": "Última",
                            "next": "Próximo",
                            "previous": "Anterior"
                        },
                    },
                });                                         
            },
            error: (res) => {
                Swal.fire({
                    icon: "error",
                    title: 'Erro',
                    text: res.responseJSON.message,
                });
            }
        });  
    }               
}

$(document).ready(() => {
    WarehousesPage.init()
});


