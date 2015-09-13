# Uthando Twitter Zend Framework 2 Module
-----------------------------------------

[![Build Status](https://travis-ci.org/uthando-cms/uthando-twitter.svg?branch=master)](https://travis-ci.org/uthando-cms/uthando-twitter)
[![Test Coverage](https://codeclimate.com/github/uthando-cms/uthando-twitter/badges/coverage.svg)](https://codeclimate.com/github/uthando-cms/uthando-twitter/coverage)
[![Code Climate](https://codeclimate.com/github/uthando-cms/uthando-twitter/badges/gpa.svg)](https://codeclimate.com/github/uthando-cms/uthando-twitter)
[![Dependency Status](https://www.versioneye.com/user/projects/55f2d29fd4d20400190001dc/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55f2d29fd4d20400190001dc)
[![Packagist](https://img.shields.io/packagist/v/uthando-cms/uthando-twitter.svg)](https://packagist.org/packages/uthando-cms/uthando-twitter)


This Module it designed to work with Uthando CMS, but can work indepentently too.
In this release I have included a twitter feed view helper at the moment this is all this module does, I do hope to add more funtionality later.

## Installation

To install this module add to your composer require section

	"uthando-cms/uthando-twitter" : "1.*"

or on the command line in your project root

	php composer.phar require uthando-cms/uthando-twitter:1.*
	
or if you have composer installed globally

	composer require uthando-cms/uthando-twitter:1.*
	
## Features

* Twitter feed view helper
	
## Usage

Once installed you have to add 'UthandoTwitter' to your 'modules' section of your app 'application.config.php' file.

To get started, first you’ll need to either create a new application with Twitter, or get the details of an existing one you control. To do this:

* Go to https://dev.twitter.com/ and sign in.
* Go to https://dev.twitter.com/apps
* Either create a new application, or select an existing one.
  * On the application’s settings page, grab the following information:
  * From the header “OAuth settings”, grab the “Consumer key” and “Consumer secret” values.
  * From the header “Your access token”, grab the “Access token” and “Access token secret” values.

Copy the file in config folder 'twitter.local.php.dist' to your root config/autoload folder and rename it to 'twitter.local.php'
then fill in the OAuth setting you get from your new twitter app. Also in the 'options' section you need to add your twitter screen name and user name.


In the view folder I have included a sample view partial so you can have an idea of how the feed works, to do this copy the contents of 
the public folder to your apps public folder.

The example uses Twitter Bootstrap 3 so be sure to include this. For example in your layout.phtml file add these lines to your head section:

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" media="screen,print" rel="stylesheet" type="text/css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" media="screen,print" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	
Now in your view script you can add

	<div id="twitter-feed" class="col-md-4">
    	<?php echo $this->tweetFeed()->setPartial('uthando-twitter-feed')->render(); ?>
    </div>

This will pull the stream down and display it.

## Contributing

If you want more features or just want to help me out why not fork this repository and send me a pull request
Any bugs please submit an issue.

