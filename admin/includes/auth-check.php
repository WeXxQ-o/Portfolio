<?php
/**
 * Authentication helpers placeholder.
 *
 * TODO: write the login logic here.
 */

function isLoggedIn() {
    // TODO: check if user is actually in DB and logged in.
    return false;
}

function isSessionValid() {
    // TODO: check for session timeout and IP change.
    return false;
}

function requireAuth() {
    // TODO: redirect to login if not auth.
}

function getCurrentAdmin() {
    return [
        'id' => null,
        'username' => 'Admin',
        'email' => null,
        'full_name' => null,
    ];
}

function destroyAdminSession() {
    // TODO: kill the session.
}

function generateCsrfToken() {
    return '';
}

function verifyCsrfToken($token) {
    return false;
}
