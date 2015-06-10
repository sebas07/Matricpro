<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) echo $title?></title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=base_url()?>assets/css/mystyle.css" rel="stylesheet" type="text/css" />
    <style>
        .nav{
            list-style:none;
            margin:0;
            padding:0;
            text-align:center;
        }
        .nav li{
            display:inline;
        }
        .nav li a{
            display:inline-block;
            width: 120px;
            padding:10px;
        }
        .nav li a:hover{
            background-color: darkgray;
            color: #FFFFFF;
            border-radius: 5px;
        }
    </style>
</head>

