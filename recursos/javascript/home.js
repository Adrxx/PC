//Javascirpt Home
var scrolled=false;
var window_height = $(window).height()/3;
var menu=false;

function set_Scrolled (){
    
    if (ventana_scroll > 80 && scrolled==false){
        
        $('.tab').addClass('tab_scrolled');
        $('.union_logo_container').addClass('union_logo_container_scrolled');
        $('.nav_bar').addClass('nav_bar_scrolled');
        $('.pc_logo').addClass('pc_logo_scrolled');
       
        
        scrolled=true;
    }
    
    if (ventana_scroll <= 80 && scrolled==true){
        
        $('.tab').removeClass('tab_scrolled');
        $('.union_logo_container').removeClass('union_logo_container_scrolled');
        $('.nav_bar').removeClass('nav_bar_scrolled');
        $('.pc_logo').removeClass('pc_logo_scrolled');
        
        
        scrolled=false;
    } 
};

function set_Onview(element){
    $('.tab').removeClass('onview');
    $(element).addClass('onview');
}

function get_Position(){
    
    if((quees_position-window_height) > ventana_scroll){
        $('.tab').removeClass("onview")
    }
    if((quees_position-window_height) <= ventana_scroll && ventana_scroll< proyectos_position){
        set_Onview(".t_que_es");  
        console.log('quees')
    };
    
    if((proyectos_position-window_height) <= ventana_scroll && ventana_scroll< portales_position){
        set_Onview(".t_proyectos");  
        console.log('proyectos')
    };
    
     if((portales_position-window_height) <= ventana_scroll && ventana_scroll< registro_position) {
        set_Onview(".t_portales");  
        console.log('portales')
    };

    if((registro_position-window_height) <= ventana_scroll ) {
        set_Onview(".t_registrate");  
        console.log('registro')
    };
}

function scroll_To(trigger,target){
    $(trigger).click(function(){
        $(window).scrollTop(target);
    });
}

function open_Menu(){
    
    $('.nav_tabs_container').slideToggle();
}


$(document).ready(function(){
    
        //posición elementos (inicio)
        start_position= 0;
        quees_position=$('.quees').offset().top;
        proyectos_position= $('.proyectos').offset().top;
        portales_position= $('.portales').offset().top;
        registro_position= $('.registro').offset().top;
    

    
   $(window).scroll(function(){
       
       //posición elementos (scroll) 
        nav_height = $(".nav_bar").height(); 
        ventana_scroll = $(window).scrollTop();
        start_position= 0;
        quees_position=$('.quees').offset().top;
        proyectos_position= $('.proyectos').offset().top;
        portales_position= $('.portales').offset().top;
        registro_position= $('.registro').offset().top;
       
       //funciones
       set_Scrolled();
       get_Position();
   });
    
    
    // Scroll To: 
    
        $('.ham_menu').click(function(){
            open_Menu();
        });
    
        $('.t_que_es, .flechita').click(function(){
            $('html,body').animate({ scrollTop: quees_position}, 700);
        });
    
        $('.t_proyectos').click(function(){
                $('html,body').animate({ scrollTop: proyectos_position}, 700);
            });
    
        $('.t_portales').click(function(){
                $('html,body').animate({ scrollTop: portales_position}, 700);
            });
    
        $('.union_logo').click(function(){
                $('html,body').animate({ scrollTop:0}, 700);
            });
    
        
});