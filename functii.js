function myFunction1() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelpersonal1");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
function myFunction2() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelpersonal2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
function myFunction3() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelpersonal3");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
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
function myDelete(id)
{
	
	id=document.getElementById("delete").value;
	var txt='Esti sigur ca vrei sa stergi elementul cu id-ul '+id+'?';
	var r = confirm(txt);
	if (r == true) {
		x = "Da";
		 window.location.href='http://localhost/DulApp/delete.php?id='+id;
	} else {
		x = "Nu";
	}
}
function Confirmare() 
{
    if (confirm("Esti sigur ca vrei sa stergi contul?") == true) {
        window.location.href='http://localhost/DulApp/editare3.php'
    } 
}

function AdaugareOb()
{
	var nume = document.getElementById("nume").value;
    var valoare = document.getElementById("valoare").value;
    var material = document.getElementById("material").value;
	var culoare = document.getElementById("culoare").value;
	var descriere = document.getElementById("descriere").value;
	var categorie = document.getElementById("categorie").value;
	var dulap = document.getElementById("dulap").value;
    submitOK = "true";
}