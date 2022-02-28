<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class UserController extends AbstractController
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
