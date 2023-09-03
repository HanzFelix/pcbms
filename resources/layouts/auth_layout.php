<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/auth.php";
requireLogin(false);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?> - VSU PCBMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" /-->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        txt: '#072227',
                        shade: '#eefafc',
                        primary: '#449748',
                        secondary: '#d3f3f8',
                        accent: '#384470',
                    }
                }
            }
        }
    </script>
    <link rel="icon" href="/public/img/vsulogo.ico" />
</head>

<body class="bg-shade text-txt">
    <?php echo $content; ?>
    <?php echo $error; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>