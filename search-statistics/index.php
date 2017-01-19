<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поисковая статистика");
?>
<p>Поисковые запросы хранятся в течении 62 дней. Показываются только запросы с количеством просмотров больше <?= SEARCH_STATISTIC_VIEWS?>. </p><br>
<form action="">
    <?$APPLICATION->IncludeComponent(
            "bitrix:main.calendar",
            "",
            Array(
                "COMPONENT_TEMPLATE" => ".default",                                                  
                "FORM_NAME" => "",
                "HIDE_TIMEBAR" => "N",
                "INPUT_NAME" => "date_from",
                "INPUT_NAME_FINISH" => "date_to",
                "INPUT_VALUE" => $_GET["date_from"],
                "INPUT_VALUE_FINISH" => $_GET["date_to"],
                "SHOW_INPUT" => "Y",
                "SHOW_TIME" => "N"
            )
        );?>
    <input type='submit' value='Показать'>
    <input type="hidden" name='send' value='yes'>
</form>

<?if($_GET['send'] == 'yes'){
        if(!empty($_GET['date_to'])||!empty($_GET['date_from'])){
            $date_to = ConvertDateTime($_GET['date_to'], "YYYY-MM-DD 23:59:59");
            $date_from = ConvertDateTime($_GET['date_from'], "YYYY-MM-DD 00:00:00");
            if($date_to < $date_from) {
                $date_tmp = $date_to;
                $date_to = $date_from;
                $date_from = $date_tmp;   
            }
            $AND = '';
            if(!empty($date_to)) {
                $AND .=' and TIMESTAMP_X < "'.$date_to.'"';
            }
            if(!empty($date_from)) {
                $AND .=' and TIMESTAMP_X >= "'.$date_from.'"';
            }
        }
        $query = "select distinct TIMESTAMP_X, PHRASE, count(PHRASE) as CountOf from b_search_phrase group by PHRASE having CountOf >= ".SEARCH_STATISTIC_VIEWS." ".$AND." ORDER BY CountOf DESC";

        GLOBAL $DB;
        $res = $DB -> query($query);        

        $list = array(iconv("UTF-8", "CP1251", 'Поисковые запросы с '.substr($date_from, 0, 10).' по '.substr($date_to, 0, 10).';Число запросов'));
        
        echo '<br><a download href="/search-statistics/csv/searchstat'.date('Y-m-d').'.csv">Скачать .csv</a><br>';
        ?>
        <br>
        <table class="searchStatTable">
            <tr>
                <th class="searchStatTable">Поисковый запрос</th>
                <th class="searchStatTable">Количество запросов</th>
            </tr>
        <?        
        while($arres = $res -> fetch()) {
            $list[] = $arres["PHRASE"].";".$arres["CountOf"];
            ?>
            <tr>
                <td class="searchStatTable"><?=$arres["PHRASE"]?></td>
                <td class="searchStatTable"><?=$arres["CountOf"]?></td>
            </tr>
            <?    
        }
        ?>
        </table>
        <?
        $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/search-statistics/csv/searchstat'.date('Y-m-d').'.csv', 'w');

        foreach ($list as $line) {
            fputcsv($fp, explode(';', $line),";");
        }
        fclose($fp);
    }
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>