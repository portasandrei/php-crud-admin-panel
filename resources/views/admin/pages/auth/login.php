<section>
    <h1><?= $title ?? '' ?></h1>
</section>

<section>
    <p><?= $content ?? '' ?></p>
</section>

<section class="login-form">
    <div class="login-form-container">
        <form action="/admin/login" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me">Remember Me</label>
            </div>
            <div class="form-group">
                <a href="/admin/forgot-password">Forgot Password?</a>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</section>