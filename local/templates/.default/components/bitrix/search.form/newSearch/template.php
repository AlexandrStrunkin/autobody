<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?
$availableOptions = Array(
    'art' => 'артикулу',
    'name' => 'наименованию',
    'num' => 'номеру производителя',
    'oem' => 'OEM',
);

if($_GET['p']){
  if(array_key_exists($_GET['p'],$availableOptions)){
      $default = $availableOptions[$_GET['p']];
  }  
}
?>

<form action="<?=$arResult["FORM_ACTION"]?>">
    <!--<input type="hidden" name="p" value="<?if($default){echo htmlspecialcharsbx($_GET['p']);}else{?>art<?}?>">-->
    <input type="hidden" name="p" value="name">
<ul class="searchFilter">
    <li>
        <input type="text" name="q" class="search-input" value="<?if($_GET['q']){echo htmlspecialcharsbx($_GET['q']);}?>"  onclick="placeholder='';" onblur="placeholder='Воспользуйтесь удобным поиском по: артикулу, наименованию, по номеру производителя, по оригинальному номеру';" placeholder="Воспользуйтесь удобным поиском по: артикулу, наименованию, по номеру производителя, по оригинальному номеру">
    </li>
    <!--<li>
        <div class="currentSOption"><?if($default){echo $default;}else{?>артикулу<?}?></div>
        <div class="sOptionsList">
            <ul>
              <li data-search-param="art">артикулу</li>
              <li data-search-param="name">наименованию</li>
              <li data-search-param="num">номеру производителя</li>
              <li data-search-param="oem">OEM</li>
           </ul>
        </div>
    </li>    -->
<!--    <li><input type="submit" value="искать"></li>  -->
</ul>

</form>

<script>
    $(function(){
        var o = localStorage.getItem("setSearch");
        if(o!=null && o!=$('input[name="p"]').attr('value')){
            $('input[name="p"]').attr('value',o);
            $('.currentSOption').html($('li[data-search-param="'+o+'"]').html());
        }
        var curOption = $('input[name="p"]').attr('value');
        $('li[data-search-param="'+curOption+'"]').addClass('activeOption');
    })
</script>
