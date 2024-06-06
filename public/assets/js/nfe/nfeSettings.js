const nfeSettingsPage = { 
    init: () => {
        nfeSettingsPage.setListener();
        nfeSettingsPage.viewNfeSettings();
    },

    setListener: () => {

        let serverUrl = window.location.protocol + '//' + window.location.hostname;
        if (window.location.port) {
            serverUrl += ':' + window.location.port;
        }

        
    },
    
    viewNfeSettings: (id) => {

        $.ajax({
            url: route('nfe.nfeSettingsGetData'),
            type: "GET",
            data: {
                'id': id,
            },
            success: function (res) {
                let [nfe] = res  
                $('#fantasy_name').val(nfe.fantasyName);         
                $('#corporate_reason').val(nfe.corporateReason);         
                $('#cnpj').val(nfe.cnpj);         
                $('#state_registration').val(nfe.stateRegistration);         
                $('#cep').val(nfe.cep);         
                $('#address').val(nfe.address);         
                $('#address_number').val(nfe.addressNumber);         
                $('#neighborhood').val(nfe.neighborhood);         
                $('#complement').val(nfe.complement);         
                $('#city').val(nfe.city);         
                $('#state').val(nfe.state);         
                $('#percentage_price').val(nfe.percentagePrice+'%');         
                $('#certificate_issued').text(nfe.certificateIssued);  
                $('#certificate_expires').text(nfe.certificateExpires);  
                $('#logotype').html(nfe.logo == null ? `<img src="${serverUrl}/assets/images/user/user_default.jpg" alt="user-image" class="img-fluid rounded-circle wid-100"></img>`: `<img src="${nfe.logo}" alt="user-image" class="img-fluid rounded-circle wid-100"></img>`);
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
                    title: 'Erro ao carregar a NF-e.',
                    text: 'Tente novamente mais tarde.',
                });
            },
        });
    },     
}

$(document).ready(() => {
    nfeSettingsPage.init()
});


