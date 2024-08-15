<?php

interface Render
{
    /**
     * Вывод результата в браузер
     *
     * @return void
     */
    public function render(): void;
}