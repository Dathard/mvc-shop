<?php
/*
 * Класс Pagination для генерации постраничной навигации
 */
class Pagination
{
    /**
     * @var Ссылок навигации на страницу
     */
    private $max = 10;
    /**
     * @var Ключ для GET, в который пишется номер страницы
     */
    private $index = 'page';
    /**
     * @var Текущая страница
     */
    private $current_page;
    /**
     * @var Общее количество записей
     */
    private $total;
    /**
     * @var Записей на страницу
     */
    private $limit;
    /**
     * Запуск необходимых данных для навигации
     * @param type $total Общее количество записей
     * @param type $currentPage Номер текущей страницы
     * @param type $limit Количество записей на страницу
     * @param type $index Ключ для url
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
        
        $this->setCurrentPage($currentPage);
    }

    /**
     *  Для вывода ссылок
     * @return HTML
     */
    public function get()
    {
        $links = null;

        $limits = $this->limits();
        
        $html = '<ul class="pagination">';
        # Генерируем ссылки
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # Если текущая это текущая страница, ссылки нет и добавляется класс active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        # Если ссылки создались
        if (!is_null($links)) {
            if ($this->current_page > 1)
                $links = $this->generateHtml(1, '&lt;') . $links;
            if ($this->current_page < $this->amount)
                $links .= $this->generateHtml($this->amount, '&gt;');
        }
        $html .= $links . '</ul>';
        
        return $html;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page
     * 
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        if (!$text)
            $text = $page;
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page=[0-9]+~', '', $currentURI);
        
        return
        '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Для получения, откуда стартовать
     * 
     * @return массив с началом и концом отсчёта
     */
    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);
        
        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;
        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount) {
        # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # Конец - общее количество страниц
            $end = $this->amount;
            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        
        return array($start, $end);
    }

    /**
     * Для установки текущей страницы
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        $this->current_page = $currentPage;
        # Если текущая страница больше нуля
        if ($this->current_page > 0) {
            # Если текущая страница меньше общего количества страниц
            if ($this->current_page > $this->amount)
            # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
        # Устанавливаем страницу на первую
        $this->current_page = 1;
    }

    /**
     * Для получения общего числа страниц
     * 
     * @return число страниц
     */
    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}