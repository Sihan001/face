<?php
namespace App\Services;

use Grafika\Grafika;

class FaceMerge extends Services
{
    protected $baseFace = [
        ROOT_PATH . 's/1.png',
        ROOT_PATH . 's/2.png',
        ROOT_PATH . 's/3.png'
    ];

    public function handle($face, $save)
    {
        $h = 500;
        $editor = Grafika::createEditor();
        $editor->open($size , $face);
        $editor->resizeFill($size , $h, $h);
        $editor->save($size , $face);

        $i = 1;
        foreach ($this->baseFace as $val) {
            $editor = Grafika::createEditor();
            $editor->open($image1 , $val);
            $editor->open($image2 , $face);
            $editor->blend ($image2, $image1, 'normal', 1, 'center');
            $editor->save($image2, $save . '_' . $i . '.png');
            $i++;
        }

        return true;
    }



    public function buildPath($id)
    {
          $dir = substr(md5($id), 0, 4);
          $path = __DIR__ . "/../../public/face/" . $dir;

          if (!is_dir($path)) {
                mkdir($path, 0777, true);
          }

          return $path;
    }

    public function fileExt($fileName)
    {
        return end(explode('.', $fileName));
    }

    public function buildUrl($arrs = [])
    {
        $host = 'http://ifcocn.ifcocn.com/face/';

        $tmp = [];
        foreach ($arrs as $arr) {
            array_push($tmp, $host . $arr);
        }

        return $tmp;
    }

    public function createUrl($file)
    {
        $arr = [
            substr(md5($file), 0, 4) . '/' . $file . '_1.png',
            substr(md5($file), 0, 4) . '/' . $file . '_2.png',
            substr(md5($file), 0, 4) . '/' . $file . '_3.png'
        ];

        return $this->buildUrl($arr);
    }

}
