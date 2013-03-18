/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	//config.uiColor = '#454545';
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
		config.width = '600';
	config.resize_minWidth = false;
	config.resize_maxWidth = false;
	config.forcePasteAsPlainText     = true;
	config.toolbar = 'CapungToolbar';
	config.toolbar_CapungToolbar =
	[
		['Source'],
		['Bold','Italic','Underline','Strike','Subscript','Superscript' ],
		['Link','Unlink'],
		['Undo','Redo'],
    	['Image','Table','SpecialChar'],
    	['NumberedList','BulletedList'],
	];
	config.removeButtons = 'Maximize,HorizontalRule,Anchor';
};
