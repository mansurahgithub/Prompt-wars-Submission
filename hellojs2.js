function openPopup(type) {
    document.getElementById('overlay').style.display = 'block';
    // Close any other popups if open
    closeAllPopups();

    if (type === 'distributor') {
        document.getElementById('distributor').style.display = 'block'; // Show the distributor form
    } else {
        document.getElementById('signup').style.display = 'block'; // Default to user signup form
    }
}

function closePopup() {
    document.getElementById('overlay').style.display = 'none';
    closeAllPopups();
}

function closeAllPopups() {
    document.getElementById('signup').style.display = 'none';
    document.getElementById('signIn').style.display = 'none';
    document.getElementById('distributor').style.display = 'none';
}
// your existing popup + toggle functions here…
function createSnowflakes() {
  const SNOW_COUNT = 500;
  const LIFT = 20; // vh above start
  // Calculate rows/cols for a roughly square grid:
  const cols = Math.ceil(Math.sqrt(SNOW_COUNT));
  const rows = Math.ceil(SNOW_COUNT / cols);

  // Now compute the exact step between flakes:
  // (if you have N columns, there are N‑1 gaps, so step = 100/(N‑1))
  const hStep = cols > 1 ? 100 / (cols - 1) : 100;
  const vStep = rows > 1 ? 100 / (rows - 1) : 100;

  let created = 0;
  for (let r = 0; r < rows; r++) {
    for (let c = 0; c < cols; c++) {
      if (created++ >= SNOW_COUNT) return;

      const flake = document.createElement('div');
      flake.classList.add('snowflake');
      
      // Position at (c * hStep, r * vStep), then lift up by LIFT:
      flake.style.left = c * hStep + 'vw';
      flake.style.top  = (r * vStep - LIFT) + 'vh';

      // Randomize fall timing:
      const duration = 20 + Math.random() * 20;
      flake.style.animationName     = 'fall';
      flake.style.animationDuration = duration + 's';
      flake.style.animationDelay    = -(Math.random() * duration) + 's';

      document.body.appendChild(flake);
    }
  }
}

createSnowflakes();


// Option B: wait for DOM ready (if you prefer)
document.addEventListener('DOMContentLoaded', createSnowflakes);

function toggleForms(type) {
    const signUpForm = document.getElementById('signup');
    const signInForm = document.getElementById('signIn');
    const distributorSignUpForm = document.getElementById('distributor'); // Distributor form

    if (type === 'user') {
        // Toggle between user Sign Up and Sign In
        if (signUpForm.style.display === 'none') {
            signUpForm.style.display = 'block';
            signInForm.style.display = 'none';
        } else {
            signUpForm.style.display = 'none';
            signInForm.style.display = 'block';
        }
    } else if (type === 'distributor') {
        // Toggle between distributor Sign Up and Sign In
        const distributorSignInForm = distributorSignUpForm.querySelector('.distributor-signin');
        const distributorSignUpInnerForm = distributorSignUpForm.querySelector('.distributor-signup');
        
        if (distributorSignUpInnerForm.style.display === 'none') {
            distributorSignUpInnerForm.style.display = 'block';
            distributorSignInForm.style.display = 'none';
        } else {
            distributorSignUpInnerForm.style.display = 'none';
            distributorSignInForm.style.display = 'block';
        }
    }
}