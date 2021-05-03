<form action="/authenticate" method="post">
    @csrf
    <input type="text" name="login" id="">
    <input type="password" name="password" id="">
    <input type="submit" value="enviar">
</form>