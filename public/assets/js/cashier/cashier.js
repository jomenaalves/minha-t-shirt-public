const cashierPage = { 
    init: () => {
        cashierPage.setListener();
        cashierPage.setDatatableCashier();
        cashierPage.addForms();
        cashierPage.createCashier();
    },

    setListener: () => {
        $('#btn_accounting_entry').click(function() {
            $('#product_container').empty();  
            $('#payment_container').empty(); 
            $('.pay-total').text('0,00');
            $('.value-total').text('0,00');
            $('#accounting_entry')[0].reset() 
        });

    },

    setDatatableCashier: () => { 
        $.ajax({
            url: route('cashier.loadCashiersFromDatatable'),
            type: 'GET',
            success: (res) => {
                if (window.dt) {
                    window.dt.destroy();
                }
                                
                cashierPage.optionsProducts(res.products)
                cashierPage.optionsStores(res.stores)

                //Monta a listagem de caixas
                const tableData = res.data.map(item => ({
                    id: item.id,
                    html: [
                        item.date,
                        item.sold,
                        item.out,
                        item.totalCashier,
                        item.paymentMethods,
                        item.quantityProducts,
                        item.status == 0 ? '<label class="badge bg-light-success align-middle">Aberto</label>' : '<label class="badge bg-light-danger align-middle">Fechado</label>',
                        `<i id="edit-cashier-btn-${item.id}" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-success align-middle edit-cashier-btn"></i>`
                    ]
                }))
                .sort((a, b) => b.id - a.id)
                .map(item => item.html);

                window.dt = new simpleDatatables.DataTable('#table_cashier', {
                    data: {
                        headings: ['Data', 'Vendido','Saidas', 'Total no caixa', 'Formas de pagamento', 'Qtd. de produtos', 'Status', ""],
                        data: tableData
                    },
                    columns: [
                        { select: 0 }, 
                        { select: 1 }, 
                        { select: 2 },
                        { select: 3 },
                        { select: 4 },
                        { select: 5 },
                        { select: 6 }, 
                        { select: 7, sortable: false }
                    ],
                    perPage: 10,
                    perPageSelect: false,
                    searchable: false,
                    labels: {
                        info: "Exibindo de {start} a {end} no total de {rows} resultados",
                    },
                });

                // Adiciona evento de click em toda a linha da tabela 
                document.querySelectorAll('tr').forEach(row => {
                    row.addEventListener('click', () => {
                        const cashierId = row.querySelector('.edit-cashier-btn').id.split('-')[3];
                        window.location.href = '/caixa/editar/'+cashierId;
                    });
                });                                         
            },
            error: (res) => {
                if(res.status === 422) {
                    Swal.fire({
                        icon: "error",
                        title: 'Falha na validação dos dados.',
                        text: res.responseJSON.message,
                    });
                    return;
                }
                Swal.fire({
                    icon: "error",
                    title: 'Erro ao listar todos os caixas.',
                    text: 'Tente novamente mais tarde.',
                });
            }
        });  
    },    
    
    addForms: () => {
        let productIdCounter = 1;
        let paymentIdCounter = 1;

        // Adiciona input no form de produtos
        $('#btn_add_products').click(function() {
            let newProduct = $('#product_template').clone().removeAttr('id').removeClass('d-none');

            newProduct.find('#put_products').attr('name', 'product-' + productIdCounter);
            newProduct.find('#put_stock').attr('name', 'stock-' + productIdCounter);
            newProduct.find('#put_quantity').attr('name', 'quantity-' + productIdCounter);
            newProduct.find('#put_price').attr('name', 'price-' + productIdCounter);
            
            productIdCounter++;
            $('#product_container').append(newProduct);
            cashierPage.calculateTotal();
        });

        // Função para remover o input de produto
        $('#product_container').on('click', '.remove-product', function() {
            $(this).closest('.product-item').remove();
            cashierPage.calculateTotal();
        });

        //Calcula o valor das preço x quantidade
        $('#product_container').on('input', 'input#put_quantity, input#put_price', function() {
            cashierPage.calculateTotal();
        });

          //Adiciona input no form de métodos de pagamento
          $('#btn_add_payment_methods').click(function() {
            let newPayment = $('#payment_template').clone().removeAttr('id').removeClass('d-none');

            newPayment.find('#put_methods').attr('name', 'methods-' + paymentIdCounter);
            newPayment.find('#put_value').attr('name', 'value-' + paymentIdCounter);
            
            paymentIdCounter++;
            $('#payment_container').append(newPayment);
            cashierPage.calculatePayTotal();
        });

        // Função para remover o input de produto
        $('#payment_container').on('click', '.remove-payment', function() {
            $(this).closest('.payment-item').remove();
            cashierPage.calculatePayTotal();
        });

        $('#payment_container').on('input', 'input#put_value', function() {
            cashierPage.calculatePayTotal();
        });
    },

    optionsProducts: (products) => {
        
        let $select = $('#put_products');

        $select.empty();
        $select.append('<option selected disabled value="">Selecione um produto</option>');

        $.each(products, function(index, product) {
            var option = $('<option></option>')
                .attr('value', product.id)
                .text(product.name);
            $select.append(option);
        });
    },
   
    optionsStores: (stores) => {
        
        let $select = $('#put_stock');

        $select.empty();
        $select.append('<option selected disabled value="">Selecione a origem</option>');

        $.each(stores, function(index, store) {
            var option = $('<option></option>')
                .attr('value', store.id)
                .text(store.name);
            $select.append(option);
        });
    },

    calculateTotal: () => {
        let total = 0;
    
        $('#product_container .d-flex').each(function() {
            let quantity = parseFloat($(this).find('input#put_quantity').val()) || 0;
            let price = parseFloat($(this).find('input#put_price').val()) || 0;
            total += quantity * price;
        });
    
        let formattedTotal = total.toFixed(2).replace('.', ',');
        let formattedProduct = total.toFixed(2);
        $('.products-total').val(formattedProduct);
        $('.value-total').text(formattedTotal);
    },  

    calculatePayTotal: () => {

        let payTotal = 0;

        $('#payment_container .d-flex').each(function() {
            let payment = parseFloat($(this).find('input#put_value').val()) || 0;
            payTotal += payment;
        });

        let formattedTotal = payTotal.toFixed(2).replace('.', ',');
        $('.pay-total').text(formattedTotal);
    
    },     
    
    createCashier: () => {
        $('#accounting_entry').on('submit', function (e) {
            e.preventDefault();
         
            let msg = "Os valores recebidos estão divergentes:<br><strong>Total vendido: R$ " + $('.value-total').text() + " / Total recebido: R$ " + $('.pay-total').text() + "</strong>";

            if ($('.pay-total').text() !== $('.value-total').text()) {
                Swal.fire({
                    icon: "warning",
                    title: 'Caixa divergente',
                    html: msg,
                });
                return
            }

            let formData = new FormData(this);               

            $.ajax({
                url: route('cashier.create'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: res.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            cashierPage.setDatatableCashier();
                            $('.accounting-entry-modal-lg').modal('hide');
                        }
                    });
                },
                error: function (res) {
                    if(res.status === 422) {
                        Swal.fire({
                            icon: "error",
                            title: 'Falha na validação dos dados.',
                            text: res.responseJSON.message,
                        });
                        return;
                    }
                  
                    Swal.fire({
                        icon: "error",
                        title: 'Erro ao criar usuário.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

};

$(document).ready(() => {
    cashierPage.init();
});
