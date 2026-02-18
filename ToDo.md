# Authentication To-Do

Steps to implement user login and registration.

---

## 1. Database

- [ ] Create a **users** table with at least: `id`, `email` (or `username`), `password_hash`, `created_at`. Add `name` if needed.
- [ ] Never store plain passwords. Store a **hash** (e.g. `password_hash()` with `PASSWORD_DEFAULT`). On login use `password_verify()`.

---

## 2. Registration

- [ ] Add routes: `GET /register` (show form), `POST /register` (process form).
- [ ] Create registration form: email (or username), password, confirm password. Submit to `POST /register`.
- [ ] Validate: required fields, valid email, password strength/length, confirm matches, email/username not already in DB.
- [ ] On valid input: hash password with `password_hash()`, insert into `users`, then redirect to login (or auto-login and redirect to dashboard).
- [ ] On invalid input: show form again with error messages.

---

## 3. Login

- [ ] Routes: `GET /admin/login` (show form), `POST /admin/login` (process login).
- [ ] Login form: email (or username) and password. Submit to `POST /admin/login`.
- [ ] On submit: find user by email/username; if not found or `password_verify()` fails, show "Invalid credentials"; if valid, set `$_SESSION` (e.g. `user_id`, `email`) and redirect to dashboard (e.g. `/admin`).
- [ ] Update **Auth::check()** so it allows access when `$_SESSION` has a valid user; otherwise redirect to `/admin/login`.

---

## 4. Logout

- [ ] Add route: `GET /admin/logout` or `POST /admin/logout`.
- [ ] Action: destroy session (or clear user keys), redirect to `/admin/login`.

---

## 5. Security

- [ ] Use **HTTPS** in production.
- [ ] **CSRF**: token in login/register forms, validate on POST.
- [ ] **Rate limiting** on login/register (optional).
- [ ] Secure session cookie, reasonable session lifetime.

---

## 6. Order of work

1. Create `users` table and DB connection in the app.
2. Implement **registration** (form, validation, hash, insert).
3. Implement **login** (form, find user, `password_verify`, set `$_SESSION`).
4. Update **Auth::check()** to allow access when a valid user is in the session.
5. Implement **logout** (clear/destroy session, redirect to login).
6. (Optional) Add CSRF and rate limiting.
