<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Message Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default response messages used by
    | the return value of controller class or view.
    |
    */

    // FailedStoreData
	"FailedStoreData" => "Data failed to store",
	// SuccessStoreData
	"SuccessStoreData" => "Data stored successfully",
	// FailedUpdateData
	"FailedUpdateData" => "Data failed to update",
	// SuccessUpdateData
	"SuccessUpdateData" => "Data updated successfully",
	// SuccessDeleteData
	"SuccessDeleteData" => "Data deleted successfully",
	// FailedGetData
	"FailedGetData" => "Data not found",
	// SuccessGetData
	"SuccessGetData" => "Get data successfully",

	// ErrorBindRequest
	"ErrBindRequest" => "Failed to bind request",
    // ErrorInternalServerError will throw if any the Internal Server Error happen
	"ErrInternalServerError" => "Internal Server Error",
	// ErrorNotFound will throw if the requested item is not exists
	"ErrNotFound" => "Your requested Item is not found",
	// ErrorConflict will throw if the current action already exists
	"ErrConflict" => "Your Item already exist",
	// ErrorBadParamInput will throw if the given request-body or params is not valid
	"ErrBadParamInput" => "Given Param is not valid",
];
