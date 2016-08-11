<?php
function hash_password($pass = '') {
	return crypt($pass);
}
function verifyPass($pass, $hash) {
	if (password_verify($pass, $hash)) {
		return TRUE;
	} else {
		return FALSE;
	}
}