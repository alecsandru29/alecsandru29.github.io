
function myFunctionn() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInputt");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelpublic");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
var x1=1;
function adaugare()
	{
		if (x1 == 1)
		{
			document.getElementById("adaugare").style.opacity = "1";
			document.getElementById("adaugare").style.visibility = "visible";
			x1=0;
		}
		else
		{
			document.getElementById("adaugare").style.opacity = "0";
			document.getElementById("adaugare").style.visibility = "hidden";
			x1=1;
		}
	}
function myDelete()
{
	
	id=document.getElementById("delete").value;
	var txt='Esti sigur ca vrei sa stergi elementul cu id-ul '+id+'?';
	var r = confirm(txt);
	if (r == true)
		 window.location.href='http://localhost/DulApp/delete.php?id='+id;
}
var test=1;	
function obiect(id)
{
	var txt="id"+id;
	var afis=document.getElementById(txt).value;
	if (test==1)
	{
		document.getElementById("id").style.visibility = "visible";
		document.getElementById(txt).style.visibility = "visible"; 
		test =0;
		last=txt;
	}
	else
	{ 	
		document.getElementById("id").style.visibility = "hidden"; 
		document.getElementById(txt).style.visibility = "hidden"; 
		test=1;
	}
	//window.alert(txt);
}
function Confirmare() 
{
    if (confirm("Esti sigur ca vrei sa stergi contul?") == true) {
        window.location.href='http://localhost/DulApp/editare3.php'
    } 
}