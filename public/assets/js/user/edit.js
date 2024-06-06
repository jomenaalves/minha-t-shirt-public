
let id;
const editPage = { 
    init: () => {
        editPage.setListener();
        editPage.getDataUser();
        editPage.updateDetailsProfile();
        editPage.updatePermissionsUser();
        editPage.updatePasswordUser();
        editPage.updatePhotoUser();
    },

    setListener: () => {
        
        let serverUrl = window.location.protocol + '//' + window.location.hostname;
        if (window.location.port) {
            serverUrl += ':' + window.location.port;
        }

        let url = window.location.href;
        id = url.match(/\d+$/)[0];
               
    },

    getDataUser: () => {

        $.ajax({
            url: route('user.getDataUser'),
            type: "GET",
            data: {
                'id': id,
            },
            success: function (res) {   
                $('#name').val(res.name);         
                $('#username').val(res.username);         
                $('#function').val(res.function); 
                $('#photo_profile').html(res.photo == null ? `<img src="${serverUrl}/assets/images/user/user_default.jpg" alt="user-image" class="img-fluid rounded-circle wid-100"></img>`: `<img src="${res.photo}" alt="user-image" class="img-fluid rounded-circle wid-100"></img>`);

                res.status == 1 ? $('#user_is_active').prop('checked', true) : $('#user_is_active').prop('checked', false);
                res.permissions.permission_edit == 'on' ? $('#user_permission_edit').prop('checked', true) : $('#user_permission_edit').prop('checked', false);
                res.permissions.products_web == 'on' ? $('#products_web').prop('checked', true) : $('#products_web').prop('checked', false);
                res.permissions.stock_web == 'on' ? $('#stock_web').prop('checked', true) : $('#stock_web').prop('checked', false);
                res.permissions.cash_register_web == 'on' ? $('#cash_register_web').prop('checked', true) : $('#cash_register_web').prop('checked', false);
                res.permissions.to_pay_web == 'on' ? $('#to_pay_web').prop('checked', true) : $('#to_pay_web').prop('checked', false);
                res.permissions.users_web == 'on' ? $('#users_web').prop('checked', true) : $('#users_web').prop('checked', false);
                res.permissions.reports_web == 'on' ? $('#reports_web').prop('checked', true) : $('#reports_web').prop('checked', false);
                res.permissions.orders_web == 'on' ? $('#orders_web').prop('checked', true) : $('#orders_web').prop('checked', false);
                res.permissions.settings_nfe_web == 'on' ? $('#settings_nfe_web').prop('checked', true) : $('#settings_nfe_web').prop('checked', false);
                res.permissions.nfe_web == 'on' ? $('#nfe_web').prop('checked', true) : $('#nfe_web').prop('checked', false);
                res.permissions.movement_history_web == 'on' ? $('#movement_history_web').prop('checked', true) : $('#movement_history_web').prop('checked', false);
                res.permissions.products_app == 'on' ? $('#products_app').prop('checked', true) : $('#products_app').prop('checked', false);
                res.permissions.stocks_app == 'on' ? $('#stocks_app').prop('checked', true) : $('#stocks_app').prop('checked', false);
                res.permissions.cash_register_app == 'on' ? $('#cash_register_app').prop('checked', true) : $('#cash_register_app').prop('checked', false);
                res.permissions.freight_app == 'on' ? $('#freight_app').prop('checked', true) : $('#freight_app').prop('checked', false);
                res.permissions.orders_app == 'on' ? $('#orders_app').prop('checked', true) : $('#orders_app').prop('checked', false);  
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
                    title: 'Erro ao carregar o usuário.',
                    text: 'Tente novamente mais tarde.',
                });
            },
        });
    },  
    
    updateDetailsProfile: () => {
        $('#edit_details_profile').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this); 
            formData.append('id', id);  

            $.ajax({
                url: route('user.updateDetailsUser'),
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
                            editPage.getDataUser();                            
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
                        title: 'Erro ao atualizar os detalhes do usuário.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },

    updatePermissionsUser: () => {
        $('#update_permissions_user').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this); 
            formData.append('id', id);  

            $.ajax({
                url: route('user.updatePermissionsUser'),
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
                            editPage.getDataUser();                            
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
                        title: 'Erro ao atualizar as permissões do usuário.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },
    
    updatePasswordUser: () => {
        $('#update_password_user').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this); 
            formData.append('id', id);  

            $.ajax({
                url: route('user.updatePasswordUser'),
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
                            editPage.getDataUser();                            
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
                        title: 'Erro ao atualizar a senha do usuário.',
                        text: 'Tente novamente mais tarde.',
                    });
                },
            });
        })
    },
    
    updatePhotoUser: () => {
        $('#btn_upload_photo').on('click', function (e) {
            e.preventDefault();

            $('<input type="file">').change(function () {
                var file = this.files[0];
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    var formData = new FormData();
                    formData.append('photo', file);
                    formData.append('id', id);  
        
                    $.ajax({
                        url: route('user.updatePhotoUser'),
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
                                    editPage.getDataUser();                            
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
                                title: 'Erro ao atualizar a foto do usuário.',
                                text: 'Tente novamente mais tarde.',
                            });
                        },
                    });
                };
        
                reader.readAsDataURL(file);
            }).click();
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
    editPage.init()
});


