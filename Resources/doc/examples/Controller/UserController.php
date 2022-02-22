<?php
namespace App\Controller;
use App\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class UserController extends Controller
{
    public function edit(Request $request): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $fileId = $request->request->get('user')['avatar']['id'];
            if (!empty($fileId)) {
                if ($entity->getAvatar()) {
                    $file = $em->find(File::class, $entity->getAvatar());
                    $em->remove($file);
                }
                $entity->setAvatar($em->find(File::class, $fileId));
            }
            $em->persist($entity);
            $em->flush();
        } catch (\Exception $e) {
        }
    }
}
