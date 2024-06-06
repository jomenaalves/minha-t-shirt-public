const ordersPage = { 
    init: () => {
        ordersPage.setListener();
        ordersPage.listOrders();
        ordersPage.createOrder();
    },

    setListener: () => {
        $('#btn_create_order').on('click', function() {
            $('.juridic-person').addClass('d-none');          
        });

    },

    listOrders: () => { 
        $.ajax({
            url: route('app.order.listAllOrders'),
            type: "GET",
            success: function (res) {             
                res.forEach(function(order) {
                    const [statusText, statusClass, statusColor, statusIcon] = ordersPage.getStatusLabel(order.status);
                    const orderHtml = `
                        <div class="col-12 card py-2 px-3 mb-3">
                            <a href="/pedidos/${order.order_id}">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="order-icon ${statusColor}">
                                        ${statusIcon}
                                    </div>
                                    <div class="order-data">
                                    <strong>Número:</strong> ${order.order_number} <br>
                                        <strong>Cliente:</strong> ${order.client} <br>
                                        <strong>Total do pedido</strong> ${globalPage.formatCurrency(order.total)}<br>
                                        <strong>Status:</strong> <span class="badge ${statusClass}">${statusText}</span><br>
                                        <strong>Usuário:</strong> ${order.user}<br>
                                    </div>
                                </div>
                            </a>
                        </div>`;

                    $('#order_list').append(orderHtml);
                });
            },
            error: (res) => {
                if(res.status === 422) {
                    toastr.error('Não foi possível listar os pedidos!', 'Erro');
                    return;
                }
                toastr.error('Erro ao listar os pedidos.', 'Erro');
            }
        });       
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
    
    createOrder: () => {
        $(document).on('submit', '#create_order', function (e) {
            e.preventDefault();
         
            let formData = new FormData(this);  
      
            $.ajax({
                url: route('app.order.newOrder'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    globalPage.closeModal()
                    window.location.href = '/pedidos';
                    toastr.success('Pedido adicionado com sucesso', 'Sucesso');
                },
                error: (res) => {
                    if(res.status === 422) {
                        toastr.error('Não foi possível listar os pedidos!', 'Erro');
                        return;
                    }
                    toastr.error('Erro ao listar os pedidos.', 'Erro');
                }
            });
        })
    },
};

$(document).ready(() => {
    ordersPage.init();
});
