<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Admin Signup <?= $this->endSection() ?>

<?= $this->section("content") ?>

<!--ring div starts here-->
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<div class="ring">
  <i style="--clr:#fbbd32;"></i>
  <i style="--clr:white;"></i>
  <i style="--clr:#fbbd32;"></i>
  <div class="login">
  <?= form_open('/signup/admin') ?>
    <h2>Sign Up</h2>
    <div class="inputBx">
    <label for="title">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="inputBx">
    <label for="content">Email</label>
        <input type="text" name="email" id="email">
    </div>
    <div class="inputBx">
      <label for="content">Password</label>
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
<!--ring div ends here-->

<style>
   
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
  background: #111;
  width: 100%;
  overflow: hidden;
}
.ring {
  position: relative;
  width: 600px;
  height: 600px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.ring i {
  position: absolute;
  inset: 0;
  border: 2px solid #fff;
  transition: 0.5s;
}
.ring i:nth-child(1) {
  border-radius: 25% 50% 25% 50% / 50% 25% 50% 25%;
  animation: animate 6s linear infinite;
}
.ring i:nth-child(2) {
  border-radius: 50% 25% 50% 25% / 25% 50% 25% 50%;
  animation: animate 4s linear infinite;
}
.ring i:nth-child(3) {
  border-radius: 33% 67% 33% 67% / 67% 33% 67% 33%;
  animation: animate2 10s linear infinite;
}
.ring:hover i {
  border: 6px solid var(--clr);
  filter: drop-shadow(0 0 20px var(--clr));
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
.login {
  position: absolute;
  width: 300px;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 20px;
}
.login h2 {
  font-size: 2em;
  color: #fff;
}
.login .inputBx {
  position: relative;
  width: 100%;
}
.login .inputBx input {
  position: relative;
  width: 100%;
  padding: 12px 20px;
  background: transparent;
  border: 2px solid #fff;
  border-radius: 40px;
  font-size: 1.2em;
  color: #fff;
  box-shadow: none;
  outline: none;
}
.login .inputBx input[type="submit"] {
  width: 100%;
  background: #7532FA;
  border: none;
  cursor: pointer;
}
.login .inputBx input::placeholder {
  color: rgba(255, 255, 255, 0.75);
}
.login .links {
  position: relative;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
}
.login .links a {
  color: #fff;
  text-decoration: none;
}

</style>

<?= $this->endSection() ?>