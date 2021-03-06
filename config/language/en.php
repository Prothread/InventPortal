<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 26-Jan-17
 * Time: 14:37
 */

define("TEXT_HOME", "Dashboard");
define("TEXT_OVERVIEW", "Overview");
define("MY_TEXT_OVERVIEW", "My overview");
define("TEXT_UPLOAD", "Upload");
define("TEXT_SETTINGS", "Settings");
define("TEXT_CLIENT", "Clients");
define("TEXT_USER", "Users");
define("TEXT_ACCORD", "Accord");
define("TEXT_LOGOUT", "Log out");
define("TEXT_USERPROFILE", "Profile: ");
define("TEXT_VERSIE", "Version");


/* LOGIN */
define("TEXT_PASSWORD", "Password");
define("BUTTON_LOGIN", "Login");
define("TEXT_PASSWORD_FORGET", "Forgot password");
define("TEXT_WRONG_LOGIN_COMBINATION", "Wrong combination, try again");
define("TEXT_USER_NOT_ACTIVE", "User is not active");


/* DASHBOARD */
define("TEXT_DIAGRAM", "Difference accord & declined");
define("TEXT_ASSIGNMENTS", "Open assignments");
define("TEXT_DIAGRAM_PERCENTAGE", "Percentage accord for each person");
/* */
define("TEXT_SENDER", "Send by");
define("TEXT_ASSIGNFOR", "Client");
define("TEXT_DATE", "Date");
define("TEXT_PROGRESS", "Status");
/* */
define("TEXT_UPLOADED", "Uploaded");
define("TEXT_SEEN", "Seen");
define("TEXT_ACCORDED", "Accorded");
define("TEXT_DECLINED", "Declined");


/* OVERVIEW */
define("BUTTON_MYOVERVIEW", "My overview");
define("BUTTON_SENDAGAIN", "Resend assigment(s)");
define("BUTTON_DAYSOPEN", "Open assignments");
define("BUTTON_5DAYS", "( > 5 days)");
define("BUTTON_ACCORDED", "Accorded assignment(s)");
define("BUTTON_DECLINED", "Declined assignment(s)");
define("LEGEND", "Legend");
/* */
define("TABLE_TITLE", "Title");


/* UPLOAD */
/* Step 1 */
define("TEXT_STEP1", "Upload the files that you want to send with this assignment");
define("TEXT_UPLOAD_FILES", "Upload files");
define("TEXT_SELECTED_FILES", "Selected files");
define("BUTTON_UPLOAD", "Upload");
/* Step 2 */
define("TEXT_STEP2", "Fill in assigment information");
define("TEXT_DESCRIPTION", "Description");
define("TEXT_INTERNCOMMENT", "Intern comment");
define("TEXT_INTERNCOMMENTIMPORTANCE", "Importance comment");
/* Importance comments */
define("TEXT_INTERNCOMMENTIMPORTANCE1", "Normal comment");
define("TEXT_INTERNCOMMENTIMPORTANCE2", "Watch the following");
define("TEXT_INTERNCOMMENTIMPORTANCE3", "Important comment");
define("TEXT_INTERNCOMMENTIMPORTANCE4", "Demand of client");
/* Step 3 */
define("TEXT_NEWCLIENT", "Create new client");
define("BUTTON_NEWCLIENT", "New client");
define("TEXT_SEARCH_CLIENT", "Search client");
define("INPUT_SELECT_CLIENT", "Select a client");
/* Buttons */
define("BUTTON_NEXT", "Next");
define("BUTTON_SEND", "Send");
/* Upload errors */
define("ERROR_TITLE", "Title is empty, try again.");
define("ERROR_DESCRIPTION", "Description is empty, try again.");


/* SETTINGS */
/* Part 1 */
define("TEXT_EMAIL_TRAFFIC", "Email traffic");
define("SMTP_ADRES", "SMTP adress");
define("SMTP_PORT", "SMTP Port");
define("TEXT_EMAIL", "E-mail");
define("TEXT_ALTERNATIVE_EMAIL", "Alternative E-mail");
define("TEXT_EMAIL_PASS", "E-mail password");
define("WEBSITE_HOST", "Website URL");
define("TEXT_WEBSITE_URL", "Fill in site url, example: http://www.madalco.com/portal");
define("TEXT_GLOBAL_MAIL", "Global e-mail");
/* Part 2 */
define("TEXT_STYLE_SETTINGS", "Styling settings");
define("TEXT_HEADER_LOGO", "Header logo");
define("TEXT_SELECTED_LOGO", "Selected logo");
define("TEXT_BACKGROUND_COLOR_HEADER", "Backgroundcolor header");
define("TEXT_LOGIN_BACKGROUND", "Login background");
define("TEXT_SELECTED_FILE", "Selected file");
define("BUTTON_SAVE", "Save");
/* */
define("TEXT_SETTINGS_EDITED", "Settings have been edited");
define("TEXT_UPLOADED_FILE_NAME_TOO_LARGE", "File name is too big");


/* MANAGE CLIENTS */
define("TEXT_CLIENT_OVERVIEW", "Client overview");
define("TEXT_NAME", "Name");
define("TEXT_COMPANY_NAME", "Company name");
define("TEXT_ADRESS", "Adress");
define("TEXT_POSTALCODE", "Postal code");
define("TEXT_CITY", "City");
define("TEXT_LANGUAGE", "Language");
/* */
define("TEXT_USER_OVERVIEW", "User overview");
define("BUTTON_NEWUSER", "New user");


/* EDIT USERES*/
define("TEXT_EDIT_USER", "Edit user");
define("TEXT_UPLOAD_LOGO", "Upload logo");
/* */
define("TEXT_NAMES", "Names");
define("TEXT_CONTACT_DETAILS", "Contact details");
/* */
define("TEXT_ALTERNATIVE_EMAIL_INFO", "Alternative E-mail for communication");
define("TEXT_IS_CLIENT", "Client");
define("TEXT_IS_USER", "User");
define("TEXT_IS_ACCOUNTANT", "Accountant");
define("TEXT_IS_ADMIN", "Admin");
define("TEXT_ACTIVE", "Active");


/* NEW PASSWORD */
define("TEXT_WRONG_PASSWORD", "The filled in passwords don't match");
define("TEXT_CURRENT_PASSWORD", "Current password");
define("TEXT_NEW_PASSWORD", "New password");
define("TEXT_NEW_PASSWORD_REPEAT", "Repeat new password");
define("TEXT_PASSWORD_STRENGTH", "Strength of new pasword");
/* */
define("TEXT_PASSWORD_FORGET_EXPIRES", "Password forget expired");
define("TEXT_GO_TO_STARTPAGEE", "Go to homepage");
define("TEXT_PASSWORD_FORGET_ERROR", "Password forget link expired");


/* APPROVE */
define("TEXT_PRODUCT_ACCORD", "Product accord");
define("TEXT_FILES", "Files");
define("BUTTON_ACCORD", "Accord");
define("BUTTON_DECLINE", "Decline");
define("BUTTON_STEP_BACK", "Step back");
define("TEXT_EDITED", "Edited");
define("TEXT_NEW_COMMENT", "My comment");
/* */
define("TEXT_BEFORE_TERMS_AND_CONDITIONS", "I have read the ");
DEFINE("TEXT_TERMS_AND_CONDITIONS", "terms and conditions");
define("TEXT_AFTER_TERMS_AND_CONDITIONS", "and I agree to it");


/* PROFILE */
define("TEXT_YOUR_PROFILE", "Your profile");
define("TEXT_EDIT_PROFILE", "Edit your profile");
define("TEXT_PERMISSION", "Permission");
define("TEXT_EDIT_PASSWORD", "Edit password");


/* Archive */
define("TEXT_ARCHIVE", "Archive");


/* SESSION FLASH */
define("TEXT_NO_PERMISSION", "You don't have the permission to do this");
/*StatusController*/
define("TEXT_ITEM_CREATED", "Item has been created");
define("TEXT_ITEM_EDITED", "Item has been edited");
/*UserController*/
define("TEXT_USER_CREATED", "User has been created");
define("TEXT_USER_EDITED", "User has been edited");
/*passreset*/
define("TEXT_MINIMAL_LENGTH_6", "The password needs to be longer than 6 signs");
define("TEXT_PASSWORDS_DONT_MATCH", "The passwords don't match");
define("TEXT_ERROR_OCCURED", "Something went wrong");
define("TEXT_PASSWORD_CHANGED", "Password has been changed");
/*settingupload*/
define("TEXT_UPLOADED_FILE_TOO_BIG", "Uploaed file is too big");
define("TEXT_FILES_UPLOAD_ERROR", "Files couldn't be uploaded");
/*upload*/
define("TEXT_FILE_UPLOADED", "Your files have succesfully been uploaded");
/*approve*/
define("TEXT_ACCORD_ERROR", "There is nothing to accord");
/*clientmail*/
define("TEXT_MAIL_USED", "This mail is already in use");
/*delete item*/
define("TEXT_ITEM_DELETD", "Item has been deleted");
/*edit/delete user*/
define("TEXT_CANT_EDIT_USER", "You don't have the permission to edit this user");
define("TEXT_CANT_DELETE_USER", "You don't have the permission to delete this user");
/*download*/
define("TEXT_DOWNLOAD_IMAGE", "Image can't be downloaded yet");
/*forgetpassword*/
define("TEXT_FORGET_PASSWORD", "Order has been requested");
/*updatemail*/
define("TEXT_ACCORD_SEND", "Accord has been send");
/*Update open mails*/
define("TEXT_NO_ASSIGNMENTS_5DAYS", "There are no assignments that are open for longer than 5 days");


/* Modals */
define("TEXT_DELETE_USER", "Delete user");
define("TEXT_RESET_PASSWORD", "Reset password");
define("TEXT_MESSAGE_DELETING_PASSWORD", "You are about to reset the password of the user ");
define("TEXT_MESSAGE_DELETING_PASSWORD1", " ");
define("TEXT_MESSAGE_DELETING_USER", "You are about to delete the user");
define("TEXT_MESSAGE_DELETING_USER1", " ");
/* */
define("TEXT_ARE_YOU_SURE", "Are you sure?");


/* 404 Page */
define("TEXT_MESSAGE_ERROR_404_TITLE", "The page you were looking for couldn't be found.");
define("TEXT_MESSAGE_ERROR_404", "Sorry, the page cannot be shown. The page may not exist. <br />
We advice you to use the buttons in the sidebar to get to the right page or to go back to the homepage.");


/* ITEM */
define("TEXT_YOUR_ASSIGNMENT", "Your assignment");
define("TEXT_CLIENT_DESCRIPTION", "Client comment");
define("TEXT_ACCORD_IP", "Accord IP-adress");
define("TEXT_ASSIGNMENT_INFO", "Assignment info");
define("TEXT_STEP5", "Upload new files that you want to send with this assignment below (if needed).");
define("TEXT_NEW_INTERNCOMMENT", "New intern comment");
define("TEXT_STEP6", "Change description (optional) and send the assignment.");
define("TEXT_NEW_DESCRIPTION", "New description");
define("TEXT_EMAIL_CLIENT", "Email client");
define("TEXT_NO_EDITS", "Not reviewed");
/* */
define("BUTTON_DECLINE_ASSIGNMENT", "Decline assignment");
define("BUTTON_DELETE_ASSIGNMENT", "Delete assignment");
/* */
define("TEXT_COMMENT", "Comment");
define("TEXT_SELECT_COMMENT", "Select a comment");
define("TEXT_VERSION", "Version");
define("TEXT_DOWNLOADS", "Downloads");
define("TEXT_DOWNLOAD", "Download");
define("TEXT_MAKE_DOWNLOADABLE", "Make downloadble");
define("TEXT_CANT_DOWNLOAD_YET", "You can't download this product yet");
define("TEXT_MAKE_ALL_DOWNLOADABLE", "Make all files downloadable");
/* */
define("TEXT_MAKE_ALL_DOWNLOADABLE_MESSAGE", "You are about to make all the images in this assignment downloadble");
define("TEXT_DELETE_ASSIGNMENT", "Delete assignment");

define("TEXT_GEACHTE", "Dear ");
define("TEXT_DIGITALE_PROEFDRUK", "We made a digital sample for you <br /> You can inspect this in the <b>clientportal</b>.");
define("TEXT_PROEF_BEKIJKEN", "You can inspect, accord or eddit the assignment whith the link below");
define("TEXT_GROET", "With kind regards,");
define("TEXT_MAIL_DISCLAIMER", "This is an automatically generated mail. Please do not reply to this email");

define("MAX_WORDS_COMMENT", "*Maximum amount of characters is 512");
define("UPLOAD_MAX_SIZE", " the maximum upload size is 16MB");
define("SECOND_EMAIL_TEXT", "Extra e-mail addresses: ");
define("MAIL_COMMENT", "Comment");
