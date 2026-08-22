<?php
class PainelController {
    public function index() {
        exigirLogin();
        include __DIR__ . '/../views/painel/index.php';
    }
}