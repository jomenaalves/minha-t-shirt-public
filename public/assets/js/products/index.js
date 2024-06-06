let dataTableUsers;

const ProductPage = { 
    init: () => {
        ProductPage.setListener();
        ProductPage.setDatatableUsers();
    },

    setListener: () => {
        $('#create_product_submit').on('click', function() {
            ProductPage.createProduct();
        });
    },

    createProduct: () => { 
        let form = $('#create_product_form');
        let formData = new FormData(form[0]);
        $.ajax({
            url: route('products.store'),
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
                ProductPage.setDatatableUsers();
                $('#create_product_form').trigger("reset");
                $('#create_product_modal').modal('hide');
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

    setDatatableUsers: () => { 
        $.ajax({
            url: route('products.loadProductsFromDatatable'),
            type: 'GET',
            success: (res) => {
                if (window.dt) {
                    window.dt.destroy();
                }

                window.dt = new simpleDatatables.DataTable('#table_product', {
                    data: {
                        headings: ['Nome', 'Código de barras', 'Código do sistema', ''],
                        data: res.map(product => {               
                            return [
                                product.name,
                                product.barcode,
                                product.system_code,
                                `<a id="btn-${product.id}" href="${route('products.show', product.id)}" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-success align-middle btn-edit-product"></a>`
                            ];
                        })
                    },
                    columns: [
                        { select: 0 }, 
                        { select: 1 }, 
                        { select: 2 },
                        { select: 3, sortable: false } 
                    ],
                    perPage: 10,
                    perPageSelect: false,
                    searchable: false,
                    labels: {
                        noRows: "Nenhum produto cadastrado",
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
    ProductPage.init()
});


