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
//arshow($arResult["ITEMS"]);
?>
<?foreach ($arResult["ITEMS"] as $arItem):?>     
<span vocab="http://schema.org/" typeof="Organization">  
   <font color="#002056"><b> 
        <br />
                   
        <br />  
     
 
       <span  property="name"><?=$arItem["PROPERTIES"]["CONTACT_TOWN"]["VALUE"]?> - <?=$arItem["NAME"]?> </span></b> </font>  
            <br />
            
                       
           <b> 
  <br />      
  <div align="left">
  
 Наш адрес:</b> 
 
<br />
 <span property="address" typeof="PostalAddress"><span property="addressLocality"><?=$arItem["PROPERTIES"]["CONTACT_TOWN"]["VALUE"]?></span>, 
 <span property="streetAddress"><?=$arItem["PROPERTIES"]["CONTACT_ADRESS"]["VALUE"]?></span></span> 
<br />
 
 <?foreach ($arItem["PROPERTIES"]["CONTACT_EMAIL"]["VALUE"] as $arEmail):
 $test=explode(".",$arEmail);
 
 if ($test[0]!=="www"){ ?>
  <br />
 <a href="mailto:<?=$arEmail?>" property="email" ><?=$arEmail?></a> 
<br /> 
<?  
 }
 else { ?>
    <a href="http://<?=$arEmail?>" property="email" ><?=$arEmail?></a> 
<br />
 
<? }
 endforeach
 ?>    

<br />
 <b>Звоните нам по телефонам:</b> 
<br />
 <?foreach ($arItem["PROPERTIES"]["CONTACT_PHONE"]["VALUE"] as $arPhone):?>
 <span property="telephone"><?=$arPhone?></span> ,
 <?endforeach?>
<br />
 
<br />
<?=$arItem["PROPERTIES"]["CONTACT_COMMENT"]["~VALUE"]["TEXT"]?>
<br />
 
<br />
 
<p><b><?=$arItem["PROPERTIES"]["CONTACT_SCHEDULE"]["NAME"]?>:</b> 
  <br />
 </p>
 <?=$arItem["PROPERTIES"]["CONTACT_SCHEDULE"]["~VALUE"]["TEXT"]?>

 
<br />
 
<br />
 

  <br />
 </b> 
<br />
</div>
 </span>
 <b><hr/> 
 
 
  <br />
 </b> 
 
 <?endforeach?>