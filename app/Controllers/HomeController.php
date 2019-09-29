<?php
namespace App\Controllers;

use App\Services\FaceMerge;
use App\Services\WxServices;

use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    protected $wx;
    protected $fb;

    public function __construct()
    {
        $this->wx = new WxServices();
        $this->fb = new FaceMerge();
    }

    /**
     * wx oauth check
     */
    public function index()
    {
        $this->wx->oauth()->send();
    }

    /**
     *
     */
    public function buildFace()
    {
        $user = $this->wx->user();

        if (!$user) {
            $this->view('error');
        }

        $openId = $user->getId();
        $avatar = $user->getAvatar();
        $avatar = substr($avatar, 0, -3) . '0';

        $dir = $this->fb->buildPath($openId);

        if (!is_file($dir . '/' . $openId . '.jpg')) {
            $path = $dir . '/' . $openId . '.jpg' ;
            $this->wx->downloadAvatar($avatar, $path);

            $this->fb->handle($path, $dir . '/' . $openId);
        }

        return $this->display(['username' => $user->getNickname(), 'files' => $this->fb->createUrl($openId)]);
    }


    public function display($arr = [])
    {
       $this->view('avatar', $arr);
    }


}
