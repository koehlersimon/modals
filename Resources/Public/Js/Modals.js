document.addEventListener('DOMContentLoaded',function(){

    let tx_modals_selector = '.tx-modals-link';
    let tx_modals_links = document.querySelectorAll(tx_modals_selector);

    const tx_modals_open = function(data){
        var modalObj = document.querySelector(data.target);
        modalObj.classList.add('tx-modals-modal-show');
        if(data.type === 'target'){
            var targetContent = document.getElementById(data.src).innerHTML;
            modalObj.querySelector('.modal-body').innerHTML = targetContent;
        }
        let tx_modals_listener = document.addEventListener('click',function(e){
            if(e.target.classList.contains('tx-modals-modal-show') || e.target.classList.contains('tx-modals-close')){
                document.querySelector('.tx-modals-modal-show').classList.remove('tx-modals-modal-show')
            }
        });
    }

    tx_modals_links.forEach((link, i) => {
        let data = {
            type: link.getAttribute('data-type'),
            target: link.getAttribute('data-target')
        };
        if(document.querySelector(data.target)){
            link.addEventListener('click',function(e){
                tx_modals_open(data);
                e.preventDefault();
            });
        }
        else{
            console.log("Modal doesn't exist, sorry!");
        }
    });

});
