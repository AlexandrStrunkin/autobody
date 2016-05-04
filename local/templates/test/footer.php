
</td>
</tr>
</table>                  
</div>
</div>


<div class="bottom-menu">


    <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu_redesign", array(
            "ROOT_MENU_TYPE" => "top",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y"
            ),
            false
        );?>


</div>

<div class="counters-wrapper">
    <div class="counters">

        <!-- Yandex.Metrika informer -->
        <a href="https://metrika.yandex.ru/stat/?id=23257468&amp;from=informer"
            target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/23257468/3_0_3AA0E2FF_1A80C2FF_0_pageviews"
                style="width:88px; height:31px; border:0;" alt="яндекс.ћетрика" title="яндекс.ћетрика: данные за сегодн¤ (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:23257468,lang:'ru'});return false}catch(e){}"/></a>
        <!-- /Yandex.Metrika informer -->

        <!-- Rating@Mail.ru logo -->
        <a target="_blank" href="http://top.mail.ru/jump?from=2544150">
            <img src="//top-fwz1.mail.ru/counter?id=2544150;t=479;l=1" 
                border="0" height="31" width="88" alt="Рейтинг@Mail.ru"></a>
        <!-- //Rating@Mail.ru logo -->

        <!--LiveInternet counter--><script type="text/javascript">
            document.write("<a href='//www.liveinternet.ru/click' "+
                "target=_blank><img src='//counter.yadro.ru/hit?t13.11;r"+
                escape(document.referrer)+((typeof(screen)=="undefined")?"":
                    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                ";"+Math.random()+
                "' alt='' title='LiveInternet: показано число просмотров за 24"+
                " часа, посетителей за 24 часа и за сегодня' "+
                "border='0' width='88' height='31'><\/a>")
        </script><!--/LiveInternet-->

    </div>
    </div>
    
    
        </div>
        
         <script>markshover();</script>
         
    
<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/footer.php')) require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/footer.php'); ?>
</body>
</html>