<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
/* Скрипт вывода всплывающего окна на странице каталога */
    $(document).ready(function(){
        if ($.cookie('info_popup') != 'Y') {
            $(".forward_catalog_new_info_popup").show(500);
            $("body").on("click", ".forward_catalog_new_popup_close_button",  function(){
                $(".forward_catalog_new_info_popup").hide(500);
                $.cookie('info_popup', 'Y', { expires: 365 });
            });
        }
    });
</script>