<?php

namespace App\Application\Template;

/**
 * Class Engine
 *
 * @package App\Application\Template
 */
class Engine implements EngineInterface
{
    /**
     * @trait
     */
    use Components;

    /**
     * @var string
     */
    protected string $path;

    /**
     * Engine constructor.
     *
     * @param string $dir
     */
    public function __construct(string $dir)
    {
        $this->path = $dir;
    }

    /**
     * @inheritDoc
     */
    public function render(string $view, array $values = []): string
    {
        ob_start();
        extract($values, EXTR_OVERWRITE);
        /** @noinspection PhpIncludeInspection */
        include "{$this->path}/{$view}";
        return ob_get_clean();
    }

    /**
     * @inheritDoc
     */
    public function includes(string $view, array $values = []): void
    {
        echo $this->render($view, $values);
    }
}

