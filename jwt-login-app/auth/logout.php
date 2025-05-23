<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <script>
        // Clear localStorage and redirect to home
        localStorage.removeItem("token");
        localStorage.removeItem("email");
        localStorage.removeItem("user_id"); // optional, in case used
        window.location.href = "../../../index.php";
    </script>
</head>
<body>
</body>
</html>
