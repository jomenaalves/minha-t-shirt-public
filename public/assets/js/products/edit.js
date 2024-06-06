let dataTableUsers;

const ProductPage = { 
    init: () => {
        ProductPage.setListener();
        ProductPage.setDatatableUsers();
    },

    setListener: () => {
        $('#edit_product_form').on('submit', function(e) {
            e.preventDefault();
            ProductPage.editProduct();
        });
    },

    editProduct: () => { 
        let form = $('#edit_product_form');
        let formData = new FormData(form[0]);

        $.ajax({
            url: route('products.update'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (res) => {
                Swal.fire({
                    icon: "success",
                    title: 'Sucesso',
                    text: res.message,
                }).then(() => { 
                    $('#edit_product_form').trigger("reset");
                    window.location.reload();
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
    },

    setDatatableUsers: () => { 
    },               
}

$(document).ready(() => {
    ProductPage.init()
});


