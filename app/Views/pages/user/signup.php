<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Signup<?= $this->endSection() ?>

<?= $this->section("content") ?>

<!--ring div starts here-->
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<div class="container">
  <div class="form-container">
    <div class="login">
    <?= form_open('/signup') ?>
        <h2>Sign Up</h2>
        <div class="inputBx">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="inputBx">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="inputBx">
        <label for="email" class="form-label">Student Number</label>
        <input type="text" class="form-control" name="student_number" id="student_number">
        </div>
        <div class="inputBx">
        <label for="email" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="full_name" id="full_name">
        </div>
        <div class="inputBx">
        <label for="email" class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phone_number" id="phone_number">
        </div>
        <div class="inputBx">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="inputBx">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirm-password" id="confirm-password">
        </div>
        <div class="inputBx">
          <input type="submit" value="Sign Up">
        </div>
        <div class="links">
          <a href="#">Login</a>
        </div>
      </form>
    </div>
  </div>
  <div class="gap"></div>
  <div class="logo-container">
    <div class="ring">
      <div class="logo-wrapper">
        <img src="<?= base_url() . 'circular-logo-purple(4).png' ?>" alt="Logo" class="logo">
      </div>
      <i style="--clr:#9b19dc;"></i>
      <i style="--clr:#fbbd32;"></i>
      <i style="--clr:#9b19dc;"></i>
    </div>
  </div>
</div>
<!--ring div ends here-->

<!-- <?= form_open('/signup') ?>
<div class="row mx-auto row-cols-1 w-50 shadow-lg p-5" style="background-color: white;">
  <div class="col">
    <h1 class="mb-4">Signup</h1>
  </div>
  <div class="col">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password">
    </div>
    <div class="mb-4">
      <label for="confirm-password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="confirm-password" id="confirm-password">
    </div>
  </div>
  <div class="col-12 text-center">
    <button type="submit" class="btn btn-primary w-50 h-100">Signup</button>
  </div>
  <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>
</div>
</form> -->

<style>
  :root {
  --text: #0a090b;
  --background: #f7f6f9;
  --primary: #7532FA;
  --secondary: #6366F1;
  --accent: #ffe400;
  --lightgray: #edf5f1;
  --gray: #4d4c52;
  --black: #000000;
  --purple: #4f089a;
  --lightpurple: #6a5ac1;
  --yellow: #fbbd32;
  --navgray: #2A3144;
}
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Kanit", sans-serif;
  font-weight: 400;
  font-style: normal;
}
body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: var(--lightgray);
  width: 100%;
  overflow: hidden;
}
.container {
  display: flex;
  width: 100%;
  max-width: 1920px;
  height: 600px;
  justify-content: space-between;
  align-items: center;
  gap: 100px; /* Increase gap for more space */
}
.form-container, .logo-container {
  width: 45%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.ring {
  position: relative;
  width: 200px;
  height: 400px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.ring i {
  position: absolute;
  inset: 0;
  border: 4px solid var(--lightpurple);
  transition: 0.5s;
}
.ring i:nth-child(2) {
  border-radius: 50%;
  animation: animate 6s linear infinite;
}
.ring i:nth-child(3) {
  border-radius: 50%;
  animation: animate2 8s linear infinite;
}
.ring i:nth-child(4) {
  border-radius: 50%;
  animation: animate3 10s linear infinite;
}
.ring:hover i {
  border: 6px solid var(--clr);
  filter: drop-shadow(0 0 20px var(--clr));
}
.ring .logo-wrapper {
  position: absolute;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  overflow: hidden;
}
.ring .logo {
  width: 100%;
  height: auto;
  object-fit: cover;
}
@keyframes animate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes animate2 {
  0% {
    transform: rotate(360deg);
  }
  100% {
    transform: rotate(0deg);
  }
}
@keyframes animate3 {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}
.login {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  width: 100%;
}
.login h2 {
  font-size: 2.5em;
  font-style: italic;
  color: var(--lightpurple);
}
.login .inputBx {
  width: 100%;
}
.login .inputBx input {
  width: 100%;
  padding: 12px 20px;
  background: transparent;
  border: 2px solid var(--black);
  border-radius: 10px;
  font-size: 1.2em;
  color: #fff;
  outline: none;
}
.login .inputBx input[type="submit"] {
  background: #7532FA;
  border: none;
  cursor: pointer;
}
.form-label, .form-control, #email, #password, #confirm-password, #username, #student_number, #full_name, #phone_number {
  color: var(--black);
  background: transparent;
}
.login .links {
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding: 0 20px;
}
.login .links a {
  color: var(--gray);
  text-decoration: none;
}
@media (max-width: 768px) {
  .container {
    flex-direction: column-reverse;
    height: auto;
    gap: 0;
  }
  .form-container{
    width: 100%;
  }
  .logo-container{
    width: 50%;
    height: 50%;
  }
  .ring {
    width: 100px;
    height: 200px;
  }
  .logo-wrapper {
    width: 30%;
    height: 30%;
  }
  .login h2 {
    font-size: 1.5em;
  }
  .login .inputBx input {
    font-size: 1em;
  }
}
</style>

<?= $this->endSection() ?>