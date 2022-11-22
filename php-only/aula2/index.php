<!DOCTYPE html>

<html language="en">
    <head>
        <title>Aula 2</title>
        <link rel="stylesheet" href="./style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <header>
            <nav>
                <ul >
                    <li class="mr">Home</li>
                    <li class="mr">About</li>
                    <li class="mr">Contact us</li>
                </ul>
            </nav>
        </header>

    </head>

    <body>
        
        <div class="border login-box">
            <form action="aula2.php" method="POST"  >
                <label class="uppercase" for="error"> 
                    <?php
                        if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        }
                
                    ?>
                
                </label>
                <label class="uppercase width-100" for="">Username</label><br>
                <input class="" type="text" name="username" value="" placeholder="Username" /><br>
                <label class="uppercase" for="">Password</label><br>
                <input type="password" name="password" value="" placeholder="password"><br>
                <button class="" type="submit">Login</button>
            </form>
        </div>




        <footer>

        </footer>
    </body>
</html>

