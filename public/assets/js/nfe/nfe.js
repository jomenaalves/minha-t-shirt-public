const nfePage = { 
    init: () => {
        nfePage.setListener();
        nfePage.setDatatableNfes();
    },

    setListener: () => {
        
    },

    setDatatableNfes: () => { 

        $.ajax({
            url: route('nfe.loadNfesFromDatatable'),
            type: 'GET',
            success: (res) => {

                if (window.dt) {
                    window.dt.destroy();
                }
                
                const tableData = res.map(item => ({
                    id: item.id,
                    html: [
                        item.number,
                        item.type,
                        item.client,
                        item.key,
                        item.status == 'autorizado' ? '<label class="badge bg-light-success align-middle">Autorizado</label>' : '<label class="badge bg-light-danger align-middle">Número Reservado</label>',
                        item.date,
                        `<i id="edit-nfe-btn-${item.id}" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-success align-middle edit-nfe-btn"></i>`
                    ]
                }))
                .sort((a, b) => b.id - a.id)
                .map(item => item.html);

                window.dt = new simpleDatatables.DataTable('#table_nfe', {
                    data: {
                        headings: ['Número', 'Tipo','Cliente', 'Chaves', 'Status', 'Data', ''],
                        data: tableData
                    },
                    columns: [
                        { select: 0 }, 
                        { select: 1 }, 
                        { select: 2 },
                        { select: 3 },
                        { select: 4 },
                        { select: 5 },
                        { select: 6, sortable: false } 
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
                        const userId = row.querySelector('.edit-nfe-btn').id.split('-')[3];
                        nfePage.viewNfe(userId);
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
                    title: 'Erro ao listar NF-es.',
                    text: 'Tente novamente mais tarde.',
                });
            }
        });  
    }, 
    
    viewNfe: (id) => {

        $.ajax({
            url: route('nfe.viewNfe'),
            type: "GET",
            data: {
                'id': id,
            },
            success: function (res) {
                let [nfe] = res  
                $('#invoice_number').text(nfe.invoiceNumber);         
                $('#view_key').text(nfe.key);         
                $('#view_number_serie').text(nfe.numberSerie);         
                $('#view_type').text(nfe.type);         
                $('#view_client').text(nfe.client);         
                $('#view_value').text(nfe.value);         
                $('#view_date').text(nfe.date);         
                $('#view_status').text(nfe.status);  
                $('.view-nfe-modal-md').modal('show')
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
    nfePage.init()
});


