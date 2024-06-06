const AuthPage = { 
    init: () => {
        AuthPage.setListener();
    },

    setListener: () => {
        $('#login').on('click', () => {
            $.ajax({
                url: route('app.authenticate'),
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
                        toastr.error('Usuário ou senha inválidos!', 'Erro');
                        return;
                    }

                    toastr.error('Erro ao realizar o login!', 'Erro');
                }
            });
        });
    }
}

$(document).ready(() => {
    AuthPage.init()
});


