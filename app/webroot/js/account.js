$(document).ready(function() {
	var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("This field cannot be left blank");
            }
        };
    }
	$('#VoucherAddForm select#VoucherVoucherTypeId').change(function(event) {
		var type = $('#VoucherVoucherTypeId').val();
		if(type == 2){
			var strAdd = '<td>Advance For</td><td colspan=2>';
			strAdd += '<input name="data[Voucher][trans_account_a]" type="text" onkeyup="keyupAction(A)" value="" id="VoucherTransAccountA" />&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="var child=window.open(\'../accounts/printTree/A\', \'Select\', \'height=700, width=600, scrollbars=yes\');" target="_blank">...</button><input type="hidden" name="data[Voucher][trans_account_id_a]" value="" id="VoucherTransAccountIdA" />';
			strAdd += '<br><br></td>';
			$('#AdvanceVoucher').append(strAdd);
		} else {
			$('#AdvanceVoucher').find("td").remove();
		}
		event.stopImmediatePropagation(); 
        
     });
	
	$('#addTransaction').click(function(event) {
		var totalTrans = parseInt($('#VoucherTransCount').val());
		var newTotalTrans = 1+totalTrans;
		var prefix = 'Trans'+newTotalTrans;
		var strAdd = getTransactionRow(newTotalTrans);

		$('#TransactionsTable').append(strAdd);
		
		if(newTotalTrans == 3){
			var strLink = '<span class="colorBlue" id="removeTransaction" onclick="removeTransaction();">[-] खाता हटाउनुहोस</span>';
			$('#addRemoveLink').append(strLink);
		}
		
		$('#VoucherTransCount').val(newTotalTrans);
		event.stopImmediatePropagation(); 
        
     });
	
	$('#removeTransaction').click(function(event) {
		var totalTrans = parseInt($('#VoucherTransCount').val());
		var newTotalTrans = totalTrans-1;
		$('#TransactionsTable').find("TransactionRow" + totalTrans).remove();
		
		$('#VoucherTransCount').val(newTotalTrans);
		if(newTotalTrans <= 2 ){
			$('#removeTransaction').remove();
		}
		event.stopImmediatePropagation();
     });
	
});

function setValue(autoField, accountName, accountId) {
	var elmAccountName = '#VoucherTransAccount' + autoField;
	var elmAccountId = '#VoucherTransAccountId' + autoField;
	$(elmAccountName).val(accountName);
	$(elmAccountId).val(accountId);
	$('#accountList' + autoField).find("a").remove();
	$('div.accountList').css('display', 'none');
}

function setParentValue(autoField, accountName, accountId) {
	var elmAccountName = '#VoucherTransAccount' + autoField;
	var elmAccountId = '#VoucherTransAccountId' + autoField;
	window.opener.$(elmAccountName).val(accountName);
	window.opener.$(elmAccountId).val(accountId);
	window.opener.$('#accountList' + autoField).find("li").remove();
	window.close();
}

function removeTransaction(){
	var totalTrans = parseInt($('#VoucherTransCount').val());
	var newTotalTrans = totalTrans-1;
	
	$("#TransactionRow" + totalTrans).remove();
	
	$('#VoucherTransCount').val(newTotalTrans);
	if(newTotalTrans <= 2 ){
		$('#removeTransaction').remove();
	}
}
function keyupAction(num) {
    var budgetcode = $('#VoucherTransAccount' +num).val();
    if (budgetcode == '') {
    	$('#accountList'+num).css('display', 'none');
 	   return false;
    }
    var pathPre = $('#VoucherPathPre').val();
    if (pathPre == "../../") {
    	pathPre = "../";
    } else {
    	pathPre = "";
    }
    $.getJSON(pathPre + 'getAccountByBudgetCode/'+budgetcode, {}, function(data) {
    		   $('#accountList'+num).css('display', 'block');
        	   $('#accountList'+num).find("a").remove();
        	   $.each(data, function(index,value){
        		   
						var id = $.trim(index);
						var account = $.trim(value);
						$('#accountList'+num).append("<a href='#' onclick='setValue(\""+ num +"\", \"" + account + "\", \"" + id + "\")'>" + account+" [ " + id + " ]</a>");
					}
				);
    	}
    );
}

function getTransactionRow(newTotalTrans) {
	
	var pathPre = $('#VoucherPathPre').val();
	var strAdd = '';

	strAdd += '<tr id="TransactionRow' + newTotalTrans + '"><td>';
	strAdd += '<input name="data[Voucher][trans_account_' + newTotalTrans + ']" type="text" onkeyup="keyupAction(' + newTotalTrans + ')" value="" id="VoucherTransAccount' + newTotalTrans + '" placeholder = "खाता छान्नुहोस् ।" size = "45" required = "required"/>';
	strAdd += '<span class="form_hint">खाता छान्नुहोस् ।</span>&nbsp;';
	strAdd += '<span class="colorBlue" onclick="var child=window.open(\'' + pathPre + 'accounts/printTree/' + newTotalTrans + '\', \'Select\', \'height=700, width=600, scrollbars=yes\');">....</span><input type="hidden" name="data[Voucher][trans_account_id_' + newTotalTrans + ']" value="" id="VoucherTransAccountId' + newTotalTrans + '" />';
	strAdd += '<br /><div id="accountList' + newTotalTrans + '" class="accountList"></div>';
	strAdd += '</td><td class="center">';
	strAdd += '<input type="radio" name="data[Voucher][trans_drcr_' + newTotalTrans + ']" id="VoucherTransDrcr' + newTotalTrans + 'Dr" value="Dr"  /><label for="VoucherTransDrcr' + newTotalTrans + 'Dr">डेबिट</label><input type="radio" name="data[Voucher][trans_drcr_' + newTotalTrans + ']" id="VoucherTransDrcr' + newTotalTrans + 'Cr" value="Cr"  /><label for="VoucherTransDrcr' + newTotalTrans + 'Cr">क्रेडिट</label>	';
	strAdd += '</td><td class="center">';
	strAdd += '<input name="data[Voucher][trans_amount_' + newTotalTrans + ']" type="text" value="" id="VoucherTransAmount' + newTotalTrans + '" required = "required" placeholder = "रकम" required = "required" size = "10"/>';
	strAdd += '<span class="form_hint">रकम</span>';
	strAdd += '</td></tr>';
	return strAdd;
}
