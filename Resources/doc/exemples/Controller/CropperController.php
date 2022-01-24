<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class CropperController extends Controller
{
    public function avatarAdd(Request $request): JsonResponse
    {
        $status = 400;
        $return = false;
        $additionalData = [];
        if (!$request->isXmlHttpRequest()) {
            $message = 'This is not an ajax request.';
        } else {
            $em = $this->getDoctrine()->getManager();
            $userId = (int) $request->request->get('user_id');
            $user = $em->find(User::class, $userId);
            if (!\is_object($user)) {
                $message = 'User does not exist!';
            } else {
                $avatarInput = $request->files->get('avatar_input');
                if (null !== $avatarInput) {
                    $name = md5(uniqid($userId, true)).'.'.$avatarInput->guessClientExtension();
                    $resultUpload = $avatarInput->move('/public/uploads/user/avatar', $name);
                    if (!empty($resultUpload)) {
                        $entity = 'Avatar';
                        try {
                            $file = new File();
                            $file->setFullPath($resultUpload->getPathname());
                            $file->setPath(str_replace('\\', '/', str_replace($this->getParameter('kernel.project_dir').'/public', '', $resultUpload->getPathname())));
                            $file->setTitle($avatarInput->getClientOriginalName());
                            $em->persist($file);
                            $additionalData = ['file' => ['id' => $file->getId()]];
                            $user->setAvatar($file);
                            $em->persist($user);
                            $em->flush();
                            $status = 200;
                            $message = $entity.' updated.';
                            $return = true;
                        } catch (\Exception $e) {
                            $message = 'An error occurred when updating the '.mb_strtolower($entity).'...';
                        }
                    } else {
                        $message = 'Error during file upload...';
                    }
                } else {
                    $status = 400;
                    $message = 'File does not exist!';
                }
            }
        }
        return new JsonResponse(['return' => $return, 'message' => $message, $additionalData], $status);
    }
    public function avatarDelete(Request $request): JsonResponse
    {
        $status = 400;
        $return = false;
        $additionalData = [];
        if (!$request->isXmlHttpRequest()) {
            $message = 'This is not an ajax request.';
        } else {
            $em = $this->getDoctrine()->getManager();
            $userId = (int) $request->request->get('user_id');
            $user = $em->find(User::class, $userId);
            if (!\is_object($user)) {
                $message = 'User does not exist!';
            } elseif (null === $user->getAvatar()) {
                $message = 'User does not exist!';
            } else {
                $entity = 'Avatar';
                try {
                    $getFullPath = $user->getAvatar()->getFullPath();
                    $em->remove($user->getAvatar());
                    if (is_file($getFullPath)) {
                        unset($getFullPath);
                    }
                    $user->setAvatar(null);
                    $em->persist($user);
                    $em->flush();
                    $message = 'Image deleted!';
                    $status = 200;
                    $return = true;
                } catch (\Exception $e) {
                    $message = 'An error occurred when delete the '.mb_strtolower($entity).'...';
                }
            }
        }
        return new JsonResponse(['return' => $return, 'message' => $message, $additionalData], $status);
    }
}
