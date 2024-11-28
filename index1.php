
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* Background */
        body {
            background: url('loml.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: #fff;
        }

        /* Form Container */
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 22px;
            padding: 1rem 2rem;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Title Styling */
        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        /* Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 1.8rem;
            width: 100%;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        input::placeholder {
            color: transparent;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(110, 142, 251, 0.6);
        }

        input:focus ~ i {
            color: #6e8efb;
        }

        label {
            position: absolute;
            top: 50%;
            left: 45px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.3s ease;
             text-transform: capitalize;
        }

        input:focus ~ label,
        input:not(:placeholder-shown) ~ label {
            top: 0px;
            font-size: 0.85rem;
           background: linear-gradient(150deg, purple, royalblue, grey);
            padding: 4px 5px;
            border-radius: 5px;
            color: white;
            
        }


        /* Buttons */
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(140deg, #6e8efb, #a777e3);
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(110, 142, 251, 0.3);
        }

        .btn:hover {
            background: linear-gradient(135deg, #5a6fdc, #8a5fdb);
            transform: translateY(-3px);
            animation: lover 1s ease-in-out infinite;
            overflow: hidden;
            
        }

        /* Links */
        .links {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;

        }

        .links button {
            color: #6e8efb;
            background: transparent;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            transition: color 0.3s ease;

        }

        .links button:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 2rem 1.5rem;
            }

            .form-title {
                font-size: 2rem;
            }

            input {
                padding: 12px 12px 12px 40px;
            }

            label {
                font-size: 0.85rem;
            }
        }
        #mol{
            height: 120px;
            width: 120px;
            margin-top: -15px;
            animation: toy .9s ;
           

        }
        
       
        @keyframes toy{
            from{
                opacity: 0;
                transform: translateY(-100px);
                 
            }
            to{
                opacity: 1;
                transform: translateY(0px);
                
            }
        }
    </style>
</head>
<body>
    <div class="container" id="signup" style="display: none;">
         <center>
        <img src="galilee-removebg-preview.png" id="mol" title="Galilee Academy">
        </center>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="firstName" id="fName" required placeholder="First Name">
                <label for="fName">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lastName" id="lName" required placeholder="Last Name">
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" required placeholder="Email">
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" required placeholder="Password">
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <div class="links">
            <button id="signInButton">Sign In</button>
        </div>
    </div>
    <div class="container" id="signIn">
        <center>
        <img src="galilee-removebg-preview.png" id="mol">
        </center>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="emailSignIn" required placeholder="Email">
                <label for="emailSignIn">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="passwordSignIn" required placeholder="Password">
                <label for="passwordSignIn">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <div class="links">
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUpButton');
        const signInButton = document.getElementById('signInButton');
        const signInForm = document.getElementById('signIn');
        const signUpForm = document.getElementById('signup');

        signUpButton.addEventListener('click', function () {
            signInForm.style.display = "none";
            signUpForm.style.display = "block";
        });

        signInButton.addEventListener('click', function () {
            signInForm.style.display = "block";
            signUpForm.style.display = "none";
        });
    </script>
</body>
</html>
