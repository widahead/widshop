Step 1:
Create folder named with "WidShop" in plugin folder.

Step 2:
Extract plugin zip.
Copy all folder like app, model etc from extracted zip and paste it on "WidShop" folder.

Step 3:
Copy these lines to app/Config/bootstrap.php

CakePlugin::loadAll(); // Loads all plugins at once
CakePlugin::load('WidShop');

Step 4:
Copy these lines to app/Config/routes.php and remove all default Router Connection
require App::pluginPath('WidShop'). DS . 'Config' .DS. "routes.php";

step 5:
Copy it to app CONTROLLER
public $helpers = array('Html', 'Session', 'Form', 'WidShop.Javascript', 'WidShop.Image');

Step 6:

Change the setting as required on WidShop/Config/bootstrap.php

Step 7:
Import sql file


step 8:
Copy these lines to app/Config/core.php

Configure::write('Routing.prefixes', array('admin'));