<?
//ini_set('define_errors',1);
//error_reporting(E_ALL);
//exit();
//CModule::IncludeModule('sale');
//echo "qq";
$months=array("января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");
$ind=intval(date('m'))-1;
//	echo $ind."qq";

$resBasket = CSaleBasket::GetList(array(), array('ORDER_ID'=>$ORDER_ID));
while ($arBasket = $resBasket->Fetch()){	
    $GLOBALS['SALE_INPUT_PARAMS']['BASKET'][] = $arBasket;
	
}	
$seller_nds=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_NDS"));
?>
<?//echo '<pre>'.print_r($GLOBALS["SALE_CORRESPONDENCE"], true).'</pre>';?>
<?//echo '<pre>'.print_r($GLOBALS['SALE_INPUT_PARAMS'], true).'</pre>';?>


<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<link rel=File-List href="/filelist.xml">
<link rel=Edit-Time-Data href="/editdata.mso">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<title>Извещение</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>User</o:Author>
  <o:LastAuthor>Onil</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>1</o:TotalTime>
  <o:Created>2010-04-06T09:42:00Z</o:Created>
  <o:LastSaved>2010-04-06T09:42:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>314</o:Words>
  <o:Characters>1795</o:Characters>
  <o:Company>SB RF</o:Company>
  <o:Lines>14</o:Lines>
  <o:Paragraphs>4</o:Paragraphs>
  <o:CharactersWithSpaces>2105</o:CharactersWithSpaces>
  <o:Version>11.6568</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:DoNotHyphenateCaps/>
  <w:PunctuationKerning/>
  <w:DrawingGridHorizontalSpacing>6 пт</w:DrawingGridHorizontalSpacing>
  <w:DrawingGridVerticalSpacing>6 пт</w:DrawingGridVerticalSpacing>
  <w:DisplayHorizontalDrawingGridEvery>0</w:DisplayHorizontalDrawingGridEvery>
  <w:DisplayVerticalDrawingGridEvery>3</w:DisplayVerticalDrawingGridEvery>
  <w:UseMarginsForDrawingGridOrigin/>
  <w:ValidateAgainstSchemas>false</w:ValidateAgainstSchemas>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotUnderlineInvalidXML/>
  <w:Compatibility>
   <w:FootnoteLayoutLikeWW8/>
   <w:ShapeLayoutLikeWW8/>
   <w:AlignTablesRowByRow/>
   <w:ForgetLastTabAlignment/>
   <w:LayoutRawTableWidth/>
   <w:LayoutTableRowsApart/>
   <w:UseWord97LineBreakingRules/>
   <w:SelectEntireFieldWithStartOrEnd/>
   <w:UseWord2002TableStyleRules/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
 </w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" LatentStyleCount="156">
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;
	mso-font-charset:2;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	text-autospace:none;
	font-size:12.0pt;
	font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";}
p.1, li.1, div.1
	{mso-style-name:"заголовок 1";
	mso-style-next:Обычный;
	margin-top:12.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	mso-pagination:widow-orphan;
	text-autospace:none;
	font-size:16.0pt;
	font-family:Arial;
	mso-fareast-font-family:"Times New Roman";
	mso-font-kerning:16.0pt;
	font-weight:bold;}
span.a
	{mso-style-name:"Основной шрифт";
	mso-style-parent:"";}
@page Section1
	{size:841.9pt 595.3pt;
	mso-page-orientation:landscape;
	margin:3.0cm 2.0cm 42.55pt 2.0cm;
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
td{	font-size:12px;
	font-family:"Times New Roman";
   }
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Обычная таблица";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=RU style='tab-interval:35.4pt;text-justify-trim:punctuation'>

<div class=Section1>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='margin-left:4.65pt;border-collapse:collapse;border:none;mso-border-alt:
 solid windowtext 2.25pt;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
  height:21.75pt'>
  <td width=195 rowspan=14 valign=top style='width:146.25pt;border:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.75pt'>
  <p class=1 align=center style='text-align:center;mso-outline-level:1'><span
  style='font-size:8.0pt'>Извещение<o:p></o:p></span></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'>Кассир<o:p></o:p></span></b></p>
  </td>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border-top:solid windowtext 2.25pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-alt:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:21.75pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><!--[if gte vml 1]><v:shapetype
   id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
   path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>

    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="_x0000_i1025" type="#_x0000_t75" style='width:64.5pt;
   height:6.75pt' fillcolor="window">
   <v:imagedata src="/image001.jpg" o:title="Logo2"/>
  </v:shape><![endif]--><![if !vml]><img width=86 height=9
  src="/image002.jpg" v:shapes="_x0000_i1025"><![endif]><span
  style='mso-spacerun:yes'>  </span><b><span
  style='mso-spacerun:yes'>                                                                 </span></b></span><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><span
  style='mso-spacerun:yes'>                    </span></span></b><b><span
  style='font-size:8.0pt'><span
  style='mso-spacerun:yes'>                    </span><i>Форма № ПД-4<o:p></o:p></i></span></b></p>
  <p class=MsoNormal><b><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_NAME"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;page-break-inside:avoid;height:6.75pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>                                                                
  </span>(наименование получателя платежа) <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;page-break-inside:avoid;height:5.25pt'>
  <td width=181 colspan=2 valign=top style='width:135.7pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:5.25pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></p>
   <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_INN"))?>
  </td>
  <td width=17 valign=top style='width:12.95pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:5.25pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:5.25pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=277 colspan=6 valign=top style='width:207.6pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:5.25pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></p>
     <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_RS"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;page-break-inside:avoid;height:4.5pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>            </span>(ИНН получателя платежа)<span
  style='mso-spacerun:yes'>                                              
  </span>( номер счета получателя платежа)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;page-break-inside:avoid;height:4.5pt'>
  <td width=278 colspan=6 valign=top style='width:208.3pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_BANK"))?>
  </td>
  <td width=22 valign=top style='width:16.45pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=39 colspan=2 valign=bottom style='width:29.6pt;border:none;padding:
  0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>БИК<o:p></o:p></span></p>
  </td>
  <td width=152 valign=top style='width:113.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_BIK"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;page-break-inside:avoid;height:8.25pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:8.25pt'>
  <p class=MsoNormal><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>                     </span>(наименование банка
  получателя платежа)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;page-break-inside:avoid;height:6.0pt'>
  <td width=222 colspan=5 valign=top style='width:166.3pt;border:none;
  mso-border-left-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.0pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Номер кор./сч. банка получателя
  платежа<o:p></o:p></span></p>
  </td>
  <td width=269 colspan=5 valign=top style='width:201.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.0pt'>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_KS"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;page-break-inside:avoid;height:4.5pt'>
  <td width=278 colspan=6 valign=top style='width:208.3pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
    Оплата по счету <?=$GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['NUM_INVOICE']?>
  </td>
  <td width=28 colspan=2 valign=top style='width:21.3pt;border:none;padding:
  0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=185 colspan=2 valign=top style='width:138.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;page-break-inside:avoid;height:6.0pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.0pt'>
  <p class=MsoNormal><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>                       </span>(наименование
  платежа)<span
  style='mso-spacerun:yes'>                                                              
  </span>(номер лицевого счета (код) плательщика)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;page-break-inside:avoid;height:3.75pt'>
  <td width=133 valign=top style='width:99.8pt;border:none;mso-border-left-alt:
  solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.75pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'>Ф.И.О. плательщика:<o:p></o:p></span></p>
  </td>
  <td width=358 colspan=9 valign=top style='width:268.25pt;border:none;
  border-right:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.75pt'>
  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['LAST_NAME']?> <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['NAME']?> <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['SECOND_NAME']?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;page-break-inside:avoid;height:9.0pt'>
  <td width=133 valign=top style='width:99.8pt;border:none;mso-border-left-alt:
  solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;height:9.0pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'>Адрес плательщика:<o:p></o:p></span></p>
  </td>
  <td width=358 colspan=9 valign=top style='width:268.25pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-top-alt:solid windowtext .75pt;mso-border-bottom-alt:solid windowtext .75pt;
  mso-border-right-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.0pt'>
  <?
//   echo '<pre>'.print_r($GLOBALS['SALE_INPUT_PARAMS']['USER'],true).'</pre>';
  ?>
  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_ZIP']?>, <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_STATE']?>,  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_CITY']?>, <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_STREET']?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;page-break-inside:avoid;height:6.75pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal><span lang=EN-US style='font-size:9.0pt;mso-ansi-language:
  EN-US'><span style='mso-spacerun:yes'>  </span></span><span style='font-size:
  9.0pt'>Сумма платежа: 
  <?  
//    echo '<pre>'.print_r($GLOBALS["SALE_INPUT_PARAMS"]["BASKET"],true).'</pre>';
$nds_all=0;
foreach ($GLOBALS["SALE_INPUT_PARAMS"]["BASKET"] as $arItem){
           $SQL="SELECT 
		               b_catalog_vat.RATE
		         FROM b_catalog_product,b_catalog_vat
		         WHERE b_catalog_product.ID='".$arItem['PRODUCT_ID']."'
				 AND b_catalog_product.VAT_ID=b_catalog_vat.ID
				 AND b_catalog_product.VAT_INCLUDED='Y'
				 ";
//		   echo $SQL;
           $res=$DB->Query($SQL, false, $err_mess.__LINE__);
		   $rate=0;
		   while ($arr = $res->Fetch()){
		    $rate=$arr['RATE'];
		   }
   $nds=round(($rate*$arItem['PRICE']/100),2);
//   echo $nds."qq<br>";
   $nds_all=$nds_all+$nds;
}		   
   $nds_all=number_format($nds_all,2);
    $nds_p=explode('.',$nds_all); 
    $pieces = explode(".",$GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["PRICE"]);
		
  ?><?=$pieces[0]?> руб.<span style='mso-spacerun:yes'> 
  </span><?=$pieces[1]?> коп. 
  <? if($seller_nds=='True'){
  ?>
  (В том числе НДС <?=$nds_p[0]?> руб. <?=$nds_p[1]?> коп.)
  <?
   }
  ?>
  </span><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>   </span></span><span style='font-size:6.0pt'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;page-break-inside:avoid;height:6.0pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.0pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><span
  style='mso-spacerun:yes'>  </span><span
  style='mso-spacerun:yes'>       </span>"<?=date('d')?>" <? echo $months[$ind]; ?> <?=date('Y')?>г.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;page-break-inside:avoid;height:21.0pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 2.25pt;border-right:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:21.0pt'>
  <p class=MsoNormal><span style='font-size:7.0pt'>С условиями приема указанной
  в платежном документе суммы, в т.ч. с суммой взимаемой платы за услуги банка <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:7.0pt'>ознакомлен и согласен.<span
  style='mso-spacerun:yes'>                                        </span><b>Подпись
  плательщика</b><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;page-break-inside:avoid;height:8.25pt'>
  <td width=195 rowspan=15 valign=top style='width:146.25pt;border:solid windowtext 2.25pt;
  border-top:none;mso-border-top-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:8.25pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt;font-family:Wingdings;mso-bidi-font-family:Wingdings'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'>Квитанция <o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:8.0pt'>Кассир</span></b><b><span lang=EN-US
  style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  lang=EN-US style='font-size:8.0pt;mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-top-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:8.25pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><span
  style='mso-spacerun:yes'>  </span><b><o:p></o:p></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;page-break-inside:avoid;height:7.5pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_NAME"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16;page-break-inside:avoid;height:6.75pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><span
  style='mso-spacerun:yes'>                                                                
  </span>(наименование получателя платежа) <o:p></o:p></span></p>
  </td>

 </tr>
 <tr style='mso-yfti-irow:17;page-break-inside:avoid;height:5.25pt'>
  <td width=181 colspan=2 valign=top style='width:135.7pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:5.25pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_INN"))?>
  </td>
  <td width=17 valign=top style='width:12.95pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:5.25pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:5.25pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=277 colspan=6 valign=top style='width:207.6pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:5.25pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_RS"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18;page-break-inside:avoid;height:4.5pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><span
  style='mso-spacerun:yes'>            </span>(ИНН получателя платежа)<span
  style='mso-spacerun:yes'>                                              
  </span>( номер счета получателя платежа)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19;page-break-inside:avoid;height:4.5pt'>
  <td width=278 colspan=6 valign=top style='width:208.3pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_BANK"))?>
  </td>
  <td width=22 valign=top style='width:16.45pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=39 colspan=2 valign=bottom style='width:29.6pt;border:none;padding:
  0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>БИК<o:p></o:p></span></p>
  </td>
  <td width=152 valign=top style='width:113.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_BIK"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20;page-break-inside:avoid;height:8.25pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:8.25pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'><span
  style='mso-spacerun:yes'>                     </span>(наименование банка
  получателя платежа)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21;page-break-inside:avoid;height:6.0pt'>
  <td width=222 colspan=5 valign=top style='width:166.3pt;border:none;
  mso-border-left-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.0pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Номер кор./сч. банка
  получателя платежа<o:p></o:p></span></p>
  </td>
  <td width=269 colspan=5 valign=top style='width:201.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;

  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.0pt'>
  <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_KS"))?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22;page-break-inside:avoid;height:4.5pt'>
  <td width=278 colspan=6 valign=top style='width:208.3pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  Оплата по счету <?=$GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['NUM_INVOICE']?>
  </td>
  <td width=28 colspan=2 valign=top style='width:21.3pt;border:none;padding:
  0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=185 colspan=2 valign=top style='width:138.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:4.5pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23;page-break-inside:avoid;height:6.0pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.0pt'>
  <p class=MsoNormal><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>                       </span>(наименование платежа)<span
  style='mso-spacerun:yes'>                                                              
  </span>(номер лицевого счета (код) плательщика)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24;page-break-inside:avoid;height:3.75pt'>
  <td width=133 valign=top style='width:99.8pt;border:none;mso-border-left-alt:
  solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.75pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'>Ф.И.О. плательщика:<o:p></o:p></span></p>
  </td>
  <td width=358 colspan=9 valign=top style='width:268.25pt;border:none;
  border-right:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.75pt'>
  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['LAST_NAME']?> <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['NAME']?> <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['SECOND_NAME']?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25;page-break-inside:avoid;height:9.0pt'>
  <td width=133 valign=top style='width:99.8pt;border:none;mso-border-left-alt:
  solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;height:9.0pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'>Адрес плательщика:<o:p></o:p></span></p>
  </td>
  <td width=358 colspan=9 valign=top style='width:268.25pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 2.25pt;
  mso-border-top-alt:solid windowtext .75pt;mso-border-bottom-alt:solid windowtext .75pt;
  mso-border-right-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.0pt'>
  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_ZIP']?>,  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_STATE']?>,  <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_CITY']?>, <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_STREET']?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26;page-break-inside:avoid;height:6.75pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'>Сумма платежа: <?=$pieces[0]?>
  руб.<span style='mso-spacerun:yes'>  </span><?=$pieces[1]?> коп. 
   <? if($seller_nds=='True'){
   ?>
   (В том числе НДС <?=$nds_p[0]?> руб. <?=$nds_p[1]?> коп.)
   <?
    }
   ?>
   <span
  style='mso-spacerun:yes'>   </span></span><span
  style='font-size:6.0pt'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:27;page-break-inside:avoid;height:6.0pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border:none;
  border-right:solid windowtext 2.25pt;mso-border-left-alt:solid windowtext 2.25pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:6.0pt'>
  <p class=MsoNormal><span style='font-size:9.0pt'><span
  style='mso-spacerun:yes'>  </span><span
  style='mso-spacerun:yes'>       </span>"<?=date('d')?>" <? echo $months[$ind]; ?> <?=date('Y')?>г.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:28;mso-yfti-lastrow:yes;page-break-inside:avoid;
  height:21.0pt'>
  <td width=491 colspan=10 valign=top style='width:368.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 2.25pt;border-right:solid windowtext 2.25pt;
  mso-border-left-alt:solid windowtext 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:21.0pt'>
  <p class=MsoNormal><span lang=EN-US style='font-size:7.0pt;mso-ansi-language:
  EN-US'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal><span style='font-size:7.0pt'>С условиями приема указанной
  в платежном документе суммы, в т.ч. с суммой взимаемой платы за услуги банка <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:7.0pt'>ознакомлен и согласен.<span
  style='mso-spacerun:yes'>              </span><o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:7.0pt'><span
  style='mso-spacerun:yes'>                                                                               
  </span><b>Подпись плательщика</b></span><b><span lang=EN-US style='font-size:
  7.0pt;mso-ansi-language:EN-US'><o:p></o:p></span></b></p>
  <p class=MsoNormal><span lang=EN-US style='font-size:7.0pt;mso-ansi-language:
  EN-US'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=195 style='border:none'></td>
  <td width=133 style='border:none'></td>
  <td width=48 style='border:none'></td>
  <td width=17 style='border:none'></td>
  <td width=16 style='border:none'></td>
  <td width=8 style='border:none'></td>
  <td width=56 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=6 style='border:none'></td>
  <td width=33 style='border:none'></td>
  <td width=152 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal><span lang=EN-US style='font-family:Wingdings;mso-bidi-font-family:
Wingdings;mso-ansi-language:EN-US'>&quot;</span><span lang=EN-US
style='mso-ansi-language:EN-US'> - </span>линия отреза</p>

</div>

</body>

</html>
