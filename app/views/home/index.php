<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="public/assets/bootstrap-rating-input.min.js"></script>
</head>
<body>
<?php
include 'app/controllers/cart.php';
$Cart = new Cart();

// including template files
include 'app/views/navbar/navbar.php';
include 'app/views/home/products.php';
include 'app/views/modals/login.php';
include 'app/views/modals/register.php';
include 'app/views/modals/cart.php';
?>
</body>
<script type="text/javascript" src="public/assets/main.js?v=<?php echo filemtime('public/assets/main.js') ?>"></script>
</html>
