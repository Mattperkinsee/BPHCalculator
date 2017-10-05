/*global onSignIn*/ 
/*global $*/
/*global document, jAlert*/ 
 /*exported onSignIn */

function onSignIn(googleUser) {
       // Useful data for your client-side scripts:
       var profile = googleUser.getBasicProfile();
       console.log("ID: " + profile.getId()); // Don't send this directly to your server!
       console.log('Full Name: ' + profile.getName());
       console.log('Given Name: ' + profile.getGivenName());
       console.log('Family Name: ' + profile.getFamilyName());
       console.log("Image URL: " + profile.getImageUrl());
       console.log("Email: " + profile.getEmail());
       
       
       document.getElementById("gName").innerHTML = profile.getName();
       document.getElementById("gPic").src = profile.getImageUrl();

       // The ID token you need to pass to your backend:
       var id_token = googleUser.getAuthResponse().id_token;
       console.log("ID Token: " + id_token);
        document.getElementById("source3").value = profile.getId();
        document.getElementById("source1").value = profile.getId();
    

    
           
};

$.ajax({
              type: "POST",
              url: "BPHCalcEnter.php",
              data: {lastName: "Hello"},
               
               success: function (data) {
                
                //   setTimeout(function (){
             //   $(".container").html('').html(data)
              //  }, 1000);
               }
         
       
   });
                