<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Adoption Platform</title>
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: teal;
            border-bottom: 5px solid black;
        }
        .logo {
            width: 60px;
            height: auto;
        }
        .navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: none;
            flex-grow: 2; 
        }
        .navigation li {
            display: inline-block;
            margin-right: 5px;
            padding: 5px;
        }
        .navigation li:last-child {
            margin-right: 0;
        }
        .navigation li a {
            text-decoration: none;
            color: white; /* Changed color to white */
        }
        .dropdown-contents {
            display: none;
            position: absolute;
            background-color: none;
            text-decoration: none;
        }
        .dropdown-contents a {
            color: black;
            text-decoration: none;
            display: block;
        }
        .dropdown-contents a:hover {
            background-color: red;
        }
        .dropdown:hover .dropdown-contents {
            display: block;
        }
        .welcome-message {
            text-align: center;
            margin-top: 50px;
            font-size: 24px;
        }
        .platform-features {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
        }
        .platform-features ul {
            list-style: none;
            padding: 0;
        }
        .platform-features li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <img class="logo" src="tt.png" alt="Logo">
    <h3 style="color: white;"><i>PETS ADOPTION PLATFORM</i></h3>
    <ul class="navigation">
        <li><a href="home.html">Home</a></li>
        <li><a href="aboutus.html">About Us</a></li>
        <li><a href="contactus.html">Contact Us</a></li>
        <li class="dropdown">
           <a href="#">Forms</a>
            <div class="dropdown-contents">
                <a href="employee.php">Employee</a>
                <a href="attendance.php">Attendance</a>
                <a href="holiday.php">Holiday</a>
                <a href="Notification.php">Notification</a>
                <a href="permission.php">Notification</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Tables</a>
            <div class="dropdown-contents">
                <a href="employeetable.php">Employee</a>
                <a href="attendtable.php">Attendance</a>
                <a href="holtable.php">Holiday</a>
                <a href="Notiftable.php">Notification</a>
                <a href="permtable.php">Notification</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Settings</a>
            <div class="dropdown-contents">
                <a href="adminlogin.php">Admin</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>

<div class="welcome-message">
    <h1>Welcome to the Pet Adoption Platform!</h1>
    <p>Find your new furry friend today.</p>
</div>

<div class="platform-features">
    <h2>What Our Platform Offers:</h2>
    <ul>
        <li>Search and browse pets available for adoption</li>
        <li>Submit adoption applications for pets</li>
        <li>Host and discover pet adoption events</li>
        <li>Connect with shelters and rescue organizations</li>
        <li>Leave reviews and ratings for pets and shelters</li>
    </ul>
</div>

<footer style="background-color: teal; text-align: center; width: 100%; height: 90px; color: white; font-size: 25px; margin-top: 20px; bottom: 0; left: 0;">
    <p>Designed by Aimee Diane KUBWIMANA_222002776 &copy; YEAR TWO BIT GROUP A &reg; 2024</p>
</footer>
</body>
</html>