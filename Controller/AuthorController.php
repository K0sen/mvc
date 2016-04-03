<?php

class AuthorController extends Controller
{
    public function authorAction(Request $request)
    {
        $model = new AuthorModel();
        $authors = $model->allAuthors();
        $args = compact('authors');
        return $this->render('author', $args);
    }

    public function aboutAuthorAction(Request $request)
    {
        $id = $request->get('id');
        $model = new AuthorModel();
        $author = $model->oneAuthor($id);
        $args = compact('author');
        return $this->render('aboutAuthor', $args);
    }

}