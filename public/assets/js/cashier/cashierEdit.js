let paymentIdCounter = 1;
const editCashierPage = { 
    init: () => {
        editCashierPage.setListener();
        editCashierPage.setDatatableCashier();
        editCashierPage.closeCashier();
        editCashierPage.addForms();
        editCashierPage.addProducts();
        editCashierPage.updateNote();
        editCashierPage.addWithdrawal();
        editCashierPage.removeItem();
        editCashierPage.updateItem();
        editCashierPage.updatePayments();
        editCashierPage.openCashier();
    },

    setListener: () => {
        let url = window.location.href;
        id = url.match(/\d+$/)[0];

        $('#btn_adding_products').click(function() {
            $('#product_edit_container').empty(); 
        });
        $('#btn_methods_payment').click(function() {
            $('#payment_edit_container').empty(); 
        });
        $('#btn_add_withdrawal').click(function() {
            $('#withdrawal')[0].reset(); 
        });
        $('#btn_methods_payment').click(function() {
            $('#payment_form_container').empty()
            $('#update_payment')[0].reset(); 
            paymentIdCounter = 1;
        });
    },

    setDatatableCashier: () => { 
        $.ajax({
            url: route('cashier.details'),
            type: 'GET',
            data: {
                'id': id,
            },
            success: (res) => {
                if (window.dt) {
                    window.dt.destroy();
                }

                editCashierPage.optionsProducts(res.select_products)
                editCashierPage.optionsStores(res.select_stores)
                editCashierPage.setDatatableWithdrawal(res.withdrawal)

                let columnsConfig = [
                    { select: 0 }, 
                    { select: 1 }, 
                    { select: 2 },
                    { select: 3 },
                    { select: 4 },
                    { select: 5, sortable: false }
                ]

                let headingsConfig = ['Produtos', 'Estoque', 'Quantidade', 'Preço', 'Total', ''];

                $('.quantity-products').text(res.quantity_products)
                $('.sold').text(res.sold)
                $('.withdrawal').text(res.total_withdrawal)
                $('.total-cashier').text(res.total_cashier)
                $('.payment').html(res.payment)
                $('.note').text(res.note)
                $('#input_note').val(res.note)

                if(res.value_total_payments != res.value_total_products){
                    $('.divergent-payment-cashier').removeClass('d-none')
                    $('.total-sales').text('R$ '+res.value_total_products)
                    $('.total-payments').text('R$ '+res.value_total_payments)
                } else {
                    $('.divergent-payment-cashier').addClass('d-none')
                }

                let tableData = res.products.map(item => ({
                    id: item.id,
                    html: [
                        item.product_name,
                        item.store_name,
                        item.quantity,
                        item.price,
                        item.total,
                        res.status == 0 ? `<i id="btn-edit-cashier-product" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-success align-middle me-3" onclick="editCashierPage.loadCashierProduct(${item.cashier_product},'update')"></i> <i id="btn-delete-cashier-product" class="icon feather icon-trash f-w-600 f-16 m-r-15 text-danger align-middle" onclick="editCashierPage.loadCashierProduct(${item.cashier_product}, 'remove')"></i>
                        ` : ''
                    ]
                }))
                .sort((a, b) => b.id - a.id)
                .map(item => item.html);

                if (res.status == 1) {
                    $('.close-cashier').removeClass('d-none')
                    $('#btn_methods_payment').addClass('d-none')
                    $('.btn-update-note').addClass('d-none')
                    $('.options').addClass('d-none')

                    headingsConfig.splice(5, 1); // Remove the 6th heading
                    columnsConfig.splice(5, 1);  // Remove the 6th column config
                    tableData = tableData.map(row => row.slice(0, 5)); // Remove the 6th column data from each row
                } else {
                    $('.close-cashier').addClass('d-none')
                    $('#btn_methods_payment').removeClass('d-none')
                    $('.btn-update-note').removeClass('d-none')
                    $('.options').removeClass('d-none')
                }

                window.dt = new simpleDatatables.DataTable('#table_cashier_edit', {
                    data: {
                        headings: headingsConfig,
                        data: tableData
                    },
                    columns: columnsConfig,
                    perPage: 10,
                    perPageSelect: false,
                    searchable: false,
                    labels: {
                        info: "Exibindo de {start} a {end} no total de {rows} resultados",
                    },
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
                    title: 'Erro ao listar NF-es.',
                    text: 'Tente novamente mais tarde.',
                });
            }
        });  
    },
    
    setDatatableWithdrawal: (withdrawal) => { 

        if (window.dt) {
            $('#table_withdrawal').empty()
        }
        
        const tableData = withdrawal.map(item => ({
            id: item.id,
            html: [
                item.date,
                item.value,
                item.note,
            ]
        }))
        .sort((a, b) => b.id - a.id)
        .map(item => item.html);

        window.dt = new simpleDatatables.DataTable('#table_withdrawal', {
            data: {
                headings: ['Data', 'Valor','Descrição'],
                data: tableData
            },
            columns: [
                { select: 0 }, 
                { select: 1 }, 
                { select: 2 },
            ],
            perPage: 10,
            perPageSelect: false,
            searchable: false,
            labels: {
                info: "Exibindo de {start} a {end} no total de {rows} resultados",
            },
        });      
    }, 

    addForms: () => {
        //Adiciona input no form de produtos
        let productIdCounter = 1;

        $('#btn_edit_products').click(function() {
            let newProduct = $('#product_edit_template').clone().removeAttr('id').removeClass('d-none');

            newProduct.find('#put_products').attr('name', 'product-' + productIdCounter);
            newProduct.find('#put_stock').attr('name', 'stock-' + productIdCounter);
            newProduct.find('#put_quantity').attr('name', 'quantity-' + productIdCounter);
            newProduct.find('#put_price').attr('name', 'price-' + productIdCounter);
            
            productIdCounter++;
            $('#product_edit_container').append(newProduct);
        });

        // Função para remover o input de produto
        $('#product_edit_container').on('click', '.remove-product', function() {
            $(this).closest('.product-item').remove();
        });

        $('#btn_edit_payment').click(function() {
            let newPayment = $('#payment_edit_template').clone().removeAttr('id').removeClass('d-none');

            newPayment.find('#put_method').attr('name', 'methods-' + paymentIdCounter);
            newPayment.find('#put_value').attr('name', 'value-' + paymentIdCounter);
                
            paymentIdCounter++;
            $('#payment_edit_container').append(newPayment);
        });

        // Função para remover o input de produto
        $('#payment_edit_container').on('click', '.remove-payment', function() {
            $(this).closest('.payment-item').remove();
        });;

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

    addProducts: () => {
        $('#adding_products').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('cashier_id', id); 

            $.ajax({
                url: route('cashier.addProducts'),
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
                            editCashierPage.setDatatableCashier();
                            $('.adding-products-modal-lg').modal('hide');
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
                        title: 'Erro ao inserir os produtos.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    updateNote: () => {
        $('#update_note').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('cashier_id', id); 

            $.ajax({
                url: route('cashier.updateNote'),
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
                            editCashierPage.setDatatableCashier();
                            $('.update-note-modal-md').modal('hide');
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
                        title: 'Erro ao atualizar a observação.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    addWithdrawal: () => {
        $('#withdrawal').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('cashier_id', id); 

            $.ajax({
                url: route('cashier.withdrawal'),
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
                            editCashierPage.setDatatableCashier();
                            $('.withdrawal-modal-md').modal('hide');
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
                        title: 'Erro ao inserir a retirada.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    closeCashier: () => {

        $('#btn_close_cashier').click(function() {
            Swal.fire({
                icon: "warning",
                title: 'Atenção',
                text: 'O caixa será fechado e após isso os itens não poderão ser editados. Você deseja continuar?',
                showCancelButton: true,
                confirmButtonText: 'Sim, fechar caixa',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: route('cashier.close'),
                        type: "POST",
                        data: { 'cashier_id': id },
                        success: function (res) {
                            Swal.fire({
                                icon: "success",
                                title: "Sucesso!",
                                text: res.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    editCashierPage.setDatatableCashier();
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
                                title: 'Erro ao fechar o caixa.',
                                text: 'Tente novamente mais tarde.',
                            });
                        },
                    });
                } 
            });
        })

       
    },

    loadCashierProduct: (id, action) => {

        let formData = new FormData; 
        formData.append('cashier_product_id', id); 

        $.ajax({
            url: route('cashier.loadCashierProduct'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (action == 'remove') {
                    $('#cashier_product_id').val(res.id)
                    $('.remove-product').text(res.product)
                    $('.remove-store').text(res.store)
                    $('.remove-quantity').text('+'+res.quantity)                
                    $('.remove-item-modal-md').modal('show')             
                } else if (action == 'update') {
                    $('#update_cashier_product_id').val(res.id)
                    $('.update-product').text(res.product)
                    $('.update-store').text(res.store)
                    $('.update-quantity').text('+'+res.quantity)                
                    $('#update_new_quantity').val(res.quantity)                
                    $('.update-item-modal-md').modal('show')             
                }
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
                    title: 'Erro ao inserir a retirada.',
                    text: 'Tente novamente mais tarde.',
                });
            },
        });
    },

    removeItem: () => {
        $('#remove_item').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 

            $.ajax({
                url: route('cashier.removeItem'),
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
                            editCashierPage.setDatatableCashier();
                            $('.remove-item-modal-md').modal('hide');
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
                        title: 'Erro ao remover o item.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    updateItem: () => {
        $('#update_item').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 

            $.ajax({
                url: route('cashier.updateItem'),
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
                            editCashierPage.setDatatableCashier();
                            $('.update-item-modal-md').modal('hide');
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
                        title: 'Erro ao atualizar o item.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    loadCashierPayments: () => {

        let formData = new FormData; 
        formData.append('id', id); 

        $.ajax({
            url: route('cashier.loadCashierPayment'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                const formContainer = document.getElementById('payment_form_container');

                    res.forEach(payment => {
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'row mb-3';
                    rowDiv.id = `payment_row_${payment.id}`;

                    const methodDiv = document.createElement('div');
                    methodDiv.className = 'col-6 form-group pe-2';
                    methodDiv.innerHTML = `
                        <label class="form-label" for="put_method_${paymentIdCounter}">Forma de pagamento<span class="req-march">*</span></label>
                        <select class="form-select" id="put_method_${paymentIdCounter}" name="methods-${paymentIdCounter}">
                            <option selected disabled>Método de pagamento</option>
                            <option value="pix" ${payment.method === 'pix' ? 'selected' : ''}>Pix</option>
                            <option value="transfer" ${payment.method === 'transfer' ? 'selected' : ''}>Transferência (TED/DOC)</option>
                            <option value="money" ${payment.method === 'money' ? 'selected' : ''}>Dinheiro</option>
                            <option value="credit_card" ${payment.method === 'credit_card' ? 'selected' : ''}>Cartão de crédito</option>
                            <option value="debit_card" ${payment.method === 'debit_card' ? 'selected' : ''}>Cartão de débito</option>
                            <option value="others" ${payment.method === 'others' ? 'selected' : ''}>Outros</option>
                        </select>
                    `;

                    const valueDiv = document.createElement('div');
                    valueDiv.className = 'col-5 form-group ps-2';
                    valueDiv.innerHTML = `
                        <label class="form-label" for="put_value_${paymentIdCounter}">Valor recebido<span class="req-march">*</span></label>
                        <input type="text" class="form-control" id="put_value_${paymentIdCounter}" name="value-${paymentIdCounter}" value="${payment.value}" placeholder="Insira o valor">
                    `;

                    const removeDiv = document.createElement('div');
                    removeDiv.className = 'col-1 remove ps-0 ms-n2';
                    removeDiv.innerHTML = `
                        <button type="button" class="btn btn-link-danger remove-payment" data-id="${payment.id}"><i class="ti ti-trash"></i></button>
                    `;

                    rowDiv.appendChild(methodDiv);
                    rowDiv.appendChild(valueDiv);
                    rowDiv.appendChild(removeDiv);

                    formContainer.appendChild(rowDiv);
                    paymentIdCounter++;
                });

                formContainer.addEventListener('click', function(event) {
                    if (event.target.closest('.remove-payment')) {
                        const button = event.target.closest('.remove-payment');
                        const paymentId = button.getAttribute('data-id');
                        const rowToRemove = document.getElementById(`payment_row_${paymentId}`);
                        if (rowToRemove) {
                            rowToRemove.remove();
                        }
                    }
                });
            $('.update-payment-modal-md').modal('show')


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
                    title: 'Erro ao carregar os dados de pagamento.',
                    text: 'Tente novamente mais tarde.',
                });
            },
        });
    },

    updatePayments: () => {
        $('#update_payment').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('cashier_id', id);

            $.ajax({
                url: route('cashier.updatePayments'),
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
                            editCashierPage.setDatatableCashier();
                            $('.update-payment-modal-md').modal('hide');
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
                        title: 'Erro ao atualizar o item.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    openCashier: () => {
        $('#open_cashier').on('submit', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('cashier_id', id);

            $.ajax({
                url: route('cashier.openCashier'),
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
                            editCashierPage.setDatatableCashier();
                            $('.open-cashier-modal-md').modal('hide');
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
                        title: 'Erro ao abrir o caixa.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },
};

$(document).ready(() => {
    editCashierPage.init();
});
