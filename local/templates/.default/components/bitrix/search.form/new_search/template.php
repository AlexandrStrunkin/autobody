<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="search">
<form action="<?=$arResult["FORM_ACTION"]?>" name="searchform">
<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
                "bitrix:search.suggest.input",
                "",
                array(
                    "NAME" => "q",
                    "VALUE" => "",
                    "INPUT_SIZE" => 10,
                    "DROPDOWN_SIZE" => 15,
                ),
                $component, array("HIDE_ICONS" => "Y")
            );?><?else:?><input type="text" name="q" value="" size="15" maxlength="50"  placeholder="Поиск по сайту"/><?endif;?>

        
  <a href="/catalog/search.php?parent_id=0" >Поиск по каталогу</a>

</form>
</div>
