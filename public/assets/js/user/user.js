const userPage = { 
    init: () => {
        userPage.setListener();
        userPage.setDatatableUsers();
        userPage.createUser();
    },

    setListener: () => {

        let serverUrl = window.location.protocol + '//' + window.location.hostname;
        if (window.location.port) {
            serverUrl += ':' + window.location.port;
        }
        
        //Switch para alternar visualizações das permissões 
        $('#user_permission_edit').change(function(){
            if($(this).is(':checked')){
                $('#all_permissions').removeClass('d-none');
            } else {
                $('#all_permissions').addClass('d-none');
            }
        });

        //Limpa o form create_user ao clicar no botão de criar usuario
        $('#btn_create_user').click(function() {
            $('#create_user')[0].reset(); 
        });
    },

    setDatatableUsers: () => { 

        $.ajax({
            url: route('user.loadUsersFromDatatable'),
            type: 'GET',
            success: (res) => {

                if (window.dt) {
                    window.dt.destroy();
                }
                
                const tableData = res.map(item => ({
                    id: item.id,
                    html: [
                        item.photo ? `<img class="img-radius img-fluid wid-40 me-2 align-middle list-photo" src="${item.photo}" alt="User image"> ${item.name}` : `<img class="img-radius img-fluid wid-40 me-2 align-middle" src="../assets/images/user/user_default.jpg" alt="User image"> ${item.name}`,
                        item.username,
                        item.function.charAt(0).toUpperCase() + item.function.slice(1),
                        item.status === 1 ? '<label class="badge bg-light-success align-middle">Ativo</label>' : '<label class="badge bg-light-danger align-middle">Inativo</label>',
                        `<i id="edit-btn-${item.id}" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-success align-middle edit-btn"></i>`
                    ]
                }))
                .sort((a, b) => b.id - a.id)
                .map(item => item.html);

                window.dt = new simpleDatatables.DataTable('#table-user', {
                    data: {
                        headings: ['Nome', 'Nome de Usuário','Função', 'Situação', ''],
                        data: tableData
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
                        info: "Exibindo de {start} a {end} no total de {rows} resultados",
                    },
                });

               //Adiciona evento de click em toda a linha da tabela 
               document.querySelectorAll('tr').forEach(row => {
                    row.addEventListener('click', () => {
                        const userId = row.querySelector('.edit-btn').id.split('-')[2];
                        window.location.href = `/usuarios/editar/${userId}`;
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
                    title: 'Erro ao listar usuários.',
                    text: 'Tente novamente mais tarde.',
                });
            }
        });  
    },     
    
    createUser: () => {
        $('#create_user').on('submit', function (e) {
            e.preventDefault();

            let formData = userPage.preparePermissions(this);

            $.ajax({
                url: route('user.createUser'),
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
                            userPage.setDatatableUsers();
                            $('.create-user-modal-lg').modal('hide');
                            $('#create_user')[0].reset();
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

    preparePermissions:(form) => {

        let formData = new FormData(form);       

        let checkboxNames = [
            'products_web',
            'stock_web',
            'cash_register_web',
            'to_pay_web',
            'users_web',
            'reports_web',
            'orders_web',
            'settings_nfe_web',
            'nfe_web',
            'movement_history_web',
            'products_app',
            'stocks_app',
            'cash_register_app',
            'freight_app',
            'orders_app',
        ];
    
        checkboxNames.forEach(function(name) {            
            if (!$('[name="' + name + '"]').is(":checked")) {
                formData.append(name, 'off');
            }
        });
    
        return formData;
    },
}

$(document).ready(() => {
    userPage.init()
});


