<?php
namespace App\Controller;
use App\Entity\File;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class CropperController extends AbstractController
{
    public function avatarAdd(Request $request): JsonResponse
    {
        $status = 400;
        $return = false;
        $additionalData = [];
        $path = '/public/uploads/user/avatar';
        $nameEntity = 'Avatar';
        if (!$request->isXmlHttpRequest()) {
            $message = 'This is not an ajax request.';
        } else {
            $em = $this->getDoctrine()->getManager();
            $imageInput = $request->files->get('avatar_input');
            if (null !== $imageInput) {
                $name = md5(uniqid(12345, true)).'.'.$imageInput->guessClientExtension();
                $resultUpload = $imageInput->move($path, $name);
                if (!empty($resultUpload)) {
                    try {
                        $file = new File();
                        $file->setPath(str_replace('\\', '/', str_replace($this->getParameter('kernel.project_dir').'/public', '', $resultUpload->getPathname())));
                        $file->setName($name);
                        $em->persist($file);
                        $em->flush();
                        $additionalData['file'] = ['id' => $file->getId()];
                        $status = 200;
                        $message = $nameEntity.' saved.';
                        $return = true;
                    } catch (\Exception $e) {
                        $message = 'An error occurred when updating the '.mb_strtolower($nameEntity).'...';
                    }
                } else {
                    $message = 'Error during file upload...';
                }
            } else {
                $message = 'File does not exist!';
            }
        }
        return new JsonResponse(['return' => $return, 'message' => $message, 'additional_data' => $additionalData], $status);
    }
    public function avatarDelete(Request $request): JsonResponse
    {
        $status = 400;
        $return = false;
        $additionalData = [];
        $entityId = $request->request->get('entity_id');
        $class = User::class;
        $nameEntity = 'Avatar';
        if (!$request->isXmlHttpRequest()) {
            $message = 'This is not an ajax request.';
        } else {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->find($class, $entityId);
            if (!\is_object($entity) && (null === $entity->getAvatar())) {
                $message = 'Entity does not exist!';
            } else {
                try {
                    $getFullPath = $entity->getAvatar()->getFullPath();
                    $em->remove($entity->getAvatar());
                    if (is_file($getFullPath)) {
                        unset($getFullPath);
                    }
                    $entity->setAvatar(null);
                    $em->persist($entity);
                    $em->flush();
                    $message = 'Image deleted!';
                    $status = 200;
                    $return = true;
                } catch (\Exception $e) {
                    $message = 'An error occurred when delete the '.mb_strtolower($nameEntity).'...';
                }
            }
        }
        return new JsonResponse(['return' => $return, 'message' => $message, $additionalData], $status);
    }
}
