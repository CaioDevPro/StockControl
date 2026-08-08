<?php
class HomeController {
    public function index() {
        // Incluir a view da página inicial
        include __DIR__ . '/../views/home/index.php';
    }
}