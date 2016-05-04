<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");?>

<script type="text/javascript">
    $(function(){
        //путь к файлу с компонентом. Указываем параметр
        var path = "/include/news_page.php?ajax=Y";
        //счетчик страниц
        var currentPage = 1;
        
        var count = $(".show-more").data("count");

        $(".show-more").click(function(e){
            //делаем ajax запрос и сразу инкремент номера страницы
            $.get(path, {PAGEN_1: ++currentPage}, function(data){
                //добавим новости к списку
                $(".news-page").append(data);
                //скрываем кнопку загрузить больше новостей если все новости выведены
                if(currentPage * 4 >= count){
                    $(".show-more").hide();
                    
                }

            });

            //отключим скролл к верху документа
            e.preventDefault();

        });
    });
</script>


<div>
    <?
         $newsCounter = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 10, "ACTIVE" => "Y"), Array());
     ?>

    <div class="name-news-title">НОВОСТИ</div>  
    <?$APPLICATION->IncludeFile("/include/news_page.php");?>

    <a class="show-more" data-count="<?=$newsCounter?>" href="#"><div class="button-more-news"> <button type="submit">ЗАГРУЗИТЬ БОЛЬШЕ НОВОСТЕЙ &darr;</button> </div></a>  

</div>  







<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>