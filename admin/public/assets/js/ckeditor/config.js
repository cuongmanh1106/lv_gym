/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'vi';
	 config.uiColor = '#3a7ca5';
	// Cấu hình CK_finder 
	 config.filebrowserBrowseUrl='public/assets/js/ckfinder.html';
	config.filebrowserImageBrowseUrl='public/assets/js/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl='public/assets/js/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl='public/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl='public/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl='public/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
