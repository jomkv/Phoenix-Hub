<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5"><?= lang('Auth.register') ?></h5>

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

                <!-- Email -->
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                    <label for="floatingEmailInput">CvSU Email</label>
                </div>

                <!-- Username -->
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" placeholder="<?= lang('Auth.username') ?>" value="<?= esc(old('username')) ?>" required>
                    <label for="floatingUsernameInput">Username</label>
                </div>

                <!-- Full Name -->
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingPasswordConfirmInput" name="full_name" inputmode="text" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="<?= esc(old('full_name')) ?>" required>
                    <label for="floatingPasswordConfirmInput">Full Name</label>
                </div>

                <!-- Student Number -->
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingPasswordConfirmInput" name="student_number" inputmode="text" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="<?= esc(old('student_number')) ?>" value="<?= esc(old('student_number')) ?>" required>
                    <label for="floatingPasswordConfirmInput">Student Number</label>
                </div>

                <!-- Phone Number -->
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" inputmode="text" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="<?= esc(old('phone_number')) ?>" required>
                    <label for="floatingPasswordConfirmInput">Phone Number</label>
                </div>

                <!-- Password -->
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <label for="floatingPasswordInput">Password</label>
                </div>

                <!-- Password (Again) -->
                <div class="form-floating mb-5">
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
</div>

<?= $this->endSection() ?>