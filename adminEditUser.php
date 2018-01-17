<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <?Php
    session_start();
    include 'conn.php';
    $users = "SELECT * FROM users";
    $usersResult = mysqli_query($conn, $users);
    $populate = "SELECT * from users WHERE studentID=''";
    $populating = mysqli_query($conn, $populate);
    ?>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="gallery.php">Gallery</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!isset($_SESSION['Firstname']))
                {
                    ?>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php
                }
                else if (isset($_SESSION['Firstname']) && ($_SESSION['Role'] == "Member"))
                {
                    ?>
                    <p class="navbar-text"><?php echo "Welcome " . $_SESSION['Firstname'] . "!"; ?></p>
                    <li><a href="userProfile.php">Profile</a></li>
                    <li><a href="signOut.php">Logout</a></li>
                    <?php
                }
                else if (isset($_SESSION['Firstname']) && ($_SESSION['Role'] == "Admin"))
                {
                    ?>
                    <p class="navbar-text"><?php echo "Welcome " . $_SESSION['Firstname'] . "! (Admin)"; ?></p>
                    <li><a href="adminPanel.php">Admin Panel</a></li>
                    <li><a href="adminProfile.php">Profile</a></li>
                    <li><a href="signOut.php">Logout</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-sm-8 text-left">
            <h1>Account Management</h1>
            <hr>
        </div>
        <div class="col-sm-2 ">
        </div>
    </div>
</div>
<div class="container">
    <h3>Edit Account</h3>
    <hr>
    <div class="row">
        <div class="col-sm-3">
                <?php
                echo "<select name='studentID'>";
                while ($row = mysqli_fetch_array($usersResult)) {
                    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                }
                echo "</select>";
                ?>
            <br>
            <span id="reauth-email" class="reauth-email"></span>
            <br>
            <input type="text" name="studentID" id="inputFname" class="form-control" placeholder="<?php echo $row[1]?>" required autofocus>
            <br>
            <input type="email" name="studentEmail" id="inputEmail" class="form-control" placeholder="Student email" required autofocus>
            <br>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <br>
            <input type="text" name="firstname" id="inputFname" class="form-control" placeholder="Firstname" required autofocus>
            <br>
            <input type="text" name="lastname" id="inputLname" class="form-control" placeholder="Lastname" required autofocus>
            <br>
            <input type="text" name="info" id="inputInfo" class="form-control" placeholder="Info" required autofocus>
            <br>
            <input type="text" name="role" id="inputRole" class="form-control" placeholder="Role" required autofocus>
            <br>
            <button class="btn btn-lg btn-primary btn-block btn-contact" type="submit" value="Send" onclick="myFunction()">Send</button>
        </div>
        <div class="col-sm-3">

        </div>
    </div>
</div><br>
<div class="container">
    <h3>Delete Account</h3>
    <hr>
    <div class="row">
        <div class="col-sm-3">
            <br>
            <form class="form-deleteUser" action="deleteUser.php" method="post">
            <input type="text" name="studentID" id="input" class="form-control" placeholder="Enter student ID to delete" required autofocus>
            <br>
            <button class="btn btn-lg btn-primary btn-block btn-contact" type="submit" value="Send" id="Authorisation">Delete</button>
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Authorisation Required</h2>
                    </div>
                    <div class="modal-body">
                        <input type="password" name="password" id="input" class="form-control" placeholder="Enter password to confirm action!" required autofocus>
                    </div>
                    <div class="modal-footer">
                        <button>Confirm</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div><br>
<footer class="container-fluid text-center">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("Authorisation");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</footer>

</body>
</html>
