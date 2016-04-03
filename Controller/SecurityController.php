<?php
/**
 * Created by PhpStorm.
 * User: PHP acedemy
 * Date: 24.03.2016
 * Time: 20:06
 */
class SecurityController extends Controller
{
    public function registerAction(Request $request)
    {
        $form = new RegistrationForm($request);
        if ($request->isPost()) {
            if ($form->isValid()) {
                $model = new UserModel();
                if ($model->check($form->email)){
                    Session::setFlash('Is already register');
                    Router::redirect('/register');
                } else {
                    $model->save(array(
                        'email' => $form->email,
                        'password' => new Password($form->password)
                    ));
                    Session::setFlash('Registered');
                    Router::redirect('/login');
                }
            }
            Session::setFlash($form->getNotice());
        }
        $args = compact('form');
        return $this->render('register', $args);
    }

    public function loginAction(Request $request)
    {
        $form = new LoginForm($request);
        if ($request->isPost()) {
            if ($form->isValid()) {
                $model = new UserModel();
                $password = new Password($form->password);
                $email = $form->email;
                if ($user = $model->find($email, $password)) {
                    Session::setUser('user', $user['email']);
                    Session::setFlash('Signed in');
                    Router::redirect('/admin');
                }
                Session::setFlash('User not found');
                Router::redirect('/login');
            }
            Session::setFlash('Fill the fields');
        }
        return $this->render('login', compact('form'));
    }
    public function logoutAction(Request $request)
    {
        Session::remove('user');
        Router::redirect('/');
    }
    public function adminAction(Request $request)
    {
        if (!Session::has('user')) {
            Router::redirect('/');
        }
        return $this->render('admin');
    }


}