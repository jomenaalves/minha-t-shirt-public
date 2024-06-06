const globalPage = { 
    init: () => {
        globalPage.setListener();
    },

    setListener: () => {
        // Modal -------------------------
        $('.modal_trigger').on('click', function() {
            var modalTitle = $(this).data('modal-title');
            var modalContentSelector = $(this).data('modal-content');
            globalPage.showModal(modalTitle, modalContentSelector);
        });

        $(document).on('click', '.modal_close, .modal', function() {
            var $modal = $(this).closest('.modal');
            $modal.find('.modal_content').removeClass('show');
            setTimeout(function() {
                $modal.removeClass('show');
            }, 400);
        });

        $(document).on('click', '.modal_content', function(e) {
            e.stopPropagation();
        });

        $(document).on('change', '#order_type_person', function() {
            if (this.checked) {
               
                $('.juridic-person').removeClass('d-none');
                $('#document_label ').text(' CNPJ *');
                $('#name_label ').text(' Nome Fantasia *');
            } else {
                
                $('.juridic-person').addClass('d-none');
                $('#document_label ').text(' CPF');
                $('#name_label ').text(' Nome');
            }
        });
        //Fim Modal-------------------------------------------------
    },

    showModal:(modalTitle, modalContentSelector) => {
        let modalContent = $(modalContentSelector).html();
    
        let $modal = $('#modal_template');
        $modal.find('.modal_title').text(modalTitle);
        $modal.find('.modal_body').html(modalContent);
        
        $modal.addClass('show');
        $modal.find('.modal_content').addClass('show');
    },

    closeModal:()=>{
        var $modal = $(this).closest('.modal');
        $modal.find('.modal_content').removeClass('show');
        setTimeout(function() {
            $modal.removeClass('show');
        }, 400);
    },

    formatCurrency: (value) => {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);
    },

    maskPhone:(telefone) => {
        if (!telefone) return '';
        let v = telefone.replace(/\D/g, "");
        if (v.length > 11) {
            v = v.slice(0, 11);
        }

        if (v.length > 10) {
            v = v.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        } else if (v.length > 6) {
            v = v.replace(/^(\d{2})(\d{4})(\d{0,4})$/, "($1) $2-$3");
        } else if (v.length > 2) {
            v = v.replace(/^(\d{2})(\d{0,4})$/, "($1) $2");
        } else {
            v = v.replace(/^(\d{0,2})$/, "($1");
        }

        return v;
    },

    maskCpfCnpj: (value) => {
        if (!value) return '';

        let v = value.replace(/\D/g, "");

        if (v.length <= 11) { // CPF
            v = v.replace(/(\d{3})(\d)/, "$1.$2");
            v = v.replace(/(\d{3})(\d)/, "$1.$2");
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        } else { // CNPJ
            v = v.replace(/^(\d{2})(\d)/, "$1.$2");
            v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
            v = v.replace(/(\d{4})(\d{1,2})$/, "$1-$2");
        }

        return v;
    },

    maskRG:(rg) => {
        if (!rg) return ''; 
        let v = rg.replace(/\D/g, ""); 

        if (v.length > 9) {
            v = v.slice(0, 9);
        }

        v = v.replace(/(\d{2})(\d)/, "$1.$2"); 
        v = v.replace(/(\d{3})(\d)/, "$1.$2"); 
        v = v.replace(/(\d{3})(\d)/, "$1-$2"); 

        return v;
    },

    maskCEP:(cep) => {
        if (!cep) return '';

        let v = cep.replace(/\D/g, ""); 

        if (v.length > 8) {
            v = v.slice(0, 8);
        }

        v = v.replace(/(\d{5})(\d)/, "$1-$2");

        return v; 
    }
};

$(document).ready(() => {
    globalPage.init();
});


// MOVER PARA AQUIVO DE SETUP-.JS (ESTAVA COM CACHE)
toastr.options = {
    "positionClass": "toast-bottom-full-width",
    "closeButton": false,
    "progressBar": true,
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

