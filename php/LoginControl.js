function validateuid()
{   
    var uid = document.getElementById("uid").value;
    if (uid=="")
    {
    document.getElementById("uidErr").innerHTML="**Enter your User ID**";
    }
   
    else if(uid==" ")
    {
    document.getElementById("uidErr").innerHTML="";
    }

 

}

 

function validatepass()
{   
    var pass1 = document.getElementById("pass1").value;
    if (pass1=="")
    {
    document.getElementById("passErr").innerHTML="**Enter your password**";
    }
    else if (pass1==" ")
    {
    document.getElementById("passErr").innerHTML="";
    }
 
}

 

function validation()
{
   
    var uid = document.getElementById("uid").value;
    var pass1 = document.getElementById("pass1").value;

 

    if (uid=="" || pass1=="")
     {
    
     alert("please Fill up the form ");

 

     }
     else {return true;}

 


}


  