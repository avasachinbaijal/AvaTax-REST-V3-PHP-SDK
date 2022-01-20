# # ShippingVerifyResultLines

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**result_code** | **string** | Describes whether the line is compliant or not. In cases where a determination could not be made, resultCode will provide the reason why. | [optional]
**line_number** | **string** | The lineNumber of the line evaluated. | [optional]
**message** | **string** | A short description of the result of the checks made against this line. | [optional]
**success_messages** | **string** | A detailed description of the result of each of the passed checks made against this line. | [optional]
**failure_messages** | **string** | A detailed description of the result of each of the failed checks made against this line. | [optional]
**failure_codes** | **string[]** | An enumeration of all the failure codes received for this line. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
