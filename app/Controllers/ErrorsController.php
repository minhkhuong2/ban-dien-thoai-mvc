<?php
// File: app/Controllers/ErrorsController.php
class ErrorsController extends Controller
{
    public function index()
    {
        $data = ['title' => '404 - Không tìm thấy trang'];
        $this->view('404', $data);
    }
}
