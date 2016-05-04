    </td><!-- end content -->
    
    <td class="right_menu" valign="top" align="center">
        <?if ($APPLICATION->GetCurDir() == '/catalog/'):?>   
		    <?$APPLICATION->IncludeComponent("osg:catalog.compare.block", ".default", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"SECTION_SEPARATION" => "Y",	// Делить сравниваемые товары по разделам
	),
	false
);?> 
        <?else:?>
	    	<?$APPLICATION->IncludeComponent("osg:news.block", ".default", array(
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "86400",
	"IBLOCK_CODE" => "NEWS",
	"COUNT" => "3"
	),
	false
);?>
        <?endif?>
        
	        <?$APPLICATION->IncludeComponent("osg:catalog.specoffers.block", ".default", array(
	"SPEC_OFFER_ID" => "0",
	"COLS" => "1",
	"ROWS" => "3",
	"URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif",
	"WAITING_FOR" => "Y"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:voting.current", ".default", array(
	"CHANNEL_SID" => "RANDOM",
	"VOTE_ID" => "2",
	"VOTE_ALL_RESULTS" => "Y",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 		
		
	</td>
</tr>
<!-- 			3 tr 			-->
<!-- 		F O O T E R 		-->
<tr class="footer">
	<td class="copyrights">
    	<?$APPLICATION->IncludeFile("include/footer_copyrights.php");?>
    </td>
    <td colspan="2">
    	<div class="main_menu">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
            	"ROOT_MENU_TYPE"	=>	"top",
            	"MAX_LEVEL"	=>	"1",
            	"CHILD_MENU_TYPE"	=>	"left",
            	"USE_EXT"	=>	"N"
            	)
            );?> 
     	</div>
 
     	<table cellpadding="0" cellspacing="0" class="footer_bottom" width="100%">
     	<tr>
     		<td align="left" class="contacts">
     			<?$APPLICATION->IncludeFile("include/footer_contact.php");?>
        	</td>
        	<td align="right" class="develop">
        		<a href="http://fodex.ru" target="_blank">OSG &mdash; создание сайта <br /> Информация о проекте</a>
        	</td>
     	<tr>
     	</table>
    </td>
</tr>
</table>
<!-- Yandex.Metrika counter --><div style="display:none;"><script type="text/javascript">(function(w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter11471608 = new Ya.Metrika({id:11471608, enableAll: true, webvisor:true}); } catch(e) { } }); })(window, "yandex_metrika_callbacks");</script></div><script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script><noscript><div><img src="//mc.yandex.ru/watch/11471608" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->

<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/footer.php')) require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/footer.php'); ?>
</body>
</html>
<?if ($APPLICATION->GetTitle()) $APPLICATION->AddChainItem($APPLICATION->GetTitle())?>