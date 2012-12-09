I need using radius with owncloud, i write radius support! :)


Need php-pecl-radius

yum install -y php-pecl-radius.x86\_64



Adding radius support to this plugin 

http://owncloud.org/support/custom-user-configuration/




To install copy user\_external into /var/www/html/owncloud/apps/

And insert into config/config.php this config: 

 'user\_backends'=>array( 

   array( 

     'class'=>'OC_User_RADIUS', 

     'arguments'=>array("radius1.secure-pass.net", "gullp.net", "owncloud") 

   )


I have a problem similar http://forums.archlinux.fr/post105680.html 

Maybe the problem is only in 64bit
