<?php

class ViewTest extends \PHPUnit\Framework\TestCase
{
    private $view;

    protected function setUp(): void
    {
        $this->view = new \core\base\View(['controller' => 'Main', 'action' => 'index', 'prefix' => ''], false, ['title' => 'Главная'], 'main');
    }

    public function testRoute() {
        $this->assertEquals(['controller' => 'Main', 'action' => 'index', 'prefix' => ''], $this->view->getRoute());
    }
}
