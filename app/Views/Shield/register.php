<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Login<?= $this->endSection() ?>

<?= $this->section("content") ?>

<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<div class="container">
    <div class="form-container">
        <div class="login">
            <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
            <?php elseif (session('errors') !== null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                            <?= $error ?>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= session('errors') ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <form action="<?= url_to('register') ?>" method="post">
                <?= csrf_field() ?>
                <h2>Register</h2>

                <!-- Email -->
                <div class="inputBx">
                    <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                    <label for="floatingEmailInput">CvSU Email</label>
                </div>

                <!-- Username -->
                <div class="inputBx">
                    <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" placeholder="<?= lang('Auth.username') ?>" value="<?= esc(old('username')) ?>" required>
                    <label for="floatingUsernameInput">Username</label>
                </div>

                <!-- Full Name -->
                <div class="inputBx">
                    <input type="text" class="form-control" id="floatingPasswordConfirmInput" name="full_name" inputmode="text" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="<?= esc(old('full_name')) ?>" required>
                    <label for="floatingPasswordConfirmInput">Full Name</label>
                </div>

                <!-- Student Number -->
                <div class="inputBx">
                    <input type="text" class="form-control" id="floatingPasswordConfirmInput" name="student_number" inputmode="text" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="<?= esc(old('student_number')) ?>" value="<?= esc(old('student_number')) ?>" required>
                    <label for="floatingPasswordConfirmInput">Student Number</label>
                </div>

                <!-- Phone Number -->
                <div class="inputBx">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" inputmode="text" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="<?= esc(old('phone_number')) ?>" required>
                    <label for="floatingPasswordConfirmInput">Phone Number</label>
                </div>

                <!-- Password -->
                <div class="inputBx">
                    <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <label for="floatingPasswordInput">Password</label>
                </div>

                <!-- Password (Again) -->
                <div class="inputBx">
                    <input type="password" class="form-control" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                    <label for="floatingPasswordConfirmInput">Confirm Password</label>
                </div>


                <div class="d-grid col-12 col-md-8 mx-auto m-3">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                </div>

                <p class="text-center"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>

            </form>
        </div>
    </div>
    <div class="logo-container">
        <div class="ring">
            <div class="logo-wrapper">
                <img src="<?= base_url() . 'circular-logo-purple(4).png' ?>" alt="Logo" class="logo">
            </div>
            <i style="--clr:#9b19dc;"></i>
            <i style="--clr:#17ffff;"></i>
            <i style="--clr:#9b19dc;"></i>
        </div>
    </div>
</div>


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
        color: black;
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

    .custom-error-container {
        background-color: #f8d7da;
        border-radius: 5px;
        margin-bottom: 10px;
        margin-top: 10px;
        padding: 5px;
        padding-left: 25px;
        border-left: 5px solid red;
    }

    .container {
        display: flex;
        width: 100%;
        max-width: 1920px;
        height: 600px;
        justify-content: space-between;
        align-items: center;
        gap: 100px;
        /* Increase gap for more space */
    }

    .form-container,
    .logo-container {
        width: 45%;
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

    .form-label,
    .form-control,
    #email,
    #password {
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
            gap: 20px;
        }

        .form-container {
            width: 100%;
        }

        .logo-container {
            width: 50%;
            height: 50%;
            display: none;
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