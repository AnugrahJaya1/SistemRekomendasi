<!doctype html>
<html>

    <head>
    </head>

    <body>
        <h1>Login</h1>
        <form action='/login' method='post'>
            @csrf
            <input type="text" name="user">
            <input type="password" name="pass">
            <button type="submit">Submit</button>
        </form>
    </body>
</html>