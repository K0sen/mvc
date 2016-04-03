<?php

class AdminBookController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function indexAction(Request $request)
    {
        $model = new BookModel();
        $books = $model->findAll();
        $args = compact('books');
        return $this->render('index', $args);
    }
    /**
     * @param Request $request
     * @return string
     * @throws Exception
     * @throws NotFoundException
     */
    public function editAction(Request $request)
    {
        $model = new BookModel();
        $form = new BookForm($request);
        // TODO: $styleModel = new StyleModel(); => взять список категорий, передать в шаблон, сформировать <select>
        $id = $request->get('id');
        $book = $model->findById($id);
        if ($request->isPost()) {
            if ($form->isValid()) {
                $model->save(array(
                    'id' => $id,
                    'title' => $form->title,
                    'description' => $form->description,
                    'price' => $form->price,
                    'status' => $form->status,
                    'style' => $form->style_id
                ));
                Session::setFlash("Saved");
                Router::redirect('/admin/book/edit/' . $id);
            }
            Session::setFlash('Invalid data');
        } else {
            $form->setFromArray($book);
        }
        $args = compact('book', 'form');
        return $this->render('edit', $args);
    }
    public function addAction(Request $request)
    {
        $book = new BookModel();
        $form = new BookForm($request);
        if ($request->isPost()){
            if($form->isValid()){
                $book->add(array(
                    'title' => $form->title,
                    'description' => $form->description,
                    'price' => $form->price,
                    'status' => $form->status,
                    'style' => $form->style_id
                ));
                Session::setFlash("Saved");
                Router::redirect('/admin/book/add');
            }
//            else {
//                $form->setNullArray();
//            }
            Session::setFlash('Fill the fields');
        }
        return $this->render('add', compact('book', 'form'));
    }

    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        (new BookModel())->delete($id);
        Session::setFlash('Book removed');
        Router::redirect('/admin/books');
    }
}
