<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
class UserController extends Controller
{
    public function addAvatar(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }
        $em = $this->getDoctrine()->getManager();
        $user_id = (int) $request->request->get('user_id');
        $user = $em->find(User::class, $user_id);
        if (!\is_object($user)) {
            throw new AccessDeniedException();
        }
        $avatar_input = $request->files->get('avatar_input');
        if (null !== $avatar_input) {
            $name = uniqid($user_id, true).'.'.$avatar_input->guessClientExtension();
            $result_avatar_input = $avatar_input->move('/public/uploads/user/avatar', $name);
            if (!empty($result_avatar_input)) {
                try {
                    $file = new File();
                    $file->setPath(str_replace('\\', '/', str_replace($this->getParameter('kernel.project_dir').'/public', '', $result_avatar_input->getPathname())));
                    $file->setName($name);
                    $em->persist($file);
                    $user->setAvatar($file);
                    $em->persist($user);
                    $em->flush();
                    return new JsonResponse(['return' => true, 'message' => 'Updated!'], 200);
                } catch (\Exception $e) {
                    $message = 'Error when updating...';
                }
            } else {
                $message = 'Error during file upload';
            }
        } else {
            $message = 'No file found';
        }
        return new JsonResponse(['return' => false, 'message' => $message], 200);
    }
    public function deleteAvatar(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }
    }
}
