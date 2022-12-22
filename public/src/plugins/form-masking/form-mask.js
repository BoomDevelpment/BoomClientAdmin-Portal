  'use strict';
$(function() {
    
    /*date*/
    $(".date").inputmask({ mask: "99/99/9999"});
    $(".date2").inputmask({ mask: "99-99-9999"});
    $(".dateVE").inputmask({ mask: "9999-99-99"});
    $(".co_lat").inputmask({ mask: "99.999999"});
    $(".co_lon").inputmask({ mask: "-99.999999"});
    /*time*/
    $(".hour").inputmask({ mask: "99:99:99"});
    $(".dateHour").inputmask({ mask: "99/99/9999 99:99:99"});

    /*phone no*/
    $(".mob_no").inputmask({ mask: "9999-999-999"});
    $(".phone").inputmask({ mask: "9999-9999"});
    $(".telphone_with_code").inputmask({ mask: "(99) 9999-9999"});
    $(".telphone_with_code_ve").inputmask({ mask: "(99) 999-9999999"});
    $(".us_telephone").inputmask({ mask: "(999) 999-9999"});
    $(".ip").inputmask({ mask: "999.999.999.999"});
    $(".isbn1").inputmask({ mask: "999-99-999-9999-9"});
    $(".isbn2").inputmask({ mask: "999 99 999 9999 9"});
    $(".isbn3").inputmask({ mask: "999/99/999/9999/9"});
    $(".ipv4").inputmask({ mask: "999.999.999.9999"});
    $(".ipv6").inputmask({ mask: "9999:9999:9999:9:999:9999:9999:9999"});

    /*creditcard - account bank*/
    $('.tdcve').inputmask({ mask: "9999999999999999"});
    $('.tdccvv').inputmask({ mask: "999"});
    $('.abve').inputmask({ mask: "9999-9999-99-9999999999"});

    /*numbers*/
    $('.autonumber').autoNumeric('init');
  });