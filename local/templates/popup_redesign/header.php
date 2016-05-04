<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowPanel();?>
    <?$APPLICATION->ShowHead();?>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|PT+Sans+Narrow:400,700|PT+Sans+Caption:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <?/*<link rel="stylesheet" type="text/css" href="/css/style.css"/>*/?>
    <link rel="stylesheet" type="text/css" href="/css/style_redesign.css"/>
    <link rel="icon" type="image/png" href="/images/favicon.png"/> 
    <link rel="apple-touch-icon" href="/images/favicon-iphone.png"/> 
    <script type="text/javascript" src="/js/jquery-1.7.1.js"></script>

    <script type='text/javascript' src='/js/jquery.rating.js'></script>

    <link href="/css/dcaccordion.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='/js/jquery.hoverIntent.minified.js'></script>
    <script type='text/javascript' src='/js/jquery.dcjqaccordion.2.7.js'></script>


    <script type="text/javascript" src="/js/jcarousellite.js"></script>
    <link href="/css/carousel.css" type="text/css" rel="stylesheet" />


    <link href="/css/jqModal.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jqModal.js'></script>

    <script type='text/javascript' src='/js/script.js'></script>


    <link rel="stylesheet" href="/css/coin-slider-styles.css" type="text/css" />


    <link href="/css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.fancybox.js'></script>

    <script src="/js/jquery.selectbox.min.js"></script> 
    <script>  
        (function($) {  
            $(function() {  
                $('select').selectbox();  
            })  
        })(jQuery)  
    </script>

    <script src="/js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/css/uniform.default.css" type="text/css" media="screen">
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $("input").uniform();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function($){
            filterPopUp();

            $('#accordion-1').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: true,
                disableLink: true,
                speed: 'slow',
                showCount: false,
                autoExpand: true,
                cookie    : 'dcjq-accordion-1',
                classExpand     : 'dcjq-current-parent'
            });
        });
    </script>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>



    <script type="text/javascript">
        <?$store_list = CCatalogStore::GetList(array(), array("ID"=>$_SESSION["GKWH"]), false, false, array());
            $arStore = $store_list->Fetch();?>


    </script>

    <?$APPLICATION->ShowMeta("robots")?>
    <?if (!CModule::IncludeModule("iblock")){
        CModule::IncludeModule("iblock");
    }?>


</head>

<body style="background: none;">
