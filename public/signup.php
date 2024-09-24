<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/sign-up.css" />
    <link rel="stylesheet" href="../CSS/header.css" />
    <link rel="stylesheet" href="../CSS/footer.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Sign Up</title>
  </head>

  <body>
    <?php include 'layout/header.php'; ?>
    <section id="sign-up-section">
      <form action="log.php" method="POST">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>

        <label for="firstName">First Name:</label>
        <input
          type="text"
          placeholder="First Name"
          required
          id="first-name"
          name="firstName"
        />

        <label for="lastName">Last Name:</label>
        <input
          type="text"
          placeholder="Last Name"
          required
          id="last-name"
          name="lastName"
        />

        <label for="emailAddress">Email Address:</label>
        <input
          type="email"
          placeholder="Email Address"
          required
          id="email-address"
          name="emailAddress"
        />

        <label for="password">Password:</label>
        <input
          type="password"
          placeholder="Password"
          required
          id="password"
          name="password"
        />

        <label for="confirmPassword">Confirm Password:</label>
        <input
          type="password"
          placeholder="Confirm Password"
          required
          id="confirm-password"
          name="confirmPassword"
        />

        <label for="phoneNumber">Phone Number:</label>
        <input
          type="tel"
          placeholder="Phone Number"
          required
          id="phone-number"
          name="phoneNumber"
        />

        <div class="col-sm-6 mb-3">
          <label class="form-label">Region *</label>
          <select
            name="region"
            class="form-control form-control-md"
            id="region"
          ></select>
          <input
            type="hidden"
            class="form-control form-control-md"
            name="region_text"
            id="region-text"
            required
          />
        </div>
        <div class="">
          <label class="form-label">Province *</label>
          <select
            name="province"
            class="form-control form-control-md"
            id="province"
          ></select>
          <input
            type="hidden"
            class="form-control form-control-md"
            name="province_text"
            id="province-text"
            required
          />
        </div>
        <div class="">
          <label class="form-label">City / Municipality *</label>
          <select
            name="city"
            class="form-control form-control-md"
            id="city"
          ></select>
          <input
            type="hidden"
            class="form-control form-control-md"
            name="city_text"
            id="city-text"
            required
          />
        </div>
        <div class="">
          <label class="form-label">Barangay *</label>
          <select
            name="barangay"
            class="form-control form-control-md"
            id="barangay"
          ></select>
          <input
            type="hidden"
            class="form-control form-control-md"
            name="barangay_text"
            id="barangay-text"
            required
          />
        </div>
        <div class="">
          <label for="street-text" class="form-label">Street (Optional)</label>
          <input
            type="text"
            class="form-control form-control-md"
            name="street_text"
            id="street-text"
          />
        </div>

        <button type="submit">Sign Up</button>

        <div class="quote-container">
          <p id="register-quote">
            Already have an account? <a href="login.php">Login instead!</a>
          </p>
        </div>
      </form>
    </section>
    <?php include 'layout/footer.php'; ?>
  </body>
  <script src="JS/header_loader.js"></script>
  <script src="JS/footer_loader.js"></script>
  <script src="JS/ph-address-selector.js"></script>
</html>
<!-- Added -->