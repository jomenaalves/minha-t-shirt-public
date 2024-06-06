const editOrdersPage = { 
    init: () => {
        editOrdersPage.setListener();
        editOrdersPage.detailsOrder();
        editOrdersPage.updateClient();
        editOrdersPage.updateAddress();
        editOrdersPage.updateDiscount();
        editOrdersPage.updateProduct();
    },

    setListener: () => {
        let url = window.location.href;
        id = url.match(/\d+$/)[0];

        $('#btn_edit_order').click(function() {
            $('#modal_template').show(); 
            editOrdersPage. detailsOrder()            
        })
       
        $('#btn_edit_address').click(function() {
            $('#modal_template').show(); 
            editOrdersPage. detailsOrder()
        })     
      
        $('#btn_edit_discount').click(function() {
            $('#modal_template').show(); 
            editOrdersPage. detailsOrder()
        })     
        
        $('#btn_edit_products').click(function() {
            $('#modal_template').show(); 
            editOrdersPage. detailsOrder()
            editOrdersPage. optionsProducts()
        })     

        $('#generatePaymentLink').on('click', function() {
            $.ajax({
                url: route('app.order.generatePaymentLink'),
                type: "post",
                data: {
                    order_id: id,
                },
                success: function (res) { 
                    $('#payment-link-content').html(`
                        <div class="align-items-end d-flex justify-content-between">
                            <p class="m-0"><strong>Link de pagamento</strong></p>
                        </div>
                        <hr>
                        <div class="payment-link">
                            <a href="${res.paymentLink}" target="_blank">${res.paymentLink}</a>
                        </div>
                    `);

                    editOrdersPage.detailsOrder();
                    
                    toastr.success('Link de pagamento gerado com sucesso!', 'Sucesso');
                },
                error: (res) => {
                    if(res.status === 422) {
                        toastr.error('Não foi possível gerar o link de pagamento!', 'Erro');
                        return;
                    }
                    toastr.error('Erro ao gerar o link de pagamento.', 'Erro');
                }
            });
        });
    },

    detailsOrder: () => {
        $.ajax({
            url: route('app.order.detailsOrder'),
            type: "post",
            data: {
                'id': id,
            },
            success: function (res) { 
                let [data] = res

                $('.client-details').empty();
                let htmlClient = `
                    Número: #${data.order_number}<br>
                    Cliente: ${data.client_name}<br>
                    Telefone: ${globalPage.maskPhone(data.client_phone)}<br>
                    CPF: ${globalPage.maskCpfCnpj(data.client_document)}<br>
                    ${data.client_register ? `RG: ${globalPage.maskRG(data.client_register)}<br>` : ''}
                    E-mail: ${data.client_email}
                `;
                $('.client-details').append(htmlClient);

                $('#document').val(globalPage.maskCpfCnpj(data.client_document))
                $('#name').val(data.client_name)
                $('#register').val(globalPage.maskRG(data.client_register))
                $('#phone').val(globalPage.maskPhone(data.client_phone))
                $('#email').val(data.client_email)
                $('#corporate-reason').val(data.client_corporate_reason)
                $('#state-registration').val(data.client_state_registration)

                $('.client-address').empty();
                let htmlAddress = `
                ${data.client_cep ? `CEP: ${globalPage.maskCEP(data.client_cep)}<br>` : ''}
                ${data.client_address ? `${data.client_address},` : ''} ${data.client_number ? `${data.client_number}<br>` : ''}
                ${data.client_complement ? `${data.client_complement}<br>` : ''}
                ${data.client_neighborhood ? `${data.client_neighborhood}<br>` : ''}
                ${data.client_city ? `${data.client_city} -` : ''}  ${data.client_state ? `${data.client_state}<br>` : ''}
                `;
                $('.client-address').append(htmlAddress);

                $('#cep').val(globalPage.maskCEP(data.client_cep))
                $('#address').val(data.client_address)
                $('#number').val(data.client_number)
                $('#complement').val(data.client_complement)
                $('#neighborhood').val(data.client_neighborhood)
                $('#city').val(data.client_city)
                $('#state').val(data.client_state)

                let total_value = editOrdersPage.calculateTotal(data.order_products)
                const [statusText, statusClass] = editOrdersPage.getStatusLabel(data.order_status);

                let totalOrder = 0
                let discount = 0
                if (data?.order_transaction?.payment_method) {
                    editOrdersPage.selectPaymentMethod(data.order_transaction.payment_method)  
                    if (data.order_transaction.payment_method == 'percentage') {
                        let totalDiscount = (total_value + parseFloat(data.order_transaction.total_freight)) * (parseFloat(data.order_transaction.discount) / 100)
                        totalOrder = (total_value + parseFloat(data.order_transaction.total_freight)) - totalDiscount

                        discount = parseFloat(data.order_transaction?.discount)+'%'

                    } else {
                        totalOrder = (total_value + parseFloat(data.order_transaction.total_freight)) - parseFloat(data.order_transaction.discount) 

                        discount = globalPage.formatCurrency(data.order_transaction.discount)
                    }                    
                }

                $('.order-items').empty();
                let htmlTotalItems = `
                    Total dos produtos: ${globalPage.formatCurrency(total_value)}<br>
                    Total do frete: ${globalPage.formatCurrency(data.order_transaction?.total_freight ?? 0.00)} <br>
                    Total do desconto:  ${discount}<br>
                    Total do pedido: ${globalPage.formatCurrency(totalOrder ?? 0.00)}<br>
                    Status:  <span class="badge ${statusClass}">${statusText}</span>
                `;
                $('.order-items').append(htmlTotalItems);

                $('#transaction_id').val(data.order_transaction?.id)   
                $('#amount').val(total_value)   
                $('#freight').val(data.order_transaction?.total_freight)   
                $('#discount_value').val(editOrdersPage.formatDiscountValue(discount)) 
                

                editOrdersPage.listItemsProducts(data)

            },
            error: (res) => {
                if(res.status === 422) {
                    toastr.error('Não foi possível listar o pedido!', 'Erro');
                    return;
                }
                toastr.error('Erro ao listar o pedido.', 'Erro');
            }
        });       
    }, 

    selectPaymentMethod:(paymentMethod) => {
        var selectElement = document.getElementById('payment_type');
        selectElement.value = paymentMethod;
    },

    formatDiscountValue: (value) => {
        if (typeof value !== 'string') {
            value = String(value);
        }
        value = value.replace(/[^0-9,\.]/g, '');
        value = value.replace(',', '.');
        let formattedValue = parseFloat(value);
        return formattedValue;
    },

    getStatusLabel: (status) => {
        switch (status) {
            case 0:
                return ["Aberto", "bg-secondary", "open", "<i class='bx bxs-keyboard'></i>"];
            case 1:
                return ["Aguardando pagamento", "bg-warning", "waiting", "<i class='bx bx-time-five'></i>"];
            case 2:
                return ["Pago", "bg-success", "closed", "<i class='bx bx-check'></i>"];
            case 3:
                return ["Cancelado", "bg-danger", "canceled", "<i class='bx bxs-error-circle'></i>"];
        }
    },   
  
    optionsProducts: () => {
              
        $.ajax({
            url: route('app.order.allProducts'),
            type: "POST",
            success: function (res) {
                let $select = $('#select_products');

                $select.empty();
                $select.append('<option selected disabled value="">Selecione um produto</option>');

                $.each(res, function(index, product) {
                    var option = $('<option></option>')
                        .attr('value', product.id)
                        .text(product.name);
                    $select.append(option);
                });
            },
            error: (res) => {
                if(res.status === 422) {
                    toastr.error('Não foi possível carregar todos os produtos', 'Erro');
                    return;
                }
                toastr.error('Erro ao carregar os produtos.', 'Erro');
            }
        });             
    },
       
    calculateTotal:(produtos) => {
        let total = 0;
        for (let i = 0; i < produtos.length; i++) {
            const produto = produtos[i];
            const subtotal = parseFloat(produto.price) * produto.quantity;
            total += subtotal;
        }
        return total;
    },

    listItemsProducts:(orders)=>{
        $('#order-list').empty();
        orders.order_products.forEach(function(order) {        
            let productName = order.product.name;
            let price = globalPage.formatCurrency(order.price);
            let quantity = order.quantity;
            let total = quantity * order.price;
            let listItem = document.createElement('li');
            listItem.innerHTML ='<div class="mb-2">'+ productName + ' (x' + quantity + ')<br>' + '<small>Unit: ' + price + ' / Total: '+ globalPage.formatCurrency(total) + '</small></div><i class="bx bx-trash me-3" onclick="editOrdersPage.deleteProduct('+order.id+')"></i>';
            document.getElementById('order-list').appendChild(listItem);           
        });
    },
   
    
    updateClient: () => {
        $(document).on('submit', '#edit_order', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('id', id); 
      
            $.ajax({
                url: route('app.order.updateClient'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    globalPage.closeModal()
                    editOrdersPage.detailsOrder()
                    toastr.success('Pedido alteradoo com sucesso', 'Sucesso');
                },
                error: (res) => {
                    if(res.status === 422) {
                        toastr.error('Não foi possível alterar o pedido!', 'Erro');
                        return;
                    }
                    toastr.error('Erro ao alterar o pedido.', 'Erro');
                }
            });
        })
    },
    
    updateAddress: () => {
        $(document).on('submit', '#edit_address', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('id', id); 
      
            $.ajax({
                url: route('app.order.updateAddress'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    globalPage.closeModal()
                    editOrdersPage.detailsOrder()
                    toastr.success('Pedido alterado com sucesso', 'Sucesso');
                },
                error: (res) => {
                    if(res.status === 422) {
                        toastr.error('Não foi possível alterar o pedido!', 'Erro');
                        return;
                    }
                    toastr.error('Erro ao alterar o pedido.', 'Erro');
                }
            });
        })
    },
    
    updateDiscount: () => {
        $(document).on('submit', '#edit_discount', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('id', id); 
      
            $.ajax({
                url: route('app.order.updateDiscount'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    globalPage.closeModal()
                    editOrdersPage.detailsOrder()
                    toastr.success('Pedido alterado com sucesso', 'Sucesso');
                },
                error: (res) => {
                    if(res.status === 422) {
                        toastr.error('Não foi possível alterar o pedido!', 'Erro');
                        return;
                    }
                    toastr.error('Erro ao alterar o pedido.', 'Erro');
                }
            });
        })
    },

    updateProduct: () => {
        $(document).on('submit', '#edit_products', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this); 
            formData.append('id', id); 
      
            $.ajax({
                url: route('app.order.updateProducts'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    globalPage.closeModal()
                    editOrdersPage.detailsOrder()
                    toastr.success('Pedido alterado com sucesso', 'Sucesso');
                },
                error: (res) => {
                    if(res.status === 422) {
                        toastr.error('Não foi possível alterar o pedido!', 'Erro');
                        return;
                    }
                    toastr.error('Erro ao alterar o pedido.', 'Erro');
                }
            });
        })
    },

    deleteProduct: (id) => {
               
        let formData = new FormData(); 
        formData.append('id', id); 
    
        $.ajax({
            url: route('app.order.deleteProduct'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                globalPage.closeModal()
                editOrdersPage.detailsOrder()
                toastr.success('Produto deletado com sucesso', 'Sucesso');
            },
            error: (res) => {
                if(res.status === 422) {
                    toastr.error('Não foi possível deletar o produto', 'Erro');
                    return;
                }
                toastr.error('Erro ao deletar o produto.', 'Erro');
            }
        });        
    },

};

$(document).ready(() => {
    editOrdersPage.init();
});
