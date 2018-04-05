<?php
	$language_array = array("de"=>"0", "en"=>"1");
	
	if(empty($_SESSION['language'])) {
		$_SESSION['language'] = $language_array['de'];
		$language = $language_array['de'];
	} elseif(array_key_exists($language,$language_array)) {
		$_SESSION['language'] = $language_array[$language];
	} else {
		$_SESSION['language'] = $language_array['en'];
	}

/* Text */

/* Zeitformat */

$t_time_format = array(
	"'G:i'",
	"g.i a"
);

/* Wochentage */
$t_day_1 = array(
	"Montag",
	"Monday"
);
$t_day_2 = array(
	"Dienstag",
	"Tuesday"
);
$t_day_3 = array(
	"Mittwoch",
	"Wednesday"
);
$t_day_4 = array(
	"Donnerstag",
	"Thursday"
);
$t_day_5 = array(
	"Freitag",
	"Friday"
);
$t_day_6 = array(
	"Samstag",
	"Saturday"
);
$t_day_7 = array(
	"Sonntag",
	"Sunday"
);

/* Monate */
$t_month_1 = array(
	"Januar",
	"January"
);
$t_month_2 = array(
	"Februar",
	"February"
);
$t_month_3 = array(
	"März",
	"March"
);
$t_month_4 = array(
	"April",
	"April"
);
$t_month_5 = array(
	"Mai",
	"May"
);
$t_month_6 = array(
	"Juni",
	"June"
);
$t_month_7 = array(
	"Juli",
	"July"
);
$t_month_8 = array(
	"August",
	"August"
);
$t_month_9 = array(
	"September",
	"September"
);
$t_month_10 = array(
	"Oktober",
	"October"
);
$t_month_11 = array(
	"November",
	"November"
);
$t_month_12 = array(
	"Dezember",
	"December"
);

/* index.php */
$t_title_index = array(
	"soon - Dein persönlicher Kalender",
	"soon - Your personal calendar"
);	
$t_headline = array(
	"Alle deine Termine - immer und überall aufrufbar",
	"All your appointments. Anytime, everywhere"
);
$t_sign_up = array(
	"Registrieren",
	"Sign up"
);
$t_log_in = array(
	"Anmelden",
	"Log in"
);
$t_your_future = array(
	"Deine Zukunft",
	"Your future"
);
$t_your_future_text = array(
	"Mit deinem soon-Kalender blickst du in die Zukunft. Plane und bearbeite alle deine künftigen Termine.",
	"n/a"
);
$t_for_free = array(
	"Kostenlos",
	"For free"
);
$t_for_free_text = array(
	"Registriere dich noch heute und nutze die grenzenlosen Möglichkeiten. Komplett kostenlos.",
	"n/a"
);
$t_everywhere = array(
	"Überall",
	"Everywhere"
);
$t_everywhere_text = array(
	"Dein soon-Kalender ist stets bei dir. Behalte überall und jederzeit den Überblick – dank Optimierung für all deine Geräte.",
	"n/a"
);
$t_secure = array(
	"Sicher",
	"Secure"
);
$t_secure_text = array(
	"Alle deine Daten gehören dir. Daher verschlüsseln wir diese, sodass du dir keine Sorgen um deine Privatsphäre machen musst.",
	"n/a"
);

/* navbar.php */
$t_search_appointment = array(
	"Termin suchen",
	"Search appointment"
);
$t_search = array(
	"Suchen",
	"Search"
);
$t_add_appointment = array(
	"Termin hinzufügen",
	"Add appointment"
);
$t_my_calendar = array(
	"Mein Kalender",
	"My calendar"
);
$t_my_profile = array(
	"Mein Profil",
	"My profile"
);
$t_log_out = array(
	"Abmelden",
	"Log out"
);

/* registration.php */
$t_title_registration = array(
	"Registrieren - soon",
	"Sign up - soon"
);
$t_username = array(
	"Benutzername",
	"Username"
);
$t_email = array(
	"E-Mail-Adresse",
	"Email"
);
$t_password = array(
	"Passwort",
	"Password"
);
$t_repeat_password = array(
	"Passwort wiederholen",
	"Repeat password"
);
$t_already_have_an_account = array(
	"Bereits einen Account?",
	"Already have an account?"
);
$t_please_enter_a_username = array(
	"Geben Sie einen Benutzernamen ein",
	"Please enter a username"
);
$t_please_enter_a_valid_email_address = array(
	"Geben Sie eine gültige E-Mail-Adresse ein",
	"Please enter a valid email address"
);
$t_please_enter_a_password = array(
	"Geben Sie ein Passwort ein",
	"Please enter a password"
);
$t_the_passwords_must_be_identical = array(
	"Die Passwörter müssen übereinstimmen",
	"The passwords must be identical"
);
$this_email_address_is_already_taken = array(
	"Diese E-Mail-Adresse ist bereits vergeben",
	"This email address is already taken"
);

/* verification.php */
$t_title_verification = array(
	"E-Mail-Adresse bestätigen - soon",
	"Verify email adress - soon"
);
$t_verify_email_adress = array(
	"E-Mail-Adresse bestätigen",
	" Verify email adress"
);
$t_verification_code = array(
	"Bestätigungscode",
	"Verification code"
);
$t_invalid_verification_code = array(
	"Ungültiger Bestätigungscode",
	"Invalid verification code"
);

/* confirmation.php */
$t_title_confirmation = array(
	"Erfolgreiche Registrierung - soon",
	"Successfully registrated - soon"
);
$t_you_have_successfully_registered = array(
	"Du hast dich erfolgreich registriert",
	"You have successfully registered."
);
$t_welcome_to_soon = array(
	"Willkommen bei soon",
	"Welcome to soon"
);
$t_getting_started = array(
	"Loslegen",
	"Getting started"
);

/* login.php */
$t_title_login = array(
	"Anmelden - soon",
	"Log in - soon"
);
$t_stay_logged_in = array(
	"Angemeldet bleiben",
	"Stay logged in"
);
$t_no_account_yet = array(
	"Noch keinen Account?",
	"No account yet?"
);
$t_email_or_password_is_invalid = array(
	"E-Mail-Adresse oder Passwort ist ungültig",
	"Email or password is invalid"
);

/* result.php */
$t_title_result = array(
	"Suchergebnisse - soon",
	"Search results - soon"
);
$t_no_search_results = array(
	"Keine Suchergebnisse",
	"No search results"
);
$t_please_enter_a_search_term = array(
	"Geben Sie einen Suchbegriff ein",
	"Please enter a search term"
);
$t_view_calendar = array(
	"Zum Kalender",
	"View calendar"
);
$t_search_results_for = array(
	"Suchergebnisse zu",
	"Search results for"
);

/* add.php */
$t_title_add = array(
	"Termin hinzufügen - soon",
	"Add appointment - soon"
);
$t_date = array(
	"Datum",
	"Date"
);
$t_appointment_name = array(
	"Terminname",
	"Appointment name"
);
$t_time = array(
	"Zeit",
	"Time"
);
$t_location = array(
	"Ort",
	"Location"
);
$t_comment = array(
	"Bemerkung",
	"Comment"
);
$t_cancel = array(
	"Abbrechen",
	"Cancel"
);
$t_insert_an_appointment_name = array(
	"Geben Sie einen Terminnamen ein",
	"Insert an appointment name"
); 
$t_insert_a_valid_date = array(
	"Geben Sie ein gültiges Datum ein",
	"Insert a valid date"
);
$t_insert_a_future_date = array(
	"Geben Sie ein zukünftiges Datum ein",
	"Insert a future date"
);

/* profile.php */
$t_title_profile = array(
	"Mein Profil - soon",
	"My profile - soon"
);
$t_language = array(
	"Sprache",
	"Language"
);
$t_change_password = array(
	"Passwort ändern",
	"Change password"
);

/* edit_username.php */
$t_title_edit_username = array(
	"Benutzername ändern - soon",
	"Change username - soon"
);
$t_change_username = array(
	"Benutzername ändern",
	"Change username"
);
$t_new_username = array(
	"Neuer Benutzername",
	"New username"
);

/* edit_mail.php */
$t_title_edit_mail = array(
	"E-Mail-Adresse bearbeiten - soon",
	"Change email - soon"
);
$t_change_email = array(
	"E-Mail-Adresse ändern",
	"Change email"
);
$t_new_email = array(
	"Neue E-Mail-Adresse",
	"New email"
);

/* edit_password.php */
$t_title_edit_password = array(
	"Passwort ändern - soon",
	"Change password - soon"
);
$t_current_password = array(
	"Aktuelles Passwort",
	"Current password"
);
$t_new_password = array(
	"Neues Passwort",
	"New password"
);
$t_confirm_new_password = array(
	"Neues Passwort bestätigen",
	"Confirm new password"
);
$t_the_current_password_is_wrong = array(
	"Das aktuelle Passwort muss stimmen",
	"The current password is wrong"
);
$t_please_insert_a_new_password = array(
	"Geben Sie ein neues Passwort ein",
	"Please insert a new password"
);
$t_the_passwords_must_match = array(
	"Die neuen Passwörter müssen übereinstimmen",
	"The passwords must match"
);

/* edit_language.php */
$t_title_edit_language = array(
	"Sprache ändern - soon",
	"Change language - soon"
);
$t_change_language = array(
	"Srache ändern",
	"Change language"
);

/* appointment.php */
$t_title_appointment = array(
	"- soon", 
	"- soon"
);						
$t_appointment = array(
	"Termin",
	"Appointment"
);
$t_from = array(
	"von",
	"from"
);
$t_today = array(
	"heute",
	"today"
);
$t_tomorrow = array(
	"morgen",
	"tomorrow"
);

/* remove.php */
$t_title_remove = array(
	"Termin löschen - soon",
	"Delete appointment - soon"
);
$t_delete_appointment = array(
	"Termin löschen",
	"Delete appointment"
);
$t_confirm = array(
	"Bestätigen",
	"Confirm"
);

/* edit_appointment.php	*/
$t_title_edit_appointment = array(
	"Termin bearbeiten - soon",
	"Edit appointment - soon"
);
$t_edit_appointment = array(
	"Termin bearbeiten",
	"Edit appointment"
);
$t_save = array(
	"Speichern",
	"Save"
);

/* export_pdf.php */
$t_all_appointments_of = array(
	"Alle Termine von",
	"All appointments of"
);

$t_in = array(
	"im",
	"in"
);

$t_created_on = array(
	"Erstellt am",
	"Created on"
);