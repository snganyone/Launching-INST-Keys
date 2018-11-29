<script>
//Dropdown Menu
$('.dropdown-toggle').dropdown();
//Search filter
  function filter(){
    var input, filter, table, tr, td, x, q;
      input = document.getElementById("input");
      filter = input.value;
      table = document.getElementById("table");
      tr = table.getElementsByTagName("tr");

      //Loop through all the table rows, and hide those that do not match the search query
      for(x = 0; x < tr.length; x++){
        f = tr[x].getElementsByTagName("td"); //Table filter
        if(f[1]){
          if(f[1].innerHTML.indexOf(filter) > -1 || f[2].innerHTML.indexOf(filter) > -1
              || f[3].innerHTML.indexOf(filter) > -1 || f[4].innerHTML.indexOf(filter) > -1
              || f[5].innerHTML.indexOf(filter) > -1){
            tr[x].style.display = "";
          }
          else{
            tr[x].style.display = "none";
          }
        }
        }
      }
$(document).ready(function(){
  filter();
}); //Waits until DOM elements are loaded and ready to execute
</script>
