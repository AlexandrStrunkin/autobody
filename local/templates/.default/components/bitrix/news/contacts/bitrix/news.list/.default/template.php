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
<?/*
    <link href="/css/shadowbox/shadowbox.css" type="text/css"  rel="stylesheet" />
    <script type="/js/shadowbox.js"></script>
    <script>
    Shadowbox.init({
    handleOversize: "drag",
    modal: true
    });
    </script>
*/?>
<div class="contacts-page" > 
    <h1 class="name">КОНТАКТЫ</h1>
    <table class="contacts_includes">
        <tr>
            <td>
                <div class="contact-case">
                    <div class="phone"><?$APPLICATION->IncludeFile(SITE_DIR."/include/contacts/phone1.php", Array(),Array("MODE"=>"html"));?></div>
                    <div class="deliter"></div>
                    <div class="note">Единый <font class="red-text">бесплатный</font> телефон для всех офисов</div>
                </div>
            </td> 
            <td>
                <div class="contact-case">
                    <div class="phone"><?$APPLICATION->IncludeFile(SITE_DIR."/include/contacts/phone2.php", Array(),Array("MODE"=>"html"));?></div>
                    <div class="deliter"></div>
                    <div class="note">Единый <font class="red-text">московский</font> телефон для всех офисов</div>
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
        	    <a class="contacts_feedback" href="/feedback/"> 
        	        Обратная связь
        	    </a>
        	</td>
        </tr>

        <!--Убрал информацию о компании
        <tr>
            <td colspan="2">   
            <div class="tech-title">Информация о компании</div>              
                <?$APPLICATION->IncludeFile(SITE_DIR."/include/contacts/company_info.php", Array(),Array("MODE"=>"html"));?>
            </td>

        </tr>
        -->
        
        <tr>
            <td colspan="2">
                <?$APPLICATION->IncludeFile(SITE_DIR."/include/contacts/facebook.php", Array(),Array("MODE"=>"html"));?>       
            </td>
        </tr>      

        <tr>
            <td colspan="2">
                <table class="contacts-city"> 
                    <tr id="slider_bottom">
                        <?$res=CIBlockElement::GetList(
                                Array("propertysort_CONTACT_TOWN"=>"ASC"),
                                Array("IBLOCK_CODE"=>"AUTOBODY_CONTACT","ACTIVE"=>"Y"),
                                false,
                                false,
                                Array("NAME","PROPERTY_CONTACT_TOWN","ID")
                            );
                            $i=1;
                            $prop_id[]=array();
                            while($ob=$res->Fetch()){
                                //arshow($ob);
                                /* if($i==1){
                                $active='class="active-city"';
                                }
                                else{
                                $active=""; 
                                }*/

                                if($ob["PROPERTY_CONTACT_TOWN_ENUM_ID"]!==$etalon || $i==1){?>

                                <td <?=$active?> width="20%" rel="<?=$ob["PROPERTY_CONTACT_TOWN_ENUM_ID"]?>"><span class="url"><?=$ob["PROPERTY_CONTACT_TOWN_VALUE"]?></span]></td>

                                <?
                                    $etalon=$ob["PROPERTY_CONTACT_TOWN_ENUM_ID"];
                                    $prop_id[$ob["ID"]]=$ob["PROPERTY_CONTACT_TOWN_VALUE"];
                                }
                                else {
                                    continue;
                                }

                                $i++;}

                            $prop_id=array_filter($prop_id);

                            //arshow($prop_id);?>
                        <td><span class="url">все города</span></td>
                    </tr> 
                </table>
            </td>
        </tr>
    </table>  

    <div class="news-list" id="contact_slider">
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
            <?endif;?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="city_<?=$arItem["PROPERTIES"]["CONTACT_TOWN"]["VALUE_ENUM_ID"]?> cities">
                <p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >

                    <?/* <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"> */?>
                    <div class="tech-title"><?=$arItem["NAME"]?></div>
                    <?/*</a>*/?>    

                    <table class="contact-info">
                        <?/*foreach($arItem["FIELDS"] as $code=>$value):?>                        
                            <tr>
                            <td>
                            <?=GetMessage("IBLOCK_FIELD_".$code)?>
                            </td>
                            <td>
                            <?=$value;?>
                            </td>
                            </tr>
                        <?endforeach;*/?>
                        <?//arshow($arItem["DISPLAY_PROPERTIES"])?>
                        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>       

                            <tr>
                                <td>
                                    <?=$arProperty["NAME"]?>
                                </td>
                                <td>
                                    <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                        <?=implode("&nbsp;;&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                                        <?else:?>
                                        <?=$arProperty["DISPLAY_VALUE"];?>
                                        <?endif?>                                     
                                    <?if ($arProperty["CODE"] == "CONTACT_MAPS"){
                                            $pos = explode(",",$arProperty["VALUE"]);
                                            //arshow($arProperty);
                                        ?>
                                        <br />
                                        <p>Координаты: <?=$arItem["PROPERTIES"]["CONTACT_MAPS"]["VALUE"]?></p> <br>
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>?show_map=yes"  rel="nofollow" class="fancybox_map">Увеличить</a>
                                        <?}?>
                                </td>

                            </tr>
                            <?endforeach;?>
                    </table>
                </p>
            </div>
            <?endforeach;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
            <?endif;?>
    </div>

    <script type="text/javascript">
        $(function() {
            //$("#contact_slider > div").hide();
            $("#slider_bottom td:last-child").addClass("active-city");
            $("#contact_slider .cities").fadeIn(); 
            //$("#contact_slider div:first-child").fadeIn();

            contacts_click();

        });

        function contacts_click(){
            $("#slider_bottom td").click(function() { 
                if (!$(this).hasClass("active-city")){
                    var index=$(this).index(); 
                    var last_index=$("#slider_bottom td").last().index(); 
                    var city=$(this).attr("rel"); 
                    if (index!==last_index){ 
                        $("#slider_bottom td").removeClass("active-city");
                        $(this).addClass("active-city");
                        $("#contact_slider .cities").hide()
                        $("#contact_slider .city_" + city).fadeIn("slow");
                    }
                    else{  
                        $("#contact_slider .cities").fadeIn('slow');
                        $("#slider_bottom td").removeClass("active-city");
                        $(this).addClass("active-city");

                    }
                };
            })
        }


    </script>

</div>
