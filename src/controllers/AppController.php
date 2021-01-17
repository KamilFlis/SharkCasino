<?php

class AppController {

    private $request;

    public function __construct() {
        $this->request = $_SERVER["REQUEST_METHOD"];
    }

    protected function isGet(): bool {
        return $this->request === "GET";
    }

    protected function isPost(): bool {
        return $this->request === "POST";
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = "public/views/".$template.".php";
        $output = "File not found";

        if(file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    public function getUsername() {
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode(["username" => $_SESSION["username"]]);
    }
}