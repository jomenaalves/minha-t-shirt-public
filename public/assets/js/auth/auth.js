const AuthPage = { 
    init: () => {
        AuthPage.setListener();
    },

    setListener: () => {
        $('#login').on('click', () => {
            $.ajax({
                url: route('auth.login'),
                type: 'POST',
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: (res) => {
                    window.location.href = '/';
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
                        title: 'Erro ao realizar login.',
                        text: 'Tente novamente mais tarde.',
                    });
                }
            });
        });
    }
}

$(document).ready(() => {
    AuthPage.init()
});


