<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../View/css/styles.css">
</head>

<body>
  <div class="outer-box">
    <div class="inner-box">
      <header class="signup-header">
        <h1>Login</h1>
      </header>
      <main class="signup-body">
        <?php
         if ($msg!='') {
            ?>
            <p class=<?=$cls?>><?=$msg?></p>
            <?php
          }
        ?>
        <form action="/" method="post">
          <p>
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email_id" placeholder="souravchandra@gmail.com" required>
          </p>
          <p>
            <label for="password">Enter Your Password</label>
            <input type="password" id="password" name="password" placeholder="at least 8 characters" required>
          </p>
          <p>
            <input type="submit" id="submit" name="submit" value="Login">
          </p>
        </form>
      </main>
      <footer class="signup-footer">
        <p>Don't have an Account? <a href="/register">signup</a></p>
        <p>Forgetten Password? <a href="/reset">Resetpassword</a> </p>
      </footer>
    </div>
    <div class="circle c1"></div>
    <div class="circle c2"></div>
  </div>
</body>

</html>
