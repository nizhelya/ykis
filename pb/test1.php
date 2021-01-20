<?php
$xmlstr ='<?xml version="1.0" encoding="windows-1251"?> 
 <sponsor> 
 <rows cnt="20"> 
 <row id="1"> 
 <id_goods>163001</id_goods> 
 <place>Магазин цифровых товаров</place> 
 <server>http://www.адрес.сайта</server> 
 <price>0,6</price> 
 </row> 
 <row id="2"> 
 <id_goods>368362</id_goods> 
 <place>Букмекерская контора</place> 
 <server>http://www.адрес.сайта</server> 
 <price>0,12</price> 
 </row> 
 </rows> 
 </sponsor>
 ';
  
 $xml = simplexml_load_string($xmlstr); 
 echo '<pre>';
 var_dump($xml);
 echo '</pre>';
 
 
?> 