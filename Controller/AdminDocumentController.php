<?php

class AdminDocumentController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function indexAction(Request $request)
    {
       // TODO document list
    }

    public function addAction(Request $request)
    {
        if ($request->isPost()) {
            $file = new UploadedFile($request, 'document');
            if ($file->uploadIsSuccessful()) {
                $file->move(UPLOAD_DIR . $file->name);
            }
        }
        return $this->render('add');
    }

    public function addBookPictAction(Request $request)
    {
        if ($request->isPost()){
            $file = new UploadedFile($request, 'bookPicture');
            if ($file->uploadIsSuccessful() && $file->isImage()){
                $name = $request->get('id');
                $file->changeName($name);
                $file->move(UPLOAD_DIR . $file->name);
            }
        }
        return $this->render('addBookPict');
    }
}