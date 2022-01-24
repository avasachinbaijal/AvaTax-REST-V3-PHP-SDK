# # ShippingVerifyResult

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**compliant** | **bool** | Whether every line in the transaction is compliant. | [optional]
**message** | **string** | A short description of the result of the compliance check. | [optional]
**success_messages** | **string** | A detailed description of the result of each of the passed checks made against this transaction, separated by line. | [optional]
**failure_messages** | **string** | A detailed description of the result of each of the failed checks made against this transaction, separated by line. | [optional]
**failure_codes** | **string[]** | An enumeration of all the failure codes received across all lines. | [optional]
**warning_codes** | **string[]** | An enumeration of all the warning codes received across all lines that a determination could not be made for. | [optional]
**lines** | [**\Avalara\SDK\Model\ShippingVerifyResultLines[]**](ShippingVerifyResultLines.md) | Describes the results of the checks made for each line in the transaction. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
