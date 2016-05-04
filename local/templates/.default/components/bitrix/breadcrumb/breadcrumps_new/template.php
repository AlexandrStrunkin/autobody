<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    //delayed function must return a string
    if(empty($arResult))
        return "";

    $strReturn = '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';

    for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
    {  //arshow($arResult);
        if($index > 0)
            $strReturn .= '&nbsp;&rarr;&nbsp;';

        $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
        if($arResult[$index]["LINK"] !== "/"){
          
           $str_len=strlen($title);
           
            if($str_len > 40):
                $title=substr($title, 0,40).".";
                endif;

            if($index==$itemSize-1):
                
                // echo $str_len; 


                $strReturn .='<span typeof="v:Breadcrumb">'.$title.'</span>';
                else:        
                $strReturn .='<a itemprop="url" rel="v:url" property="v:title" href="'.$arResult[$index]["LINK"].'" title="'.$title.'"><span typeof="v:Breadcrumb">'.$title.'</span></a>';
                endif;
        }
        else{
            $strReturn .= '<span typeof="v:Breadcrumb">Главная</span>';
        }
    }

    $strReturn .= '</div>';
    return $strReturn;
?>

 


