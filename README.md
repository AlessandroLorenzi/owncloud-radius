I need using radius with owncloud, i write radius support! :)

It is an extension to app "user\_external".
http://owncloud.org/support/custom-user-configuration/

This plug-in contains "Pure PHP radius class", a PHP class to connect to
RADIUS. This sofware is Copyright (c) 2008, SysCo systemes de communication sa

To install copy user\_external into /var/www/html/owncloud/apps/

Insert into config/config.php this config: 

 'user\_backends'=>array( 

   array( 

     'class'=>'OC_User_RADIUS', 

     'arguments'=>array("SERVER", "REALM", "SECRET") 

   )


