<?
set_time_limit(0);
require_once('Image/3D.php');

//Vytvoreni instance
$world = new Image_3D();
$world->setColor(new Image_3D_Color(255, 255, 255));


//Polygon
$p1 = $world->createObject('polygon', array(	new Image_3D_Point(-30, 100, 0),
												new Image_3D_Point(-30, -150, 0),
												new Image_3D_Point(80, 0, 30))
											);
$p1->setColor(new Image_3D_Color(100, 200, 100));

$p2 = $world->createObject('polygon', array(	new Image_3D_Point(-100, 50, 30),
												new Image_3D_Point(-70, -100, -20),
												new Image_3D_Point(150, 90, 0)));
$p2->setColor(new Image_3D_Color(100, 100, 200));

$p3 = $world->createObject('polygon', array(	new Image_3D_Point(-30, 20, -50),
												new Image_3D_Point(-50, -30, -80),
												new Image_3D_Point(50, 30, 40)));
$p3->setColor(new Image_3D_Color(200, 100, 100, 100));

$world->setOption(Image_3D::IMAGE_3D_OPTION_FILLED, true);

$world->createRenderer('perspectively');

//Pouzijeme z-buffer
$world->createDriver('ZBuffer');

//Ulozeni obrazku do souboru a jeho nasledne zobrazeni
$world->render(300, 300, 'zbuffer.png');

echo '<img src="zbuffer.png">';