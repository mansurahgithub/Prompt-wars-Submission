
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> -->
    <link rel="stylesheet" href="hello.css">
</head>
<body>
  <!-- Main Content -->
  <a href="javascript:void(0);" onclick="openPopup()" class="user-icon">
        <img src="user.png" alt="User Icon" />
    </a>
  <div class="html">
    <img src="icon.png" class="logo">
    <h1 class="heading">FoodBridge</h1>
    <p class="tagline">Connecting Plates,Saving Lives❤</p>
    <div class="button-container">

        <button class="btn" onclick="openPopup('distributor')">Jedi Gatekeeper Login</button><br>
        <br>

        <button class="donbtn" onclick="openPopup('user')">Jedi Initiate Login</button>

    </div>
    </div>
    
    <!-- Overlay Background -->
    <div class="overlay" id="overlay" onclick="closePopup()"></div>
    
    <div class="container" id="signup" style="display:none;">
    <i class="fas fa-times close-icon" onclick="closePopup()"></i>
      <h1 class="form-title">Register</h1>
      <form method="post" action="hellor.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="fName" id="fName" placeholder="First Name" required>
           <label for="fname">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
       <input type="submit" class="rbtn" value="Sign Up" name="signUp">
       <br><br>
       <button id="signInButton" class="togLogin" onclick="toggleForms('user')">Sign In</button>


      </form>
      <p class="or">or</p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
      </div>
     
    </div>

    <div class="container" id="signIn" style="display:none;">
    <i class="fas fa-times close-icon" onclick="closePopup()"></i>
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="hellor.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
          <p class="recover"><a href="#">Recover Password</a></p>
         <input type="submit" class="rbtn" value="Sign In" name="signIn">
         <br><br>
         <button id="signUpButton" class="togLogin" onclick="toggleForms('user')">Register</button>
        </form>
        <p class="or">or</p>
        <div class="icons">
          <i class="fab fa-google"></i>
          <i class="fab fa-facebook"></i>
        </div>
        
      </div>
      

   <!-- Distributor Registration and Login Form -->
   <div class="container" id="distributor" style="display:none;">
    <i class="fas fa-times close-icon" onclick="closePopup()"></i>
        
        
        <!-- Distributor Registration -->
        <div class="distributor-signup">

        <h1 class="form-title">Register as Distributor</h1>
        <form method="post" action="hellodistributor.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Name" required>
                <label>Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="text" name="contact" placeholder="Contact Number" required>
                <label>Contact Number</label>
            </div>
            <div class="input-group">
                <i class="fas fa-id-badge"></i>
                <input type="text" name="employee_id" placeholder="Employee ID" required>
                <label>Employee ID</label>
            </div>
            <div class="input-group">
                <i class="fas fa-id-card"></i>
                <input type="text" name="aadhar" placeholder="Aadhaar Number" required>
                <label>Aadhaar Number</label>
            </div>
            <div class="input-group">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" name="collection_site" placeholder="Collection Site Address" required>
                <label>Collection Site Address</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="pin" placeholder="Create PIN" required>
                <label>Create PIN</label>
            </div>
      
            <input type="submit" class="rbtn" value="Register Distributor" name="register_distributor">
                  
                       <!-- Distributor Login Button -->
<button class="togLogin" id="distributorSignInButton" onclick="toggleForms('distributor')">Login as Distributor</button>
        </form>
        </div>
        <!-- Distributor Login -->
        <div class="distributor-signin" style="display:none;">

        <h1 class="form-title">Login as Distributor</h1>
        <form method="post" action="hellodistributor.php">
            <div class="input-group">
                <i class="fas fa-id-card"></i>
                <input type="text" name="aadhar" placeholder="Aadhaar Number" required>
                <label>Aadhaar Number</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="pin" placeholder="PIN" required>
                <label>PIN</label>
            </div>
 
            <input type="submit" class="rbtn" value="Login Distributor" name="login_distributor">
            <!-- Distributor Sign Up Button -->
<button id="distributorSignUpButton" class="togLogin"onclick="toggleForms('distributor')">Register as Distributor</button>



        </form>
        </div>
    </div>
  
    <script src="hellojs2.js">
    </script>
 
</body>
</html>