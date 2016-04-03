<?php
class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function indexAction(Request $request)
    {
        //setcookie('my_cookie', 'year 2016', time() + 2*60, '/'); // kept alive by 2 minutes
        //echo $_COOKIE['my_cookie'];


        $model = new PageModel();
        $page = $model->findByAlias('any');
        $args = array(
            'page' => $page
        );

        return $this->render('index', $args);
    }
    /**
     * @param Request $request
     * @return string
     */
    public function contactAction(Request $request)
    {
        $form = new ContactForm($request);
        $datetime = new DateTime();

        if ($request->isPost()) {
            if ($form->isValid()) {
                (new FeedbackModel())->save(array(
                    'username' => $form->username,
                    'email' => $form->email,
                    'message' => $form->message,
                    'created' => $datetime->format('Y-m-d H:i:s'),
                    'ip' => $request->getIpAddress()
                ));

                Session::setFlash('Message sens');
                Router::redirect('/contact-us');
            }
            Session::setFlash('Fill the fields');
        }
//        $args = array(
//            'form' => $form,
//            'flash' => $flash
//        );
        $args = compact('form');
        return $this->render('contact', $args);
    }

    public function tasksAction(Request $request)
    {
        $args = array($request);
        return $this->render('tasks', $args);
    }

}









































