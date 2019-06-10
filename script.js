var common_status, sde_status, path;
common_status = false;
sde_status = false;
path;

// Getting the absolute path
if (window.location.hostname === "localhost") {
  path = 'http://localhost:8888/Metadata/'
} else {
  path = window.location.hostname;
}



//Getting value from "ajax.php".
function fill(Value) {
   //Assigning value to "search" div in "navbar.php" file.
   $('#searchbar').val(Value);
   $('#searchbar-form').submit();
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}


//  Create button for import metadata page
function create_button() {
  // If common name and sde name is both unique then the create button would be enabled
  if(common_status === true && sde_status === true) {
    document.getElementById("create_dataset").disabled = false;
  // Else it would be disabled
  } else {
    document.getElementById("create_dataset").disabled = true;
  }
}



$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13 && (common_status === false || sde_status === false)) {
      event.preventDefault();
      return false;
    }
  });
   //On pressing a key on "Search" in "navbar.php" file. This function will be called.
   $("#searchbar").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#searchbar').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
       }

       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: path + "/ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });




   //On pressing a key on "Search" in "Main.php" file. This function will be called.
   $("#dataset_name").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#dataset_name').val();
       //Validating, if "name" is empty.
       if (name == "") {
         //AJAX is called.
         $.ajax({
             //AJAX type is "Post".
             type: "POST",
             //Data will be sent to "ajax.php".
             url: path + "/ajax.php",
             //Data, that will be sent to "ajax.php".
             data: {
                 //Assigning value of "name" into "search" variable.
                 filter_search_blank: name
             },
             //If result found, this funtion will be called.
             success: function(html) {
                 //Assigning result to "right-div" div in "Main.php" file.
                 $("#right-div").html(html).show();
             }
         });
       }

       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: path + "/ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   filter_search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "right-div" div in "Main.php" file.
                   $("#right-div").html(html).show();
               }
           });
       }
   });







   //On pressing a key on "common name" in "import_metadata.php" file. This function will be called.
   $("#commonName").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#commonName').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           document.getElementById("commonName").classList.remove("error");
           document.getElementById("commonName").classList.remove("success");
           common_status = false;
           create_button();
       }

       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: path + "/ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "common" variable.
                   common: name
               }
           }).done(function(common) {
               common_normalize = (JSON.stringify(common)).toLowerCase();
               name_normalize = (JSON.stringify(name)).toLowerCase();
                 if ((common_normalize).trim() === (name_normalize).trim()) {
                   document.getElementById("commonName").classList.add("error");
                   document.getElementById("commonName").classList.remove("success");
                   common_status = false;
                   create_button();
                 }
                 else {
                   document.getElementById("commonName").classList.add("success");
                   document.getElementById("commonName").classList.remove("error");
                   common_status = true;
                   create_button();
                 }



           })
       }
   });





   //On pressing a key on "sde name" in "import_metadata.php" file. This function will be called.
   $("#sdeName").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#sdeName').val();
       var first_Char = parseInt(name.charAt(0));
       //Validating, if "name" is empty.
       if (name === "") {
           //Assigning empty value to "display" div in "search.php" file.
           document.getElementById("sdeName").classList.remove("success");
           document.getElementById("sdeName").classList.remove("error");
           sde_status = false;
           create_button();
       } else if(!isNaN(first_Char)) {
           document.getElementById("sdeName").classList.add("error");
           document.getElementById("sdeName").classList.remove("success");
           sde_status = false;
           create_button();
       //If name is not empty.
       } else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: path + "/ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "sde" variable.
                   sde: name
               }
           }).done(function(sde) {
               common_normalize = (JSON.stringify(sde)).toLowerCase();
               name_normalize = (JSON.stringify(name)).toLowerCase();
                 if ((common_normalize).trim() === (name_normalize).trim()) {
                   document.getElementById("sdeName").classList.add("error");
                   document.getElementById("sdeName").classList.remove("success");
                   sde_status = false;
                   create_button()
                 }
                 else {
                   document.getElementById("sdeName").classList.add("success");
                   document.getElementById("sdeName").classList.remove("error");
                   sde_status = true;
                   create_button()
                 }



           })
       }
   });



   $("#deleteData").click(function() {
     var commonName = $('#common-name-delete').text();
     var sdeName = $('#sde-name-delete').val();
     var readmeID = $('#readme-id').val();
     if(confirm("Are you sure you want to delete this dataset?")) {
       //AJAX is called.
       $.ajax({
           //AJAX type is "Post".
           type: "POST",
           //Data will be sent to "ajax.php".
           url: path + "/ajax.php",
           //Data, that will be sent to "ajax.php".
           data: {
               //Assigning values into variables.
               deleteCommon: commonName,
               deleteSde: sdeName,
               deleteID: readmeID

           },
           //After query runs redirect to main page.
           success: function() {
               window.location.replace("Main.php");
           }
       });
     }

   });


   // $("#addRow").click(function() {
   //   var sdeName = $('#sde_name_underscore').val();
   //
   //   //AJAX is called.
   //   $.ajax({
   //       //AJAX type is "Post".
   //       type: "POST",
   //       //Data will be sent to "ajax.php".
   //       url: "ajax.php",
   //       //Data, that will be sent to "ajax.php".
   //       data: {
   //           //Assigning values into variables.
   //           addSde: sdeName
   //       },
   //       //After query runs redirect to main page.
   //       success: function(i) {
   //         // var para = "edit" + i;
   //         // var editbtn = document.getElementById(para);
   //         // var savebtn = document.getElementById("save" + para);
   //         // var allClasses = document.getElementsByClassName("text" + para);
   //         //
   //         // console.log(editbtn.value)
   //
   //       }
   //   });
   //
   //
   // });



console.log(window.location.href);



});
