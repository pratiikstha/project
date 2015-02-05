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
});

function setAccountValue(accountName, accountId) {
	var elmAccountName = '#DayBookAccountName';
	var elmAccountId = '#DayBookAccountId';
	$(elmAccountName).val(accountName);
	$(elmAccountId).val(accountId);
	$('#accountList').find("a").remove();
	$('div.accountList').css('display', 'none');
}

function getAccounts() {
    var incomeId = $('#DayBookAccountName').val();
    if (incomeId == '') {
    	$('#accountList').css('display', 'none');
 	   return false;
    }
    
    $.getJSON('getIncomeByBudgetCode/'+incomeId, {}, function(data) {
    		   $('#accountList').css('display', 'block');
        	   $('#accountList').find("a").remove();
        	   $.each(data, function(index,value){
        		   
						var id = $.trim(index);
						var account = $.trim(value);
						$('#accountList').append("<a href='#' onclick='setAccountValue(\"" + account + "\", \"" + id + "\")'>" + account+"</a>");
					}
				);
    	}
    );
}

