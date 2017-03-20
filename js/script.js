var screen=2;

function filterPopUp(){
    $('.sOptionsList li').click(function(){
        $('.sOptionsList li').removeClass('activeOption');
        sp = $(this).data('search-param');
        $(this).addClass('activeOption');
        $('input[name="p"]').attr('value',sp);
        localStorage.setItem("setSearch", sp);
        $('.currentSOption').html($(this).html());
        $('.sOptionsList').css('display','none');
    })

    $('.currentSOption').click(function(){
        if($('.sOptionsList').css('display')=='block'){
            $('.sOptionsList').css('display','none');
        } else {
            $('.sOptionsList').css('display','block');
        }
    })
}

/*  new search  */

function markshover()
{
    $(".makr").each(function()
        {
            $(this).bind("mouseenter", function() {
                //alert($(this).attr("rel"));
                $(this).attr("src",pictavtmarcs[$(this).attr("rel")+1]);

            });

            $(this).bind("mouseleave", function() {
                $(this).attr("src",pictavtmarcs[$(this).attr("rel")+1]);

            });

    });


    if (window.innerWidth<1270){
        screen=1;
        $(".b1").each(function()
            {
                $(this).css("margin","0 0.2%");
        });

        $(".rightpart_mini").each(function()
            {
                $(this).css("margin-right","9px");
        });

        $(".noend").each(function()
            {
                $(this).css("margin","0 12px 12px 0");
                $(this).css("width","130px");
        });

        $(".end").each(function()
            {
                $(this).css("margin","0 0px 12px 0");
                $(this).css("width","130px");
        });

    }

    $(window).resize(function(){
        if (window.innerWidth>1270)
        {
            if (screen==1) {
                screen=2;
                $(".b1").each(function()
                    {
                        $(this).css("margin","0 2.7%");
                });

                $(".rightpart_mini").each(function()
                    {
                        $(this).css("margin-right","48px");
                });

                $(".noend").each(function()
                    {
                        $(this).css("margin","0 56px 12px 0");
                        $(this).css("width","130px");
                });

                $(".end").each(function()
                    {
                        $(this).css("margin","0 0px 12px 0");
                        $(this).css("width","130px");
                });

            }

        }
        else
        {

            if (screen==2) {
                $(".b1").each(function()
                    {
                        $(this).css("margin","0 0.2%");
                });

                $(".rightpart_mini").each(function()
                    {
                        $(this).css("margin-right","9px");
                });

                $(".noend").each(function()
                    {
                        $(this).css("margin","0 12px 12px 0");
                        $(this).css("width","130px");
                });

                $(".end").each(function()
                    {
                        $(this).css("margin","0 0px 12px 0");
                        $(this).css("width","130px");
                });
                screen=1;


            }
        }
        // alert('Размеры окна браузера изменены.');
    });
}

function hidemainbanners(){
    $("#header").animate({height: "154px"});
    $("#show_banners").show();
    $("#hide_banners").hide();
    //   setCookie("mbanners","hide");
    setCookie("mbanners","hide",'','/', 'autobody.ru','');
    //  $.cookie("mbanners","hide" , { expires: 1 });
}

function showmainbanners(){
    $("#header").animate({height: "326px"});
    $("#show_banners").hide();
    $("#hide_banners").show();
    //  $.cookie("mbanners","show" , { expires: 1 });
    setCookie("mbanners","show", '','/', 'autobody.ru','');

}


function setCookie(name, value, expires, path, domain, secure){
    document.cookie =
    name +"=" + escape(value) +
    ((expires) ? "; expires="  + expires.toGMTString() : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "")
}




function submitForm(id){
    $("#"+id).submit();
    return false;
}

//выводим сообщение об очистке корзины перед сменой склада
function before_wh_change(param, cur_wh){

    if(confirm("Внимание! При смене склада все товары из корзины будут удалены! Продолжить?")){
        set_url(param);
    }
    else {
        //возвращаем выбранные ранее склад
        $("#warehouse option").each(function(){
            // alert(this.value);
            if (this.value == cur_wh) {
                // alert(this.value);
                $(this).attr("selected", "selected");
                //  $(this).click();
            }
            else { }
        })

        return false;
    }
}

//проверка количества товаров при добавлении в корзину во всплывающем окне
$(function(){
    // $("#qw").css("disabled","disabled")

    $("#qw").keyup(function(){
        $("#qw").attr("value", $("#qw").attr("value").replace(/\D+/,'') );
        if ( Number($('#qw').val()) < 1) {
            $('#qw').val(1) ;
        }
        if (Number($('#qw').val()) < Number($('#catqwm').html())) {}
        else {$('#qw').val(Number($('#catqwm').html()))}

        $("#qw").attr("value", parseInt($("#qw").attr("value")));
    })
})

function deleteFavoriteFromPublic(obj){
    $(obj).data('delete-el', '');
    $(obj).css('background-position', '0 0'); 

}

function deleteFavoriteFromPopUp(obj){
    var parentTR = $(obj).parent().parent();
    parentTR.css('opacity',0);
    setTimeout(function(){
        parentTR.remove();
    },400);
}



///новый каталог
$(function(){
    ////////////////переключение чекбоксов в каталоге
    $(".cbox").click(function(){
        if ($(this).hasClass("cbox_c")) {$(this).removeClass("cbox_c")}
        else {{$(this).addClass("cbox_c")}}
    })
    
    /*---Subscribe on items not in stock---*/
    $(".item_sub_button").click(function(){
        if($(this).siblings(".item_sub_form_container").hasClass("active_sub_form")){
            $(".item_sub_form_container").removeClass("active_sub_form");
        } else {
            $(".item_sub_form_container").removeClass("active_sub_form");
            $(this).siblings(".item_sub_form_container").toggleClass("active_sub_form");
        }
    })
    
    /*if($(".submit_subscribe_form")){
        $(".submit_subscribe_form").click(function(e){
            e.preventDefault();
            var clickedButton = $(this);
            $.post("/ajax/subscribe/manage_subscribe.php", 
            {
                item_id : $(this).siblings("input[name='item_id']").val(),
                user_id : $(this).siblings("input[name='user_id']").val(),
                quantity : $(this).parent().find("input[name='quantity']").val(),
                warehouse : $(this).siblings("input[name='warehouse']").val(),
            }
            , function(data){
                if(data){
                    if(clickedButton.parent().hasClass("item_sub_form_container")){ // --- from detail page
                        clickedButton.parent().addClass("already_cubscribed");
                        clickedButton.parent().attr("style","left: -315px !important");
                        clickedButton.parent().html("Спасибо. Мы уведомим вас о поступлении.");
                    } else { // --- from list
                        
                    }
                }
               });
        })
    }*/
    
    $(document).on("click",".submit_subscribe_form",function(e){
        e.preventDefault();
            var clickedButton = $(this);
            $.post("/ajax/subscribe/manage_subscribe.php", 
            {
                item_id : $(this).siblings("input[name='item_id']").val(),
                user_id : $(this).siblings("input[name='user_id']").val(),
                quantity : $(this).parent().find("input[name='quantity']").val(),
                warehouse : $(this).siblings("input[name='warehouse']").val(),
            }
            , function(data){
                if(data){
                    if(clickedButton.parent().hasClass("item_sub_form_container")){ // --- from detail page
                        clickedButton.parent().addClass("already_cubscribed");
                        clickedButton.parent().attr("style","left: -315px !important");
                        clickedButton.parent().html("Спасибо. Мы уведомим вас о поступлении.");
                    } else { // --- from list
                        var whID = clickedButton.siblings("input[name='warehouse']").val();
                        clickedButton.closest(".popup_subscribe").siblings(".wh_popup_table").find("div[data-wh-id='"+whID+"']").data("already-subscribed",1);
                        clickedButton.closest(".subscribe_data").css("display","none");
                        clickedButton.closest(".subscribe_data").siblings(".already_subscribed").css("display","block");
                        clickedButton.closest(".subscribe_data").siblings(".already_subscribed").text("Спасибо. Мы уведомим вас о поступлении.");
                    }
                }
               });
    })
    
    $(document).on("click",".warehouses_popup .sub_mail_list",function(e){
        var closestPopup = $(this).closest(".wh_popup_table").siblings(".popup_subscribe");
        if (!$(this).data("already-subscribed")) {

            closestPopup.find(".subscribe_data").css("display", "block");
            closestPopup.find(".already_subscribed").css("display", "none");

            closestPopup.find("b").text($(this).data("wh-name"));
            closestPopup.find("input[name='warehouse']").val($(this).data("wh-id"));
        } else {
            closestPopup.find(".subscribe_data").css("display", "none");
            closestPopup.find(".already_subscribed").css("display", "block");
        }
        $(".popup_subscribe").css("left", "0px");
    })
    
    $(document).on("click",".close_subscription_popup",function(){
        $(".popup_subscribe").css("left", "333px");
    })

    
    /*----Favorite functions block----*/
    $("#favorite_slide_headers li").click(function(){
        $(".favorite_headers_bg").toggleClass("slided_header");
        $(".favoritePopupSlide").toggleClass("slideFavorite");
    })
        
    $(document).on("click",".group_block_inner",function(){
        if($(this).hasClass('active_favorite_group')){
            $(".group_block_inner").removeClass("active_favorite_group");
            $(".favorite_scroll_block").addClass("closed_scroll_block");
        } else {
            $(".group_block_inner").removeClass("active_favorite_group");
            $(".favorite_scroll_block").addClass("closed_scroll_block");
            $(this).addClass("active_favorite_group");
            $(this).parent().next().removeClass("closed_scroll_block");
        }
    })
    
    $(document).on("click",".close_favorite",function(){
        document.querySelector("#favorite_overlay").classList.toggle("favorite_overlay_active");
    })

    $('.open_favorite_popup').click(function(e) {
        e.preventDefault();
        document.querySelector("#favorite_overlay").classList.toggle("favorite_overlay_active");
    })

    $('.favorite_scroll_block').perfectScrollbar();
    
    $(document).on("click",'.clear_all_favorite',function(){
        $.post("/ajax/manage_fav.php", {
            delete_all: 'Y'
        }, function(data) {
            console.log(data);
            $('.favorite_items_table').empty();
            $('.favorite_items_table').append("<tr><td><h2>У вас еще нет элементов в избранном. Перейдите в каталог, чтобы добавить товары или группы.</h2></td></tr>");
        });
    })
    
    $(document).on("click",'.manage_favotite',function(){
        var isDelete = $(this).data('delete-el');
        var postId;
        if(isDelete){
            switch($(this).data('action-from')){
                case 'public':
                    deleteFavoriteFromPublic(this);
                    break;
                case 'popup':
                    deleteFavoriteFromPopUp(this);
                    break;
            }
            
            if($(this).prev().hasClass('sub_adding')){
                $(this).prev().text("Добавить в избранное");
            } else {
                $(this).attr("title","Добавить в избранное");
            }
            
            postId = $(this).data('related-element');
        } else {
            $(this).data('delete-el','Y');
            $(this).css('background-position','100% 0');
            if($(this).prev().hasClass('sub_adding')){
                $(this).prev().text("Удалить из избранного");
            } else {
                $(this).attr("title","Удалить из избранного");
            }
            postId = $(this).attr('id');
        }
        
        $.post("/ajax/manage_fav.php", {
            id: postId,
            type: $(this).data('elem-type'),
            delete_item: isDelete
        }, function(data) {
            if(parseInt(data)){
                $(this).data('related-element',parseInt(data));    
            }
            $('#favorite_block_wrapper').load('/ #favorite_block_wrapper > *',function(){
                $('.favorite_scroll_block').perfectScrollbar();  
            });
            
        }.bind(this));
        
    })
    
    $(document).on({
        mouseenter: function () {
           if($(this).find(".section_list_star").length == 1){
               $(this).find(".section_list_star").show();
           }
        },
        mouseleave: function () {
           if($(this).find(".section_list_star").length == 1){
               $(this).find(".section_list_star").hide();
           }
        }
    }, ".submenu_items li");
    
    /*---Favorite functions block----*/
})



//////////////получаем дату доставки
function check_delivery_date(id,art){

    $.post("/ajax/date_check.php", { art: art},
        function(data){
            $("#deliv_date_" + id).html(data);
    });
}

//добавление в корзину
function add2basket(){
    //берем данные из всплывающего окна     
    var id = $("#idm").val();
    var quantity = $("#qw").val();
    var price = $("#catpricem").html();
    if (!price) {
        price = $("#item_price_" + id).val();
    }
    //////////////////////
    //console.log(id + " " + quantity + " " + price);

    $.post("/ajax/add2basket.php", { id: id, quantity: quantity, price:price},
        function(data){                
            if (data == 'MoreThanAllowed') {     
                window.MoreThanAllowed = 'Y';   
                $(".jqmClose").click(); 
                $(".jqmOverlay_basket").show();
                $(".jqmbasket_error").show();
            } else {
                window.MoreThanAllowed = 'N'; 
                if (data) {            
                    //перезагружаем малую корзину
                    $.post("/ajax/small_basket.php", {},
                        function(data){
                            $("#header_right").html(data);
                    });
                    //выводим надпись что товар в корзине и закрываем всплывающее окно
                    var path = "/personal/basket.php";
                    $("#last_cell_"+id).html("<span class='forward_catalog_new_in_b'><a href='/personal/basket.php' title='корзина'>В корзине</a></span>");
                    $(".jqmClose").click(); 
                    status_change();
                }
                // $("#dialog").html(data);
            }
    });
} 
  
//проверяем ниличие товара в массиве сравнения
function check_compare(id){
    $.post("/ajax/compare.php", { compare_id: id},
        function(data){
            if (parseInt(data) > 0) {
                $(".catalog_compare_hidden_block").fadeIn(300);
            }
            else {
                $(".catalog_compare_hidden_block").fadeOut(300);
            }
            $(".catalog_compare_hidden_block_text span").html(data);

    });
}




//получаем список разделов для поиска (старая версия, для селектов)
/*
function get_subsections(id){
if (parseInt(id) > 0) {
$("#select_2_block").html("загрузка...");
$.post("/ajax/get_sections.php", { section_id: id},
function(data){
//alert(data);
$("#select_2_block").html(data);
$("#section_id2").css("display","block");
$("#section_id2").uniform();
});
}
else {
$("#select_2_block").html("");
$("#select2").css("display","none");
}
}
*/

//получаем список разделов для поиска (новая версия, для дивов)
function get_subsection(item){
    var id = $(item).attr("id").slice(2);
    if (parseInt(id) > 0) {
        $("#select_2_block > div.search_select_type").html("<div>загрузка...</div><div></div>");
        $.post("/ajax/get_sections2.php", { section_id: id},
            function(data){
                //alert(data);
                $("#select2").html(data);
        });
    }
    else {
        $("#select2").html("<div class='search_select_unactive'>-</div><div></div>");
    }
}




//выпадающие списке в форме поиска
$(function(){
    $(".search_select_type > div:first-child").click(function(){
        if ($(this).siblings("div").css("display") == "none") {
            $(this).siblings("div").css("display","block");
        } else {
            $(this).siblings("div").css("display","none");
        }
    })
})

$(document).ajaxSuccess(function() {
    $(".search_select_type > div:first-child").click(function(){
        $(this).siblings("div").css("display","block");
    })
})


function set_search_type(id) {
    var new_val = ($(id).attr("id")).slice(2);
    var new_text =  $(id).html();
    $(id).siblings("input").val(new_val);
    $(id).parent().siblings("div").html(new_text);
    $(id).parent().toggle();
}


//----------------------------------Модальные окна
$(document).ready(function() {

    $(".fancybox").fancybox({
        //--------Общие настройки Fancybox
        type : 'image',
        scrolling : 'no',
        maxWidth : '1000px',
        width : '1000px',
        height : 'auto',
        autoSize : false,
        closeClick : false,
        openEffect : 'none',
        closeEffect : 'none',

        //------------Настройки отдельно для объекта Frame
        iframe : {
            scrolling : 'no'
        },

    });

});

//----------------------------------Модальные окна
$(document).ready(function() {

    $(".fancybox_map").fancybox({
        //--------настройки Fancybox для контактов
        type : 'iframe',
        scrolling : 'no',
        maxWidth : '1000px',
        width : '1000px',
        height : '700px',
        autoSize : false,
        closeClick : false,
        openEffect : 'none',
        closeEffect : 'none',

        //------------Настройки отдельно для объекта Frame
        iframe : {
            scrolling : 'no'
        },

    });

});

//подгрузка информации о наличии товара на складах
function show_wh_popup(id) {
    /*if($(".whp_" + id + "  table")[0]) {console.log("fail")} else
    { */ 
        $(".whp_" + id).html("<span style='color:red'>загрузка...</span>");
        $.post("/ajax/show_wh.php", { id: id},
            function(data){
                $(".whp_" + id).html(data);

                //проверям величину прокрутки окна, чтобы задать нужную позицию для всплывающего окна
                var position = $("#item_info_" + id).offset().top;    //позиция текущего элемента
                var scroll_top = $(window).scrollTop();
                //  alert(scroll_top)
                //сумма прокрутки окна, положения элемента и высоты всплывающего окна
                var summ = parseInt((position)*1 - parseInt(scroll_top)*1 + parseInt($("#item_info_" + id).find(".warehouses_popup").outerHeight())*1 + 100*1);
                var screen_height = window.outerHeight; //высота окна браузера
                // --- Fix for favorite popup window 
                if($("#item_info_" + id).parent().parent().parent().hasClass("favorite_items_table") && $("#item_info_" + id).parent().parent().children().length>2){
                    if($("#item_info_" + id).parent().index()==parseInt($("#item_info_" + id).parent().parent().children().length-1)){
                        $("#item_info_" + id).find(".warehouses_popup").css("top","-170px");
                        $("#item_info_" + id).find(".forward_catalog_new_arr_tail3").css("top","160px");  
                    } else if($("#item_info_" + id).parent().index()==parseInt($("#item_info_" + id).parent().parent().children().length-2)){
                        $("#item_info_" + id).find(".warehouses_popup").css("top","-90px");
                        $("#item_info_" + id).find(".forward_catalog_new_arr_tail3").css("top","85px");  
                    }
                } else {
                    if (summ > screen_height) {
                        $("#item_info_" + id).find(".warehouses_popup").css("top","-203px");
                        $("#item_info_" + id).find(".forward_catalog_new_arr_tail3").css("top","198px")  
                    }
                    else {
                        $("#item_info_" + id).find(".warehouses_popup").css("top","-25px");
                        $("#item_info_" + id).find(".forward_catalog_new_arr_tail3").css("top","22px")   
                    }
                }
        });
    //}
}

$(function(){
    //запускаем функцию подгрузки информации по складам
    $("body").on('click','.catalog_item_info_cell',function(e){
        if(e.target.nodeName=="TD"){
            if ($(this).find(".warehouses_popup").css("display")=="block") {
               $(this).find(".warehouses_popup").hide(); 
            }
            else { 
                var item_id = $(this).attr("id").slice(10); //получаем id нужного товара
                var item_attr_id = $(this).attr("id");      //получаем id ячейки таблицы
                show_wh_popup(item_id);                     //загружаем инфо по складам
                $("td:not(#" + item_attr_id + ")").find(".warehouses_popup").css("display","none"); //скрываем всплывающие окна в других ячейках
                $(this).find(".warehouses_popup").toggle();  //показываем/скрываем всплывающее окно в текущей ячейке
                      
                //проверям величину прокрутки окна, чтобы задать нужную позицию для всплывающего окна
                var position = $(this).offset().top;    //позиция текущего элемента
                var scroll_top = $(window).scrollTop();
                //сумма прокрутки окна, положения элемента и высоты всплывающего окна
                var summ = parseInt((position)*1 - parseInt(scroll_top)*1 + parseInt($(this).find(".warehouses_popup").outerHeight())*1 + 100*1);
                var screen_height = window.outerHeight; //высота окна браузера
                // --- Fix for favorite popup window
                if($(this).parent().parent().parent().hasClass("favorite_items_table") && $(this).parent().parent().children().length>2){
                    if($(this).parent().index()==parseInt($(this).parent().parent().children().length-1)){
                        $(this).find(".warehouses_popup").css("top","-170px");
                        $(this).find(".forward_catalog_new_arr_tail3").css("top","160px");  
                    } else if($(this).parent().index()==parseInt($(this).parent().parent().children().length-2)){
                        $(this).find(".warehouses_popup").css("top","-90px");
                        $(this).find(".forward_catalog_new_arr_tail3").css("top","85px");  
                    }
                } else { 
                    if (summ > screen_height) {
                        $(this).find(".warehouses_popup").css("top","-203px");
                        $(this).find(".forward_catalog_new_arr_tail3").css("top","198px")  
                    }
                    else {                     
                        $(this).find(".warehouses_popup").css("top","-25px");
                        $(this).find(".forward_catalog_new_arr_tail3").css("top","22px")   
                    }
                }
            } 
        } 
    })


    //проверяем клик вне всплывающего окна, чтобы скрыть их все

    $("body").click(function(e){
        //скрываем всплывающее окно с количеством товаров на складе
        if ( !$(e.target).hasClass("catalog_item_info_cell") ) {
            //$(".warehouses_popup").css("display","none");  
        } 

        //скрываем список складов
        if (!$(e.target).hasClass("wh_list") && !$(e.target).parents().hasClass("wh_list") && !$(e.target).hasClass("top-header") && !$(e.target).parents().hasClass("top-header")) {
            $(".wh_list").css("display","none"); 
        }

        //скрываем окно авторизации
        //скрываем список складов
        if (!$(e.target).hasClass("top_auth_form") && !$(e.target).parents().hasClass("top_auth_form")  && !$(e.target).parents().hasClass("lk-header") && !$(e.target).hasClass('authFromBasket')) {
            $(".top_auth_form").css("display","none"); 
        }
    }) 

    /* 
    $(".catalog_item_info_cell").mouseout(function(){
    $(this).find(".warehouses_popup").css("display","none");
    })
    */
})

//кнопка "наверх"
function showButtonUp(){


    if ($(document).scrollTop() > 200) {
        $("#button_up").css("opacity","0.5");
    }
    else {
        $("#button_up").css("opacity","0");
    }
}


$(function(){  

    $("#button_up").click(function(){
        $("body,html").animate({scrollTop: 0}, 500)
    })

    showButtonUp();  

    $(document).scroll(function(){
        showButtonUp();   
    })
})

