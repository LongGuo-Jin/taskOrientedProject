"use strict";
var KTDatatablesBasicScrollable = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			scrollY: '50vh',
			scrollX: true,
			scrollCollapse: true,
            select: true,
            "ordering": false
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		}

	};

}();

jQuery(document).ready(function() {
	KTDatatablesBasicScrollable.init();
});