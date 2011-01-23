<?php
/*
 * @version $Id: HEADER 1 2010-03-03 21:49 Tsmr $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2010 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
// ----------------------------------------------------------------------
// Original Author of file: NOUH Walid & FONTAN Benjamin & CAILLAUD Xavier
// Purpose of file: plugin order v1.2.0 - GLPI 0.78
// ----------------------------------------------------------------------
 */
 
define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
header_nocache();

if (!defined('GLPI_ROOT')){
   die("Can not acces directly to this file");
}

checkCentralAccess();

$PluginOrderReference = new PluginOrderReference();

$rand = $PluginOrderReference->dropdownReferencesByEnterprise("reference",$_POST["itemtype"],
                                                              $_POST["suppliers_id"]);

$paramsaction=array('plugin_order_references_id'=>'__VALUE__',
              'entity_restrict'=>$_POST["entity_restrict"],
              'suppliers_id'=>$_POST["suppliers_id"],
              'itemtype'=>$_POST["itemtype"]
      );

$fields = array ("quantity","priceht","pricediscounted", "validate");
foreach ($fields as $field)
{
   $paramsaction['update'] = $field;
   ajaxUpdateItem("show_$field",$CFG_GLPI["root_doc"]."/plugins/order/ajax/referencedetail.php",
                  $paramsaction,false,"dropdown_reference$rand");
   ajaxUpdateItemOnSelectEvent("dropdown_reference$rand","show_$field",
                               $CFG_GLPI["root_doc"]."/plugins/order/ajax/referencedetail.php",
                               $paramsaction);
}

?>