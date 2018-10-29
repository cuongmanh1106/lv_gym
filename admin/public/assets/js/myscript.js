function check_delete(){
	if(confirm("Are you sure? your data can not be restore")){
		return true;
	}
	return false;
}
function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode;
       // if(charCode == 59 || charCode == 46)
       //  return true;
       if (charCode < 48 || charCode > 57)
          return false;
       return true;
    }
// call onkeypress="return isNumberKey(event)"


function formatNumber(nStr, decSeperate, groupSeperate) {
    //decSeperate= ki tu cach,groupSeperate= ki tu noi
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}

function formatNumBerKeyUp(id_input)
{
    key="";
    money=$(id_input).val().replace(/[^\-\d\.]/g, '');
    // a=money.split(".");
    // $.each(a , function (index, value){
    //     key=key+value;
    // });
    $(id_input).val(formatNumber(money, '.', ','));
}


function formatInputNumBerKeyUp(id_input)
{
    money=$(id_input).val().replace(/[^\-\d\.]/g, '');
    $(id_input).val(money);
}

$(".alert").delay(3000).slideUp();

