const globalPage = { 
    init: () => {
        globalPage.setListener();
        globalPage.inputMoney();
    },

    setListener: () => {


    },

    inputMoney: () => {
        $(document).on('input', '.input-money', function() {
       
        });
    },


    

};

$(document).ready(() => {
    globalPage.init();
});
