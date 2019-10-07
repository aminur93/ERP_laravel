<?php
    function menuActive($menu='', $multi=[]) {
        if(!empty($multi)) {
            return in_array(Request::path(), $multi)!==FALSE?'active':'';
        } else {
            return Request::path()==$menu?'active':'';
        }
    }
?>
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {}
    </script>
    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar')
            } catch (e) {}
        </script>
        <!-- Left sidebar menu start-->
        <ul class="nav nav-list">
            <li class="{{ menuActive('commercial/dashboard') }}">
                <a href="{{ url('commercial/dashboard') }}"><i class="menu-icon fa fa-home"></i>
                    <span class="menu-text"> Dashboard</span>
                </a>
                <b class="arrow"></b>
            </li>

            <!-- Export -->
            <?php
                $com_exp = 'commercial/export/';
                $export_array = [
                    $com_exp.'sales_contract/sales_contract_entry',
                    $com_exp.'sales_contract/sales_contract_list',
                    $com_exp.'exportlc',
                    $com_exp.'exportlclist',
                    $com_exp.'export-lc-update-screen',
                    $com_exp.'export-lc-update-screen3',
                    $com_exp.'exportLcEntry',
                    $com_exp.'elcFileClose',
                    $com_exp.'freight_charge',
                    $com_exp.'expordataentry',
                    $com_exp.'expFabricConsEntry',
                    $com_exp.'export_bill_air',
                    $com_exp.'export_bill_sea',
                    $com_exp.'cash_incentive'
                ];
            ?>
            <li class="{{ menuActive('',$export_array) }}">
                <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-ship"></i>
                    <span class="menu-text">Export</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <!-- Sales Contract-->
                    <?php
                        $export_sales_contract_array = [
                            $com_exp.'sales_contract/sales_contract_entry',
                            $com_exp.'sales_contract/sales_contract_list',
                        ];
                    ?>
                    <li class="{{ menuActive('',$export_sales_contract_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Sales Contract
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/export/sales_contract/sales_contract_entry') }}">
                                <a href="{{ url('commercial/export/sales_contract/sales_contract_entry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/sales_contract/sales_contract_list') }}">
                                <a href="{{ url('commercial/export/sales_contract/sales_contract_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Contract List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Export L/C  -->
                    <?php
                        $export_lc_array = [
                            $com_exp.'exportlc',
                            $com_exp.'exportlclist',
                            $com_exp.'export-lc-update-screen',
                            $com_exp.'export-lc-update-screen3',
                            $com_exp.'exportLcEntry',
                            $com_exp.'elcFileClose',
                            $com_exp.'freight_charge'
                        ];
                    ?>
                    <li class="{{ menuActive('',$export_lc_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Export L/C
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/export/exportlc') }}">
                                <a href="{{ url('commercial/export/exportlc') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Export L/C Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/exportlclist') }}">
                                <a href="{{ url('commercial/export/exportlclist') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Export L/C List
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/export-lc-update-screen') }}">
                                <a href="{{ url('commercial/export/export-lc-update-screen') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Export L/C Entry Update Screen 2

                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/export-lc-update-screen3') }}">
                                <a href="{{ url('commercial/export/export-lc-update-screen3') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Export L/C Entry Update Screen 3
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/exportLcEntry') }}">
                                <a href="{{ url('commercial/export/exportLcEntry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Export L/C Entry Update Screen - 5
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/elcFileClose') }}">
                                <a href="{{ url('commercial/export/elcFileClose') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>ELC File Close
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/export/freight_charge') }}">
                                <a href="{{ url('commercial/export/freight_charge') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Freight Charge
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="{{ menuActive('commercial/export/expordataentry') }}">
                        <a href="{{ url('commercial/export/expordataentry') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Export Data Entry - 1A
                        </a>
                    </li>
                    <li class="{{ menuActive('commercial/export/expFabricConsEntry') }}">
                        <a href="{{ url('commercial/export/expFabricConsEntry') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Export Fabric Consumption Entry
                        </a>
                    </li>
                    <li class="{{ menuActive('commercial/export/export_bill_air') }}">
                        <a href="{{ url('commercial/export/export_bill_air') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Export Bill (Air)
                        </a>
                    </li>
                    <li class="{{ menuActive('commercial/export/export_bill_sea') }}">
                        <a href="{{ url('commercial/export/export_bill_sea') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Export Bill (Sea)
                        </a>
                    </li>
                    <li class="{{ menuActive('commercial/export/cash_incentive') }}">
                        <a href="{{ url('commercial/export/cash_incentive') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Cash Incentive
                        </a>
                    </li>



                     {{-- added from Abir --}}
                    <li class="{{ menuActive('commercial/export/export_prc_correction') }}">
                        <a href="{{ url('commercial/export/export_prc_correction') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Export PRC Correction
                        </a>
                    </li>
                    {{-- added from Abir end--}}


                </ul>
            </li>

            <!-- IMPORT -->
            <?php
                $com_imt = 'commercial/import/';
                $import_array = [
                    $com_imt.'pi/master_fabric',
                    $com_imt.'pi/master_fabric_list',
                    $com_imt.'billofentry',
                    $com_imt.'billofentry_list',
                    $com_imt.'cf_bill_monitoring',
                    $com_imt.'cf_bill_monitoring_list',
                    $com_imt.'cf_expenses',
                    $com_imt.'cf_expenses_list',
                    $com_imt.'cfExpensesSea',
                    $com_imt.'cfExpensesSea_list',
                    'comm/import/ud_master/new',
                    'comm/import/ud_master/list',
                    $com_imt.'ilc/btb_entry',
                    $com_imt.'ilc/btb_list',
                    $com_imt.'ilc/btb_asset',
                    $com_imt.'ilc/asset_list',
                    'comm/import/importlc/foc',
                    'comm/import/importlc/foclist',
                    'comm/import/importdata/importdataview',
                    'comm/import/importdata/importdata',
                    'comm/import/chalan/chalanview',
                    'comm/import/chalan/localchalanlist',
                    'comm/import/pass-book-and-volume-number',
                    'comm/import/import-data-update/consignment/seas',
                    'comm/import/import-data-update/consignment/port',
                    'comm/import/asset/others-pi-entry/create',
                    'comm/import/asset/others-pi-entry',
                    'comm/import/asset/assetview',
                    'comm/import/asset/assets',
                    'comm/import/shipping_guarantee_date_update'
                ];
            ?>
            <li class="{{ menuActive('',$import_array) }}">
                <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-ship"></i>
                    <span class="menu-text">Import</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <!-- Proforma Invoice  -->
                    <?php
                        $im_proforma_array = [
                            $com_imt.'pi/master_fabric',
                            $com_imt.'pi/master_fabric_list',
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_proforma_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Proforma Invoice
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/import/pi/master_fabric') }}">
                                <a href="{{ url('commercial/import/pi/master_fabric') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>PI Master Fabric/Accessories
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/pi/master_fabric_list') }}">
                                <a href="{{ url('commercial/import/pi/master_fabric_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>PI Master Fabric List
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!--- BTB Entry (Import L/C)----->
                    <?php
                        $im_imlc_array = [
                            'commercial/import/ilc/btb_entry',
                            'commercial/import/ilc/btb_list',
                            'commercial/import/ilc/btb_asset',
                            'commercial/import/ilc/asset_list'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_imlc_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>BTB Entry
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/import/ilc/btb_entry') }}">
                                <a href="{{ url('commercial/import/ilc/btb_entry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>BTB Entry(Fabric, Accessories)
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/ilc/btb_list') }}">
                                <a href="{{ url('commercial/import/ilc/btb_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>BTB(Fabric, Accessories) List
                                </a>
                            </li>

                            <li class="{{ menuActive('commercial/import/ilc/btb_asset') }}">
                                <a href="{{ url('commercial/import/ilc/btb_asset') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>BTB Entry(Asset, Others)
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/ilc/asset_list') }}">
                                <a href="{{ url('commercial/import/ilc/asset_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>BTB(Asset, Others) List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--- Import FOC Entry ----->
                    <?php
                        $im_imfoc_array = [
                            'comm/import/importlc/foc',
                            'comm/import/importlc/foclist'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_imfoc_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>FOC Entry
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/importlc/foc') }}">
                                <a href="{{ url('comm/import/importlc/foc') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>FOC Entry & Update
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/importlc/foclist') }}">
                                <a href="{{ url('comm/import/importlc/foclist') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>FOC List
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!--- Import Data----->
                    <?php
                        $im_impdata_array = [
                            'comm/import/importdata/importdataview',
                            'comm/import/importdata/importdata'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_impdata_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Import Data
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/importdata/importdataview') }}">
                                <a href="{{ url('comm/import/importdata/importdataview') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Import Data List
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/importdata/importdata') }}">
                                <a href="{{ url('comm/import/importdata/importdata') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Import Data Entry
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!---Local Chalan Entry----->
                    <?php
                        $im_imchalan_array = [
                            'comm/import/chalan/chalanview',
                            'comm/import/chalan/localchalanlist'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_imchalan_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Chalan Entry
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/chalan/chalanview') }}">
                                <a href="{{ url('comm/import/chalan/chalanview') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Chalan Data List
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/chalan/localchalanlist') }}">
                                <a href="{{ url('comm/import/chalan/localchalanlist') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Chalan Data Entry
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- UD System -->
                    <?php
                        $im_ud_array = [
                            'comm/import/ud_master/new',
                            'comm/import/ud_master/list'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_ud_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>UD Master
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/ud_master/new') }}">
                                <a href="{{ url('comm/import/ud_master/new') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Add New
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/ud_master/list') }}">
                                <a href="{{ url('comm/import/ud_master/list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>UD Master List
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Bill of Entry -->
                    <?php
                        $im_billentry_array = [
                            $com_imt.'billofentry',
                            $com_imt.'billofentry_list'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_billentry_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Bill of Entry
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/import/billofentry') }}">
                                <a href="{{ url('commercial/import/billofentry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Add Bill of Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/billofentry_list') }}">
                                <a href="{{ url('commercial/import/billofentry_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Bill of Entry List
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!---Local Chalan----->
                    <li class="{{ menuActive('comm/import/pass-book-and-volume-number') }}">
                        <a href="{{ url('comm/import/pass-book-and-volume-number') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Pass Book and
                            <br> Volume Number
                        </a>
                    </li>


                    <!--- Import Update Data----->
                    <?php
                        $im_imupdata_array = [
                            'comm/import/import-data-update/consignment/seas',
                            'comm/import/import-data-update/consignment/port'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_imupdata_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Import Data Update
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/import-data-update/consignment/seas') }}">
                                <a href="{{ url('comm/import/import-data-update/consignment/seas') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Consignment on High Seas
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/import-data-update/consignment/port') }}">
                                <a href="{{ url('comm/import/import-data-update/consignment/port') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Consignment at Port
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- C&F Bill Monitoring -->
                    <?php
                        $im_cfbillmon_array = [
                            $com_imt.'cf_bill_monitoring',
                            $com_imt.'cf_bill_monitoring_list'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_cfbillmon_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>C&F Bill Monitoring
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/import/cf_bill_monitoring') }}">
                                <a href="{{ url('commercial/import/cf_bill_monitoring') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Add C&F Bill Monitoring
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/cf_bill_monitoring_list') }}">
                                <a href="{{ url('commercial/import/cf_bill_monitoring_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>C&F Bill Monitoring List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Shipping Guarantee -->

                    <li class="{{ menuActive('comm/import/shipping_guarantee_date_update') }}">
                        <a href="{{ url('comm/import/shipping_guarantee_date_update') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Shipping Guarantee Date Update
                        </a>
                    </li>

                    <!-- C&F Expenses (Air) -->
                    <?php
                        $im_cfexpair_array = [
                            $com_imt.'cf_expenses',
                            $com_imt.'cf_expenses_list'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_cfexpair_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Clearing Expenses Import 
                            <br>(Air)
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/import/cf_expenses') }}">
                                <a href="{{ url('commercial/import/cf_expenses') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Add C&F Expenses (Air)
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/cf_expenses_list') }}">
                                <a href="{{ url('commercial/import/cf_expenses_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>C&F Expenses (Air) List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- C&F Expenses (Sea) -->
                    <?php
                        $im_cfexsea_array = [
                            $com_imt.'cfExpensesSea',
                            $com_imt.'cfExpensesSea_list'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_cfexsea_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Clearing Expenses Import 
                            <br>(Sea)
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('commercial/import/cfExpensesSea') }}">
                                <a href="{{ url('commercial/import/cfExpensesSea') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Add C&F Expenses (Sea)
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/import/cfExpensesSea_list') }}">
                                <a href="{{ url('commercial/import/cfExpensesSea_list') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>C&F Expenses (Sea) List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--- asset / others pi entry Data----->
                    <?php
                        $im_imassotherpi_array = [
                            'comm/import/asset/others-pi-entry/create',
                            'comm/import/asset/others-pi-entry'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_imassotherpi_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Asset (PI)
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/asset/others-pi-entry/create') }}">
                                <a href="{{ url('comm/import/asset/others-pi-entry/create') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Others PI Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/asset/others-pi-entry') }}">
                                <a href="{{ url('comm/import/asset/others-pi-entry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>List of Others PI Entry
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--- Asset others data ----->
                    <?php
                        $im_imassotherdata_array = [
                            'comm/import/asset/assetview',
                            'comm/import/asset/assets'
                        ];
                    ?>
                    <li class="{{ menuActive('',$im_imassotherdata_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>Asset/Other
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="{{ menuActive('comm/import/asset/assetview') }}">
                                <a href="{{ url('comm/import/asset/assetview') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Asset Data List
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/import/asset/assets') }}">
                                <a href="{{ url('comm/import/asset/assets') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Asset Data Entry
                                </a>
                            </li>
                        </ul>
                    </li>

                    

                    <!--new import data entry-->
                    <?php
                    $new_im_impdata_array = [
                        'comm/newimportdata'
                    ];
                    ?>
                    <li class="{{ menuActive('',$new_im_impdata_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>New Import Data
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="">
                                <a href="">
                                    <i class="menu-icon fa fa-caret-right"></i>New Import Data List
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/newimportdata') }}">
                                <a href="{{ url('comm/newimportdata') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>New Import Data Entry
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--new Asset data entry-->
                    <?php
                    $new_im_impdata_array = [
                        'comm/newimportdata'
                    ];
                    ?>
                    <li class="{{ menuActive('',$new_im_impdata_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>New Asset/Other Data
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="">
                                <a href="">
                                    <i class="menu-icon fa fa-caret-right"></i>New Asset Data List
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/newimportdata') }}">
                                <a href="{{ url('comm/newimportdata') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>New Asset Data Entry
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--new Chalan data entry-->
                    <?php
                    $new_im_chalan_array = [
                        'comm/newimportdata'
                    ];
                    ?>
                    <li class="{{ menuActive('',$new_im_chalan_array) }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>New Chalan Data
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled" style="">
                            <li class="">
                                <a href="">
                                    <i class="menu-icon fa fa-caret-right"></i>New Chalan Data List
                                </a>
                            </li>
                            <li class="{{ menuActive('comm/newimportdata') }}">
                                <a href="{{ url('comm/newimportdata') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>New Chalan Data Entry
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul> <!--Submennu ul-->
            </li> <!--menu li-->


            <!-- Bank -->
            <?php
                    $com_bank = 'commercial/bank/';
                    $bank_menu_array = [
                            $com_bank.'bank_acceptance_entry',
                            $com_bank.'import_bill_settlement',
                            $com_bank.'import_bill_settlement_view',
                            $com_bank.'fund_transfer_entry',
                            $com_bank.'fund_transfer_entry_preview',
                            $com_bank.'export_bill_discounting_entry',
                            $com_bank.'bank_export_reibrusment_entry',
                            $com_bank.'bank_export_reibrusment_entry_preview',
                            $com_bank.'bank_forward_sales_master_entry',
                            $com_bank.'bank_forward_sales_entry_view',
                            $com_bank.'payment_planning',
                            $com_bank.'showPlanningData'
                    ];
            ?>

            <li class="{{ menuActive('',$bank_menu_array) }}">
                <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-bank"></i>
                    <span class="menu-text">Bank</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu can-scroll ace-scroll scroll-disabled">
                    <li class="{{ menuActive('commercial/bank/bank_acceptance_entry') }}" >
                        <a href="{{ url('commercial/bank/bank_acceptance_entry') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Bank Acceptance Entry
                            <br>(Import)
                        </a>
                    </li>

                    <?php
                          $imp_sattle_menu = [
                                                $com_bank.'import_bill_settlement',
                                                $com_bank.'import_bill_settlement_view'
                                             ];
                    ?>
                    <li class="{{ menuActive('', $imp_sattle_menu ) }}">
                        <a href="{{url('commercial/bank/import_bill_settlement')}}">
                            <i class="menu-icon fa fa-caret-right"></i>Import Bill Settlement

                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled">
                            <li class="{{ menuActive('commercial/bank/import_bill_settlement_view') }}">
                                <a href="{{ url('commercial/bank/import_bill_settlement_view') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Import Bill Settlement Entry list
                                </a>
                            </li>
                        </ul>
                    </li>


                    <?php
                            $fund_trns_menu = [
                                $com_bank.'fund_transfer_entry',
                                $com_bank.'fund_transfer_entry_preview'
                            ];
                    ?>

                    <li class="{{menuActive('', $fund_trns_menu) }}">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>Fund Transfer Entry
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled">
                            <li class="{{ menuActive('commercial/bank/fund_transfer_entry') }}">
                                <a href="{{url('commercial/bank/fund_transfer_entry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/bank/fund_transfer_entry_preview') }}">
                                <a href="{{url('commercial/bank/fund_transfer_entry_preview') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry Preview
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ menuActive('commercial/bank/export_bill_discounting_entry') }}">
                        <a href="{{url('commercial/bank/export_bill_discounting_entry')}}">
                            <i class="menu-icon fa fa-caret-right"></i>Export Bill Discounting Entry
                        </a>
                    </li>


                    <?php
                            $exp_reim_menu = [
                                $com_bank.'bank_export_reibrusment_entry',
                                $com_bank.'bank_export_reibrusment_entry_preview'
                            ];
                     ?>
                    <li class="{{ menuActive('', $exp_reim_menu) }}">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>Export Reimburse Entry
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled">
                            <li class="{{ menuActive('commercial/bank/bank_export_reibrusment_entry') }}">
                                <a href="{{url('commercial/bank/bank_export_reibrusment_entry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/bank/bank_export_reibrusment_entry_preview') }}">
                                <a href="{{url('commercial/bank/bank_export_reibrusment_entry_preview') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry Preview
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php
                            $forwrd_sales_menu = [
                                $com_bank.'bank_forward_sales_master_entry',
                                $com_bank.'bank_forward_sales_entry_view'
                            ];
                     ?>
                    <li class="{{ menuActive('', $forwrd_sales_menu) }}">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>Forward Sales Master
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled">
                            <li class="{{ menuActive('commerci885al/bank/bank_forward_sales_master_entry') }}">
                                <a href="{{url('commercial/bank/bank_forward_sales_master_entry') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry
                                </a>
                            </li>
                            <li class="{{ menuActive('commercial/bank/bank_forward_sales_entry_view') }}">
                                <a href="{{url('commercial/bank/bank_forward_sales_entry_view') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>Entry Preview
                                </a>
                            </li>
                        </ul>
                    </li>


                    <?php
                          $payment_plan_menu = [
                                                $com_bank.'payment_planning',
                                                $com_bank.'showPlanningData'
                                             ];
                    ?>
                    <li class="{{ menuActive('', $payment_plan_menu) }}">
                        <a href="{{url('commercial/bank/payment_planning')}}">
                            <i class="menu-icon fa fa-caret-right"></i>Payment Planning
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu can-scroll ace-scroll scroll-disabled">
                            <li class="{{ menuActive('commercial/bank/showPlanningData') }}">
                                <a href="{{url('commercial/bank/showPlanningData')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>Payment Planninmg Entry list
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- Setup -->
            <?php
                $setup = ['commercial/setup/setup'];
            ?>
            <li class="{{ menuActive('', $setup) }}">
                <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-cogs"></i>
                    <span class="menu-text">Setup</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="{{ menuActive('commercial/setup/setup') }}">
                        <a href="{{ url('commercial/setup/setup') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Setup
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Left sidebar menu end-->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>
