=== Nextend Facebook Connect ===
Contributors: nextendweb 
Tags: facebook, register, login, social connect, social, facebook connect
Donate link: https://www.facebook.com/nextendweb
Requires at least: 3.0
Tested up to: 3.4
Stable tag: 1.4.59
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

One click registration & login plugin for Facebook? Easy installation? Is it totally free and comes with support? Yeah!

== Description ==

Check the [DEMO](http://www.nextendweb.com/wp-login.php) on our site.

Also we created a [Social Connect button generator](http://www.nextendweb.com/social-connect-button-generator) for this plugin. This allows you to create fancy login buttons. 

Personally, I hate to fill out registration forms, waiting for confirmation e-mails, so we designed this plugin for our website. Now, we want to share this very usable plugin with everyone, for free!
 
**Why should you choose Nextend Facebook Connect plugin from the many social plugins?**

* If your visitors have a Facebook profile, they can register your site with a single click, and later to log in too.
* The previously registered users can simply attach their existing Facebook profile to their account, so in the future, they can logging in with the one social button.
* The plugin has multiple desings, so it fits all kind of websites smoothly and elegantly.
* The plugin supports Facebook profile picture as avatar. 
* Very simple to use.
* Fast and helpful support.

If you like our stuff donate a like to our [Facebook page](https://www.facebook.com/nextendweb) or follow us on [Twitter](https://twitter.com/nextendweb)!

#### Usage

After you activated the plugin, the plugin will autmatically 

* add the login buttons to the WordPress login page. See screenshot #1
* add the account linking buttons to the WordPress profile page. See screenshot #2


#### Advanced usage

**Simple link**

&lt;a href="*siteurl*/wp-login.php?loginFacebook=1&redirect=*siteurl*" onclick="window.location = \'*siteurl*/wp-login.php?loginFacebook=1&redirect=\'+window.location.href; return false;"&gt;Click here to login or register with Facebook&lt;/a&gt;

**Image button**

&lt;a href="*siteurl*/wp-login.php?loginFacebook=1&redirect=*siteurl*" onclick="window.location = \'*siteurl*/wp-login.php?loginFacebook=1&redirect=\'+window.location.href; return false;"&gt; &lt;img src="HereComeTheImage" /&gt; &lt;/a&gt;

== Installation ==

1.  Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.
2.  Create a facebook app => https://developers.facebook.com/apps/?action=create
3.  Choose an App Name, it can be anything you like
4.  Click on Continue
5.  Go to the newly created App settings page and click Edit Settings
6.  Fill out App Domains field with: your domain name
7.  Click on Website with Facebook Login tab abd fill out Site URL field with: http://yoursiteurl.com
8.  Click on Save changes and the top of the page contains the App Id and App secret which you have to copy and past below.
9.  Save changes!


== Screenshots ==

1. Our Social Connect plugins on the main WP login page
2. Our Social Connect plugins in the profile page for account linking

== Changelog ==

= 1.4.59 =
* Avatar fix
* Buddypress avatar support. If Buddypress avatar not exists, then FB avatar used. If there is a BuddyPress avatar, that will be used.

= 1.4.58 =
* Typo in redirects

= 1.4.57 =
* Fix: WordPress transient functions used to store the required session variables. $_SESSION fully removed. Beta!!!

= 1.4.56 =
* Fix: Now the plugin use wp transient for the admin messages
* NOTICE: If the 1.4.54 version work for you fine, do NOT update yet!

= 1.4.55 =
* Fix: Now the plugin use cookies instead of PHP session. Maybe this fixes the problems.
* NOTICE: If the previous version work for you fine, do NOT update yet!

= 1.4.54 =
* Feature: You can now define NEXTEND_FB_APP_ID and NEXTEND_FB_APP_SECRET contant and it will overwrite the backend settings.

= 1.4.53 =
* Error messages added if some PHP components are missing.

= 1.4.52 =
* Avatar fix

= 1.4.48 =
* Avatar fix
* Changes in actions 

= 1.4.47 =
* Optimalizations

= 1.4.46 =
* Redirection fix
* Unlink speed up

= 1.4.45 =
* New filter added to get extended Facebook permissions: nextend_fb_scope
* Read more on the new filter: http://www.nextendweb.com/knowledgebase/question/how-can-i-get-extended-facebook-permissions-for-other-fields

= 1.4.44 =
* Now user not logged out after the unlinking process.

= 1.4.43 =
* Redirection fix
* Added feature: unlink account
* Added WP actions for register/login/account linking. Read more: http://www.nextendweb.com/knowledgebase/question/how-can-i-make-custom-calls-when-a-visitor-log-in-with-facebook-connect

= 1.4.42 =
* Added check for login inputs

= 1.4.36 =
* PHP notice fixes

= 1.4.35 =
* With `new_fb_get_user_access_token($user_id)` PHP function you can get the user access token, if any...
* Javascript login fix for "SimpleModal Login"

= 1.4.34 =
* Typo fix, please update from 1.4.3x to this version!

= 1.4.33 =
* Double login button fix

= 1.4.32 =
* Official SSL support added - Thanks for Chin for the help

= 1.4.29 =
* "There was an error with the FB auth!" fix

= 1.4.28 =
* Certificate fix

= 1.4.27 =
* Important security fix

= 1.4.26 =
* Added e-mail notification on registration

= 1.4.25 =
* wp_login do_action fix

= 1.4.23 =
* Bugfix for Wordpress 3.5RC1
* Added email check
* Fixed get avatar filter
* new_fb_is_user_connected() function now returns with the Facebook id if authenticated, null if not...

= 1.4.21 =
* Bugfix for Wordpress 3.5RC1

= 1.4.20 =
* Avatar bugfix

= 1.4.19 =
* Added profile picture support for avatars

= 1.4.18 =
* Fixed SDK loading

= 1.4.16 =
* Buttons added to registration form

= 1.4.15 =
* Email fix
* Added the option for different redirect for Login and Registration

= 1.4.14 =
* Login page jQuery fix

= 1.4.13 =
* Some login fixes

= 1.4.12 =
* Fixed session check

= 1.4.11 =
* Added a fix when Facebook class already loaded

= 1.4.10 =
* Added editProfileRedirect parameter for buddypress edit profile redirect. Usage: siteurl?editProfileRedirect=1

= 1.4.9 =
* https bugfix - author Michel Weimerskirch

= 1.4.8 =
* Added name, first name and last name support.

= 1.4.4 =
* Modified login redirect issue for wp-login.php - author Michel Weimerskirch
* Added fix redirect url support. If you leave it empty or "auto" it will try to redirect back the user to the last visited page. 

= 1.4.3 =
* Facebook Certification bugfix
 
= 1.4 =
* Added Social button generator support

= 1.3 =
* Added linking option to the profile page, so an already registered user can easily link the profile with a Facebook profile.

= 1.2 =
* Fixed a bug when the htaccess short urls not enabled.