<?php

namespace transactions;

class View
{
    public function render(string $templatePath, array $templateParams = []): string
    {
        extract($templateParams, EXTR_SKIP);
        ob_start();
        include("../templates/{$templatePath}.html");
        return ob_get_clean();
    }
}