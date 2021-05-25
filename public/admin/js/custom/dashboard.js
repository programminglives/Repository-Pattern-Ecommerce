jQuery(document).ready(function($) {
    const charts = jQuery('.chartisan-chart');
    function display(id){
        jQuery(id).css('display','block');
    }
    function hide(){
        charts.css('display','none');
    }
    jQuery('#product-chart').css('display','block');
    jQuery('.chartisan-toggler').click(function(e){
        switch(this.innerText){
            case 'Products':
                hide();
                display('#product-chart');
                break;
            case 'User':
                hide();
                display('#user-chart');
                break;

        }
    });
});
