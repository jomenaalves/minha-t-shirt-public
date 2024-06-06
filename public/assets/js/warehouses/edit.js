let dataTableUsers;
let productIdCounter = 1; 
let productRemoveIdCounter = 1;
let productTransferIdCounter = 1;
let productsSelect = [];
let warehousesSelect = [];
let warehouseId = $('#warehouse_id').val();

const WarehousesPage = { 
    init: () => {
        WarehousesPage.setListener();
    },

    setListener: () => {
        WarehousesPage.getProductsStock();
        WarehousesPage.getWarehouses();

        $('#add-stock, #remove-stock, #transfer-stock').on('submit', function(e) {
            e.preventDefault();
            let nameForm = $(this).attr('id');

            WarehousesPage.editWarehouses(nameForm);
        });

        $('#adding-stock-modal, #removing-stock-modal, #transfer-stock-modal').on('hidden.bs.modal', function() {
            $('#product-add-container, #product-remove-container, #product-transfer-container').empty();
            $('#add-stock-observation, #remove-stock-observation, #transfer-stock-observation').addClass('d-none');
            productIdCounter = productRemoveIdCounter = productTransferIdCounter = 1;
        });

        $(document).on('click', '.clear-product', function() {
            let id = $(this).attr('id');
            WarehousesPage.clearProductCard(id);
        });

        $('#zipcode').on('blur', function() {
            WarehousesPage.getAddressByZipCode();
        });

        $('#add-stock-nav-modal').on('submit', function(e) {
            e.preventDefault();
            WarehousesPage.addStock();
        });
        
        $('#btn-add-products').on('click', function() {
            WarehousesPage.addProductsStock();
        });

        $('#remove-stock-nav-modal').on('submit', function(e) {
            e.preventDefault();
            WarehousesPage.removeStock();
        });

        $('#btn-remove-products').on('click', function() {
            WarehousesPage.removeProductsStock();
        });

        $('#transfer-stock-nav-modal').on('submit', function(e) {
            e.preventDefault();
            WarehousesPage.transferStock();
        });

        $('#btn-transfer-products').on('click', function() {
            WarehousesPage.transferProductsStock();
        });

        $('#edit-warehouse-form').on('submit', function(e) {
            e.preventDefault();
            WarehousesPage.updateWarehouse();
        });
    },

    getProductsStock: () => {
        $.ajax({
            url: route('stocks.getProductsStock', warehouseId),
            type: 'GET',
            success: (res) => {
                productsSelect = res;
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

    updateWarehouse: () => {
        let form = $('#edit-warehouse-form');

        let formData = new FormData(form[0]);

        formData.append('warehouse_id', warehouseId);

        $.ajax({
            url: route('warehouses.update'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (res) => {
                Swal.fire({
                    icon: "success",
                    title: 'Sucesso',
                    text: res.message,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
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

    getWarehouses: () => {
        $.ajax({
            url: route('stocks.getWarehouses'),
            type: 'GET',
            success: (res) => {
                warehousesSelect = res;
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

    clearProductCard: (id) => {
        let idSplit = id.split('-');
        $('#product-' + idSplit[1] + '-' + idSplit[2]).remove();
    },

    addProductsStock: () => {
        if(productIdCounter == 1){
            $('#add-stock-observation').removeClass('d-none')
        }

        let newProduct = $('#product-adding-template').clone().removeAttr('id').removeClass('d-none');

        newProduct.attr('id', 'product-add-' + productIdCounter);
        newProduct.find('#put-products').attr('name', 'product_' + productIdCounter);
        productsSelect.forEach((product) => {
            newProduct.find('#put-products').append('<option value="' + product.id + '">' + product.name + '</option>');
        });
        newProduct.find('#put-quantity').attr('name', 'quantity_' + productIdCounter);
        newProduct.find('#clear-add').attr('id', 'clear-add-' + productIdCounter);
        
        productIdCounter++;
        $('#product-add-container').append(newProduct);
    },

    removeProductsStock: () => {
        if(productRemoveIdCounter == 1){
            $('#remove-stock-observation').removeClass('d-none');
        }

        let newProduct = $('#product-remove-template').clone().removeAttr('id').removeClass('d-none');

        newProduct.attr('id', 'product-remove-' + productRemoveIdCounter);
        newProduct.find('#remove-products').attr('name', 'product_' + productRemoveIdCounter);
        productsSelect.forEach((product) => {
            newProduct.find('#remove-products').append('<option value="' + product.id + '">' + product.name + '</option>');
        });
        newProduct.find('#remove-quantity').attr('name', 'quantity_' + productRemoveIdCounter);
        newProduct.find('#clear-remove').attr('id', 'clear-remove-' + productRemoveIdCounter);
        
        productIdCounter++;
        $('#product-remove-container').append(newProduct);
    },

    transferProductsStock: () => {
        if(productTransferIdCounter == 1){
            $('#transfer-stock-observation').removeClass('d-none')
        }

        let newProduct = $('#product-transfer-template').clone().removeAttr('id').removeClass('d-none');

        newProduct.attr('id', 'product-transfer-' + productTransferIdCounter);
        newProduct.find('#transfer-products').attr('name', 'product_' + productTransferIdCounter);
        newProduct.find('#transfer-stocks').attr('name', 'stock_' + productTransferIdCounter);
        newProduct.find('#transfer-quantity').attr('name', 'quantity_' + productTransferIdCounter);
        productsSelect.forEach((product) => {
            newProduct.find('#transfer-products').append('<option value="' + product.id + '">' + product.name + '</option>');
        });
        warehousesSelect.forEach((warehouse) => {
            newProduct.find('#transfer-stocks').append('<option value="' + warehouse.id + '">' + warehouse.description + '</option>');
        });
        newProduct.find('#clear-transfer-product').attr('id', 'clear-transfer-' + productTransferIdCounter);

        productTransferIdCounter++;
        $('#product-transfer-container').append(newProduct);
    },

    getAddressByZipCode: () => {
        let zipcode = $('#zipcode').val();

        $.ajax({
            url: route("warehouses.getAddressByCep", zipcode),
            type: 'GET',
            success: (res) => {
                $('#address').val(res.address);
                $('#neighborhood').val(res.neighborhood);
                $('#city').val(res.city);
                $('#state').val(res.state);
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

    editWarehouses: (nameForm) => {
        let form = $('#' + nameForm);

        let formData = new FormData(form[0]);

        let actionForm = nameForm.split('-')[0];

        formData.append('action', actionForm);
        formData.append('warehouse_id', warehouseId);

        let newFormData = new FormData();

        if(actionForm == 'transfer'){
            let productsWarehouses = WarehousesPage.groupWarehouses(actionForm);
            formData.append('products', JSON.stringify(productsWarehouses));

            for (let [key, value] of formData.entries()) {
                if (!key.startsWith('product_') && !key.startsWith('quantity_') && !key.startsWith('stock_')) {
                    newFormData.append(key, value);
                }

                if (key.startsWith('quantity_') && WarehousesPage.validateQuantityProducts(value)) return;
            }
        }else{
            // Chama a função para agrupar produtos em um objeto
            let products = WarehousesPage.groupProducts(actionForm);

            formData.append('products', JSON.stringify(products));
       
            for (let [key, value] of formData.entries()) {
                if (!key.startsWith('product_') && !key.startsWith('quantity_')) {
                    newFormData.append(key, value);
                }

                if (key.startsWith('quantity_') && WarehousesPage.validateQuantityProducts(value)) return;
            }
        }

        $.ajax({
            url: route('stocks.update'),
            type: 'POST',
            data: newFormData,
            contentType: false,
            processData: false,
            success: (res) => {
                Swal.fire({
                    icon: "success",
                    title: 'Sucesso',
                    text: res.message,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
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

    validateQuantityProducts: (value) => {
        if (value < 1) {
            Swal.fire({
                icon: "error",
                title: 'Erro',
                text: "A quantidade de cada produto deve ser maior que 0.",
            });

            return true;
        }

        return false;
    },

    groupProducts: (actionForm) => {
        let products = [];

        $('#product-' + actionForm + '-container .product-item').each(function() {
            let productKey = $(this).find('[name^="product_"]').val();
            let quantity = $(this).find('[name^="quantity_"]').val();

            if (productKey && quantity) {
                products.push({ product_id: productKey, qty: quantity });
            }
        });

        return products;
    },

    groupWarehouses: (actionForm) => {
        let products = [];

        $('#product-' + actionForm + '-container .product-item').each(function() {
            let productKey = $(this).find('[name^="product_"]').val();
            let quantity = $(this).find('[name^="quantity_"]').val();
            let stock = $(this).find('[name^="stock_"]').val();

            if (productKey && quantity) {
                products.push({ product_id: productKey, qty: quantity, stock_id: stock });
            }
        });

        return products;
    }
};

$(document).ready(() => {
    WarehousesPage.init();
});


