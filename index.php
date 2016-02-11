<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="fornax-template/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="fornax-template/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="fornax-template/css/style.css"/>

    <script type="text/javascript" src="fornax-template/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fornax-template/js/html5shiv.js"></script>
    <script type="text/javascript" src="fornax-template/js/jquery.js"></script>
    <script type="text/javascript" src="resources/js/service/request.js"></script>

    <meta charset="UTF-8">
    <title>Speed Food</title>

    <script type="text/javascript">
        console.log("aaaa");
        var response = request().get("testRestfulService");
        response.success(function(data){
            document.write(data);
        });
    </script>

</head>
<body>



</body>
</html>