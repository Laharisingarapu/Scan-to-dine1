function validateForm() {
    // Get form elements
    const name = document.getElementById("fullname").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
  
    // Regular expressions for validation
    const nameRegex = /^[a-zA-Z\s]+$/;
    const emailRegex = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!*%?&])[A-Za-z\d@.#$!%*?&]{8,}$/;
  
    // Validation messages
    let errors = [];
  
    // Name validation
    if (name === "" || !nameRegex.test(name)) {
      errors.push("Please enter a valid name.");
    }
  
    // Email validation
    if (email === "" || !emailRegex.test(email)) {
      errors.push("Please enter a valid email address.");
    }
  
    // Password validation
    if (password === "" || !passwordRegex.test(password)) {
      errors.push("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
    }
  
    // Confirm password validation
    if (confirmPassword === "" || confirmPassword !== password) {
      errors.push("Passwords do not match.");
    }
  
    // Display error messages
    if (errors.length > 0) {
      let errorMessage = "";
      for (let i = 0; i < errors.length; i++) {
        errorMessage += errors[i] + "<br>";
      }
      alert(errorMessage);
      return false; // Prevent form submission
    } else {
      // Form is valid, submit it
      return true;
    }
  }
  