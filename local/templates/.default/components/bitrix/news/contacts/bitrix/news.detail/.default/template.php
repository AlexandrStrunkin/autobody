<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">

    var myMap;

    // Дождёмся загрузки API и готовности DOM.
    ymaps.ready(init);

    function init () {
        // Создание экземпляра карты и его привязка к контейнеру с
        // заданным id ("map").
        myMap = new ymaps.Map('map_canvas', {
            // При инициализации карты обязательно нужно указать
            // её центр и коэффициент масштабирования.
            center: [<?=$arResult["DISPLAY_PROPERTIES"]["CONTACT_MAPS"]["VALUE"]?>], // Москва
            zoom: 10,
            controls: ['smallMapDefaultSet']
        });

        myPlacemark = new ymaps.Placemark([<?=$arResult["DISPLAY_PROPERTIES"]["CONTACT_MAPS"]["VALUE"]?>], {
            // Чтобы балун и хинт открывались на метке, необходимо задать ей определенные свойства.
            balloonContentHeader: "<?=$arResult["NAME"]?>",
            balloonContentBody: "<?=$arResult["DISPLAY_PROPERTIES"]["CONTACT_ADRESS"]["VALUE"]?>",
            // balloonContentFooter: "Подвал",
            hintContent: "<?=$arResult["NAME"]?>"
        });

        myMap.geoObjects.add(myPlacemark);


    }

</script>
<div class="news-detail" style="width: 1000px; height:700px; margin: 0 auto;" id="map_canvas">
    <?//=$arResult["DISPLAY_PROPERTIES"]["CONTACT_MAPS"]["DISPLAY_VALUE"]?>   
</div>
<?//arshow($arResult)?>