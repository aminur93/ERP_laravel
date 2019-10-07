<?php

// --------------ABIR's Section-------------------------------------------------------------------------------//
Route::get('commercial/export/export_prc_correction', 
				'Commercial\Export\Export_PRC_correction\ExportPRCCorrectionCorrection@viewInvoiceList');

Route::get('commercial/export/export_prc_correction_save', 
				'Commercial\Export\Export_PRC_correction\ExportPRCCorrectionCorrection@prc_correction_save');

Route::get('commercial/export/export_prc_correction_update', 
				'Commercial\Export\Export_PRC_correction\ExportPRCCorrectionCorrection@prc_correction_update');

Route::get('commercial/export/export_prc_correction_delete/{id}', 
				'Commercial\Export\Export_PRC_correction\ExportPRCCorrectionCorrection@prc_correction_delete');

// --------------ABIR's Section end---------------------------------------------------------------------------//


?>