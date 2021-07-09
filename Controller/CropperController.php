<?php
namespace Breithbarbot\CropperBundle\Controller;
use Breithbarbot\CropperBundle\Utils\Crop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class CropperController extends Controller
{
    public function cropAction(Request $request)
    {
        $default_folder = !empty($this->getParameter('breithbarbot_cropper.default_folder')) ? $this->getParameter('breithbarbot_cropper.default_folder') : 'uploads';
        $avatar_src = $request->request->get('avatar_src');
        $avatar_data = $request->request->get('avatar_data');
        $avatar_file = $request->files->get('avatar_file');
        $filename = $request->request->get('filename');
        $path = $request->request->get('path');
        $width = $request->request->get('width');
        $height = $request->request->get('height');
        $base_path = dirname($_SERVER['SCRIPT_FILENAME']).'/'.$default_folder.'/';
        $crop = new Crop(
            isset($avatar_src) ? $avatar_src : null,
            isset($avatar_data) ? $avatar_data : null,
            isset($avatar_file) ? $avatar_file : null,
            !empty($filename) ? $filename : sha1(uniqid(time(), true)),
            !empty($path) ? $base_path.$path : $base_path."files/",
            !empty($path) ? $path : "files/",
            ['width' => $width, 'height' => $height],
            $default_folder
        );
        return new JsonResponse([
            'state'   => 200,
            'message' => $crop->getMsg(),
            'result'  => $crop->getResult(),
        ]);
    }
}