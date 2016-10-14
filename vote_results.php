<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты голосования");
?><?$APPLICATION->IncludeComponent(
    "bitrix:voting.result",
    "vote-result-redesign",
    Array(
        "VOTE_ID" => $_REQUEST["VOTE_ID"],
        "VOTE_ALL_RESULTS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "1200",
        "CACHE_NOTES" => ""
    ),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>