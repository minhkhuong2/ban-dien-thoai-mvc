<?php
class Pagination
{
    private $totalItems;
    private $itemsPerPage;
    private $currentPage;
    private $urlPattern;
    private $totalPages;

    public function __construct($totalItems, $itemsPerPage, $currentPage, $urlPattern)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = ($currentPage > 0) ? (int)$currentPage : 1;
        $this->urlPattern = $urlPattern;
        $this->totalPages = ceil($totalItems / $itemsPerPage);
    }

    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function render()
    {
        if ($this->totalPages <= 1) {
            return '';
        }

        $html = '<ul class="pagination">';

        // Previous Button
        if ($this->currentPage > 1) {
            $prevPage = $this->currentPage - 1;
            $url = str_replace('(:num)', $prevPage, $this->urlPattern);
            $html .= '<li class="page-item"><a class="page-link" href="' . $url . '">&laquo; Trước</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link">&laquo; Trước</span></li>';
        }

        // Page Links with Ellipsis Logic
        $start = max(1, $this->currentPage - 2);
        $end = min($this->totalPages, $this->currentPage + 2);

        if ($start > 1) {
             $url = str_replace('(:num)', 1, $this->urlPattern);
             $html .= '<li class="page-item"><a class="page-link" href="' . $url . '">1</a></li>';
             if ($start > 2) {
                 $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
             }
        }

        for ($i = $start; $i <= $end; $i++) {
            $activeClass = ($this->currentPage == $i) ? ' active' : '';
            if ($activeClass) {
                 $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
                 $url = str_replace('(:num)', $i, $this->urlPattern);
                 $html .= '<li class="page-item"><a class="page-link" href="' . $url . '">' . $i . '</a></li>';
            }
        }

        if ($end < $this->totalPages) {
            if ($end < $this->totalPages - 1) {
                $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            $url = str_replace('(:num)', $this->totalPages, $this->urlPattern);
            $html .= '<li class="page-item"><a class="page-link" href="' . $url . '">' . $this->totalPages . '</a></li>';
        }

        // Next Button
        if ($this->currentPage < $this->totalPages) {
            $nextPage = $this->currentPage + 1;
            $url = str_replace('(:num)', $nextPage, $this->urlPattern);
            $html .= '<li class="page-item"><a class="page-link" href="' . $url . '">Tiếp &raquo;</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link">Tiếp &raquo;</span></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
