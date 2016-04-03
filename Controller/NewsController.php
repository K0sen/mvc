<?php

class NewsController extends Controller
{
    public function indexAction(Request $request)
    {
        $news = (new NewsModel($request))->allNews();
        $args = compact('news');

        return $this->render('index', $args);
    }

    public function addAction(Request $request)
    {
        $news = new NewsModel();
        $form = new NewsForm($request);
        if ($request->isPost()) {
            if ($form->isValid()) {
                $message = array(
                    'title' => $form->title,
                    'text' => $form->text
                );
                (new NewsModel($request))->addNews($message);
                Session::setFlash('News added');
                Router::redirect('/news_add');
            }
            Session::setFlash('Fill the fields');
        }

        $args = compact('news');
        return $this->render('add', $args);
    }

    public function newsAction(Request $request)
    {
        $id = $request->get('id');
        $news = (new NewsModel($request))->oneNews($id);
        $news = compact('news');
        return $this->render('news', $news);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        (new NewsModel($request))->deleteNews($id);
        Session::setFlash('News deleted');
        Router::redirect("/news");
    }
}
