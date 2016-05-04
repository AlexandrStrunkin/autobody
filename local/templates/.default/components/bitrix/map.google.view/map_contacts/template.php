<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    $arTransParams = array(
        'INIT_MAP_TYPE' => $arParams['INIT_MAP_TYPE'],
        'INIT_MAP_LON' => $arResult['POSITION']['google_lon'],
        'INIT_MAP_LAT' => $arResult['POSITION']['google_lat'],
        'INIT_MAP_SCALE' => $arResult['POSITION']['google_scale'],
        'MAP_WIDTH' => $arParams['MAP_WIDTH'],
        'MAP_HEIGHT' => $arParams['MAP_HEIGHT'],
        'CONTROLS' => $arParams['CONTROLS'],
        'OPTIONS' => $arParams['OPTIONS'],
        'MAP_ID' => $arParams['MAP_ID'],
    );

    if ($arParams['DEV_MODE'] == 'Y')
    {
        $arTransParams['DEV_MODE'] = 'Y';
        if ($arParams['WAIT_FOR_EVENT'])
            $arTransParams['WAIT_FOR_EVENT'] = $arParams['WAIT_FOR_EVENT'];
    }
?>
