function removeCaret(){
    if( $(window).width() > 991 ){
        $("#mainNav .dropdown a.dropdown-toggle").find('i').remove();
    } else  {
        $("#header").find('.dropdown-toggle, .dropdown-submenu > a').append($('<i />').addClass('uk-icon-caret-down'));
    }
}
$(window).resize(function (){ removeCaret(); });
removeCaret();