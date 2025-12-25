<?php


namespace Views;

class Frontend extends Base {
    public function render(): string|false|null {
        parent::render();

        if ($this->data) {
            $this->f3->mset($this->data);
        }

        // Use anti-CSRF token in templates.
        $this->f3->CSRF = $this->f3->get('SESSION.csrf');

        $tpl = $this->f3->get('TPL') ?? null;
        if ($tpl) {
            $tpl::registerExtends();
        }

        return \Template::instance()->render('templates/layout.html');
    }
}
