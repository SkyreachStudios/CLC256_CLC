<!DOCTYPE html>
<head>

</head>
<body>
<form action = "dologin" method = "POST">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    <h2> Login</h2>
    <table>
        <tr>
            <td>Username: </td>
            <td><input type = "text" name = "username" /></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type = "password" name = "password" /></td>
        </tr>
        <tr>
            <td colspan = "2" align = "center">S
                <input type = "submit" value = "Login" />
            </td>
    </table>
</form>

</body>
