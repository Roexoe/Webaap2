<!DOCTYPE html>
<html>
<head>
    <title>Registratie</title>
</head>
<body>
    <form action="register.php" method="post">
        <div>
            <label>Voornaam:</label>
            <input type="text" name="Voornaam" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Wachtwoord:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <button type="submit">Registreer</button>
        </div>
    </form>
</body>
</html>