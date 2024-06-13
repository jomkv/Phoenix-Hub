<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Admin Signup <?= $this->endSection() ?>

<?= $this->section("content") ?>

<!--ring div starts here-->
<div class="container">
  <div class="form-container">
    <div class="login">
      <?= form_open('/signup/admin') ?>
        <h2>Admin Sign Up</h2>
        <div class="inputBx">
          <label for="username">Username</label>
          <input type="text" name="username" id="username">
        </div>
        <div class="inputBx">
          <label for="email">Email</label>
          <input type="text" name="email" id="email">
        </div>
        <div class="inputBx">
          <label for="password">Password</label>
          <input type="password" name="password" id="password">
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
        <img src="<?= base_url() . 'circular-logo-lightgray(1).png' ?>" alt="Logo" class="logo">
      </div>
      <i style="--clr:#9b19dc;"></i>
      <i style="--clr:#fbbd32;"></i>
      <i style="--clr:#9b19dc;"></i>
    </div>
  </div>
</div>
<!--ring div ends here-->

<style>
  :root {
  --text: #0a090b;
  --background: #f7f6f9;
  --darkbg: #00012E;
  --primary: #7532FA;
  --secondary: #6366F1;
  --accent: #ffe400;
  --lightgray: #edf5f1;
  --gray: #4d4c52;
  --black: #000000;
  --purple: #4f089a;
  --lightpurple: #D292FF;
  --yellow: #fbbd32;
  --navgray: #2A3144;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: var(--darkbg);
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
  border: 4px solid #fff;
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
  border: 2px solid #fff;
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

.form-label, .form-control, #email, #password {
  background: transparent;
}
.login .links {
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding: 0 20px;
}
.login .links a {
  color: #fff;
  text-decoration: none;
}
@media (max-width: 768px) {
  .container {
    flex-direction: column-reverse;
    height: auto;
    gap: 20px;
  }
  .form-container{
    width: 100%;
  }
  .logo-container{
    width: 50%;
    height: 50%;
  }
  .ring {
    width: 200px;
    height: 400px;
  }
  .logo-wrapper {
    width: 80%;
    height: 80%;
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
