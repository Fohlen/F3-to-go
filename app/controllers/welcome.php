namespace Controllers;

class Welcome()
{
	public function index()
	{
		echo View::instance()->render('welcome.htm');
	}
	
}
