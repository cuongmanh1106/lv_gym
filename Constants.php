<?php
class Constants {

	//status order
	const STATUS_NEW_ORDER = 1;
	const STATUS_CONFIRM_ORDER = 2;
	const STATUS_DELIVERING_ORDER = 3;
	const STATUS_COMPLETED_ORDER = 4;
	const STATUS_CANCEL_ORDER = 5;

	//Status Shipper
	const STATUS_DELIVERING_SHIPPER = 0;
	const STATUS_DELIVERED_SHIPPER = 1;
	const STATUS_CANCEL_SHIPPER = 2;

	//status Stock
	const STATUS_ENTERING_STOCK_RECEIT = 0;
	const STATUS_CONFIRM_STOCK_RECEIPT = 1;
	const STATUS_CANCEL_STOCK_RECEIPT = 2;

	//status detail_stock
	const STATUS_NEW_PRODUCT_DETAIL_STOCK = 0;
	const STATUS_UPDATE_PRODUCT_DETAIL_STOCK = 1;
	const STATUS_DELETE_PRODUCT_DETAIL_STOCK = 2;

	//status product
	const STATUS_DISPLAY_PRODUCT = 0;
	const STATUS_DELETED_PRODUCT = 1;
	const STATUS_PENDING_PRODUCT = 2;

	//status user
	const STATUS_DISPLAY_USER = 0;
	const STATUS_DELETED_USER = 1;

	//status categories
	const STATUS_DISPLAY_CATEGORY = 0;
	const STATUS_DELETED_CATEGORY = 1;

	//status feedback
	const STATUS_NEW_FEEDBACK = 0;
	const STATUS_VIEWED_FEEDBACK = 1;

	//status group_permission
	const STATUS_ALLOW_PERMISSION = 1;
	const STATUS_DENY_PERMISSION = 0;

	//Status promotion
	const STATUS_DISPLAY_PROMOTION = 0;
	const STATUS_DELETED_PROMOTION = 1;

	//status promotion_detail
	const STATUS_DISPLAY_PROMOTION_DETAIL = 0;
	const STATUS_DELETED_PROMOTION_DETAIL = 1;

	//status supplier
	const STATUS_DISPLAY_SUPPLIER = 0;
	const STATUS_DELETED_SUPPLIER = 1;

}

?>