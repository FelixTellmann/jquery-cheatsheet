<?php
//.env file
if (!is_file('.env')) {
	copy('.env.example', '.env');
}
